<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Main login for authorized users.
     * Accepts: user_code / USER_CODE / userId
     */
    public function authorizedLogin(Request $request)
    {
        $request->merge([
            'user_code' => $request->input('user_code')
                ?? $request->input('USER_CODE')
                ?? $request->input('userId')
                ?? $request->input('user_id'),

            'password' => $request->input('password')
                ?? $request->input('PASSWORD'),
        ]);

        $validator = Validator::make($request->all(), [
            'user_code' => 'required|string',
            'password'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status'  => 'error',
                'message' => 'User ID and password are required.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $userCode = strtoupper(trim($request->user_code));
        $password = $request->password;

        try {
            $user = DB::table('users')
                ->whereRaw('UPPER(LTRIM(RTRIM(USER_CODE))) = ?', [$userCode])
                ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'status'  => 'error',
                    'message' => 'Invalid user ID or password.',
                ], 401);
            }

            $row = array_change_key_case((array) $user, CASE_LOWER);

            $active = strtoupper(trim((string) ($row['active'] ?? 'N')));

            if ($active === 'P') {
                return response()->json([
                    'success' => false,
                    'status'  => 'error',
                    'message' => 'User account is still pending approval.',
                ], 403);
            }

            if (!in_array($active, ['Y', '1', 'TRUE'], true)) {
                return response()->json([
                    'success' => false,
                    'status'  => 'error',
                    'message' => 'User account is inactive.',
                ], 403);
            }

            $storedPassword = (string) ($row['password'] ?? '');
            $passwordMatched = $this->passwordMatches($password, $storedPassword);

            if (!$passwordMatched) {
                return response()->json([
                    'success' => false,
                    'status'  => 'error',
                    'message' => 'Invalid user ID or password.',
                ], 401);
            }

            $userType = strtoupper(trim((string) ($row['user_type'] ?? '')));
            $role = in_array($userType, ['S', 'X'], true)
                ? 'APPROVER'
                : 'AUTHORIZED_USER';

            /*
             * Important:
             * Do not block login based on LOGIN_STAT.
             * LOGIN_STAT can become stale when browser/session was closed unexpectedly.
             * We only update it after successful login.
             */
            $sessionId = $request->session()->getId();
            $request->session()->put('auth_user_code', $userCode);
            $request->session()->put('auth_session_id', $sessionId);

            Cache::put("user:active_session:{$userCode}", $sessionId, now()->addHours(12));

            $this->safeUpdateUserLoginAudit($userCode, $request);

            $data = $this->buildUserPayload($row, $role);

            return response()->json([
                'success' => true,
                'status'  => 'success',
                'message' => 'Login successful.',
                'data'    => $data,
            ], 200);
        } catch (\Throwable $e) {
            Log::error("Authorized login failed for {$userCode}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'status'  => 'error',
                'message' => 'Login failed due to a server error.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Used by frontend /me validation.
     */
    public function me(Request $request)
    {
        $userCode = strtoupper(trim((string) $request->session()->get('auth_user_code')));

        if ($userCode === '') {
            return response()->json([
                'success' => false,
                'status'  => 'error',
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $currentSessionId = $request->session()->getId();
        $mappedSessionId = Cache::get("user:active_session:{$userCode}");

        /*
         * Only show logged-in-elsewhere if another session is truly mapped.
         * Do not use LOGIN_STAT alone because it may be stale.
         */
        if ($mappedSessionId && $mappedSessionId !== $currentSessionId) {
            $request->session()->forget(['auth_user_code', 'auth_session_id']);

            return response()->json([
                'success' => false,
                'status'  => 'error',
                'code'    => 'LOGGED_IN_ELSEWHERE',
                'message' => 'Your session ended because this account was logged in from another device.',
            ], 401);
        }

        $user = DB::table('users')
            ->whereRaw('UPPER(LTRIM(RTRIM(USER_CODE))) = ?', [$userCode])
            ->first();

        if (!$user) {
            $request->session()->forget(['auth_user_code', 'auth_session_id']);

            return response()->json([
                'success' => false,
                'status'  => 'error',
                'message' => 'User account no longer exists.',
            ], 401);
        }

        $row = array_change_key_case((array) $user, CASE_LOWER);
        $userType = strtoupper(trim((string) ($row['user_type'] ?? '')));
        $role = in_array($userType, ['S', 'X'], true)
            ? 'APPROVER'
            : 'AUTHORIZED_USER';

        return response()->json($this->buildUserPayload($row, $role), 200);
    }

    /**
     * Keeps the server session alive.
     */
    public function heartbeat(Request $request)
    {
        $userCode = strtoupper(trim((string) $request->session()->get('auth_user_code')));

        if ($userCode === '') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $sessionId = $request->session()->getId();

        Cache::put("user:active_session:{$userCode}", $sessionId, now()->addHours(12));

        $this->safeUpdateColumns($userCode, [
            'LOGIN_STAT'    => 1,
            'LAST_ACTIVE_AT' => now(),
        ]);

        return response()->json([
            'success' => true,
            'status'  => 'success',
        ]);
    }

    /**
     * Logout current session.
     */
    public function logout(Request $request)
    {
        $userCode = strtoupper(trim((string) $request->session()->get('auth_user_code')));
        $sessionId = $request->session()->getId();

        if ($userCode !== '') {
            $mappedSessionId = Cache::get("user:active_session:{$userCode}");

            if (!$mappedSessionId || $mappedSessionId === $sessionId) {
                Cache::forget("user:active_session:{$userCode}");

                $this->safeUpdateColumns($userCode, [
                    'LOGIN_STAT' => 0,
                ]);
            }
        }

        $request->session()->forget(['auth_user_code', 'auth_session_id']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'status'  => 'success',
            'message' => 'Logged out successfully.',
        ]);
    }

    private function passwordMatches(string $plainPassword, string $storedPassword): bool
    {
        if ($storedPassword === '') {
            return false;
        }

        $isHashed =
            str_starts_with($storedPassword, '$2y$') ||
            str_starts_with($storedPassword, '$2a$') ||
            str_starts_with($storedPassword, '$2b$') ||
            str_starts_with($storedPassword, '$argon2i$') ||
            str_starts_with($storedPassword, '$argon2id$');

        if ($isHashed) {
            return Hash::check($plainPassword, $storedPassword);
        }

        return hash_equals($storedPassword, $plainPassword);
    }

    private function buildUserPayload(array $row, string $role): array
    {
        $userCode = $this->getValue($row, ['user_code', 'userid', 'user_id']);
        $userName = $this->getValue($row, ['user_name', 'username', 'name']);
        $email    = $this->getValue($row, ['email_add', 'email']);
        $userType = $this->getValue($row, ['user_type']);
        $moduleAccess = $this->buildModuleAccessPayload($row);

        $branchCode = $this->getValue($row, [
            'branch_code',
            'branchcode',
            'branch',
            'br_code',
        ]);

        $branchName = $this->getValue($row, [
            'branch_name',
            'branchname',
            'branch_desc',
            'branchdesc',
        ]);

        return [
            // lowercase / camelCase for React helpers
            'user_code'   => $userCode,
            'userCode'    => $userCode,
            'user_id'     => $userCode,
            'userId'      => $userCode,
            'user_name'   => $userName,
            'userName'    => $userName,
            'email'       => $email,
            'email_add'   => $email,
            'user_type'   => $userType,
            'userType'    => $userType,
            'role'        => $role,
            'moduleAccess' => $moduleAccess,
            'modules'     => $moduleAccess['modules'],
            'allowedModules' => $moduleAccess['modules'],
            'assignedModule' => $moduleAccess['primaryModule'],
            'branchCode'  => $branchCode,
            'branch_code' => $branchCode,
            'branchName'  => $branchName,
            'branch_name' => $branchName,

            // uppercase for old NAYSA screens
            'USER_CODE'   => $userCode,
            'USER_NAME'   => $userName,
            'EMAIL_ADD'   => $email,
            'USER_TYPE'   => $userType,
            'ROLE'        => $role,
            'MODULE_ACCESS' => $moduleAccess['modules'],
            'ASSIGNED_MODULE' => $moduleAccess['primaryModule'],
            'BRANCH_CODE' => $branchCode,
            'BRANCH_NAME' => $branchName,
        ];
    }

    private function getValue(array $row, array $keys, string $fallback = ''): string
    {
        foreach ($keys as $key) {
            $value = $row[strtolower($key)] ?? null;

            if ($value !== null && trim((string) $value) !== '') {
                return trim((string) $value);
            }
        }

        return $fallback;
    }

    private function safeUpdateUserLoginAudit(string $userCode, Request $request): void
    {
        $this->safeUpdateColumns($userCode, [
            'LOGIN_STAT'    => 1,
            'LAST_LOGIN_AT' => now(),
            'LAST_LOGIN_IP' => $request->ip(),
            'LOGIN_COUNT'   => DB::raw('ISNULL(LOGIN_COUNT, 0) + 1'),
            'STAT'          => 0,
        ]);
    }

    private function safeUpdateColumns(string $userCode, array $columns): void
    {
        try {
            $existingColumns = collect(Schema::getColumnListing('users'))
                ->mapWithKeys(fn ($col) => [strtoupper($col) => $col])
                ->all();

            $updateData = [];

            foreach ($columns as $column => $value) {
                $upper = strtoupper($column);

                if (isset($existingColumns[$upper])) {
                    $updateData[$existingColumns[$upper]] = $value;
                }
            }

            if (count($updateData) === 0) {
                return;
            }

            DB::table('users')
                ->whereRaw('UPPER(LTRIM(RTRIM(USER_CODE))) = ?', [$userCode])
                ->update($updateData);
        } catch (\Throwable $e) {
            Log::warning("User login audit update skipped for {$userCode}: " . $e->getMessage());
        }
    }
}
