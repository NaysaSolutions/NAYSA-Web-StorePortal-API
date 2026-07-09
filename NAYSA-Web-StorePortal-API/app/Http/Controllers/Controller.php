<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    protected const MODULE_STORE_PORTAL = 'store-portal';
    protected const MODULE_COMMISSARY = 'commissary';

    protected function authorizeModuleAccess(Request $request, string $module): array
    {
        $userCode = strtoupper(trim((string) $request->session()->get('auth_user_code')));

        if ($userCode === '') {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Unauthenticated.',
            ], 401));
        }

        $access = Cache::remember(
            'module_access:v1:' . sha1($userCode),
            120,
            function () use ($userCode) {
                $user = DB::table('users')
                    ->whereRaw('UPPER(LTRIM(RTRIM(USER_CODE))) = ?', [$userCode])
                    ->first();

                if (!$user) {
                    return null;
                }

                $row = array_change_key_case((array) $user, CASE_LOWER);

                return [
                    'row' => $row,
                    'modules' => $this->getAssignedModulesForRow($row),
                ];
            }
        );

        if (!$access) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'User account no longer exists.',
            ], 401));
        }

        $row = $access['row'];
        $modules = $access['modules'];

        if (!in_array($module, $modules, true)) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'You do not have access to this module.',
                'module' => $module,
                'allowedModules' => $modules,
            ], 403));
        }

        return [$row, $modules];
    }

    protected function buildModuleAccessPayload(array $row): array
    {
        $modules = $this->getAssignedModulesForRow($row);

        return [
            'modules' => $modules,
            'primaryModule' => $modules[0] ?? null,
            'labels' => array_map(fn ($module) => $this->moduleLabel($module), $modules),
        ];
    }

    protected function getAssignedModulesForRow(array $row): array
    {
        $row = array_change_key_case($row, CASE_LOWER);
        $modules = [];
        $userCode = $this->getAccessRowValue($row, [
            'user_code',
            'usercode',
            'userid',
            'user_id',
            'login_id',
            'actcode',
            'username',
        ]);

        foreach ($this->moduleAccessValueFields() as $field) {
            if (array_key_exists($field, $row)) {
                $modules = array_merge($modules, $this->modulesFromValue($row[$field]));
            }
        }

        foreach ($this->moduleAccessFlagFields() as $module => $fields) {
            foreach ($fields as $field) {
                if (array_key_exists($field, $row) && $this->isTruthy($row[$field])) {
                    $modules[] = $module;
                }
            }
        }

        $modules = array_merge($modules, $this->modulesFromAnyRowValues($row));
        $modules = array_merge($modules, $this->modulesFromPrivilegedUserType($row));

        if ($userCode !== '') {
            $modules = array_merge($modules, $this->getAssignedModulesFromAccessTables($userCode));
        }

        return array_values(array_unique($modules));
    }

    private function moduleAccessValueFields(): array
    {
        return [
            'module',
            'modules',
            'module_id',
            'moduleid',
            'module_code',
            'modulecode',
            'module_name',
            'modulename',
            'module_access',
            'moduleaccess',
            'assigned_module',
            'assignedmodule',
            'access_module',
            'accessmodule',
            'menu_module',
            'menumodule',
            'app_module',
            'appmodule',
            'menu_access',
            'menuaccess',
            'menu',
            'menu_id',
            'menuid',
            'menu_code',
            'menucode',
            'menu_name',
            'menuname',
            'menu_caption',
            'menucaption',
            'caption',
            'name',
            'title',
            'description',
            'form_name',
            'formname',
            'program',
            'program_name',
            'programname',
            'access_rights',
            'accessrights',
            'user_access',
            'useraccess',
            'user_access_rights',
            'useraccessrights',
            'rights',
            'access',
        ];
    }

    private function moduleAccessFlagFields(): array
    {
        return [
            self::MODULE_STORE_PORTAL => [
                'store_portal',
                'storeportal',
                'store_portal_access',
                'storeportalaccess',
                'store_access',
                'storeaccess',
                'store_ordering_access',
                'storeorderingaccess',
                'can_store_portal',
                'canstoreportal',
                'allow_store_portal',
                'allowstoreportal',
                'has_store_portal',
                'hasstoreportal',
                'store_portal_menu',
                'storeportalmenu',
            ],
            self::MODULE_COMMISSARY => [
                'commissary',
                'commissary_access',
                'commissaryaccess',
                'commissary_forecast_access',
                'commissaryforecastaccess',
                'can_commissary',
                'cancommissary',
                'allow_commissary',
                'allowcommissary',
                'has_commissary',
                'hascommissary',
                'commissary_menu',
                'commissarymenu',
            ],
        ];
    }

    private function getAssignedModulesFromAccessTables(string $userCode): array
    {
        $modules = [];

        try {
            $tables = DB::select("
                SELECT TABLE_SCHEMA, TABLE_NAME
                FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_TYPE = 'BASE TABLE'
                  AND (
                    LOWER(TABLE_NAME) LIKE '%access%'
                    OR LOWER(TABLE_NAME) LIKE '%module%'
                    OR LOWER(TABLE_NAME) LIKE '%menu%'
                    OR LOWER(TABLE_NAME) LIKE '%right%'
                    OR LOWER(TABLE_NAME) LIKE '%permission%'
                  )
            ");

            foreach ($tables as $table) {
                $modules = array_merge(
                    $modules,
                    $this->getAssignedModulesFromAccessTable(
                        (string) $table->TABLE_SCHEMA,
                        (string) $table->TABLE_NAME,
                        $userCode,
                    ),
                );
            }
        } catch (\Throwable) {
            return [];
        }

        return array_values(array_unique($modules));
    }

    private function getAssignedModulesFromAccessTable(string $schema, string $table, string $userCode): array
    {
        try {
            $columnRows = DB::select("
                SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
            ", [$schema, $table]);
        } catch (\Throwable) {
            return [];
        }

        $columns = collect($columnRows)
            ->mapWithKeys(fn ($column) => [strtolower((string) $column->COLUMN_NAME) => (string) $column->COLUMN_NAME])
            ->all();

        $userColumn = $this->firstExistingColumn($columns, $this->accessUserColumns());

        if ($userColumn === '') {
            return [];
        }

        $moduleColumns = $this->existingColumns($columns, $this->moduleAccessValueFields());
        $flagColumns = [];
        $tableModules = $this->modulesFromText($table);

        foreach ($this->moduleAccessFlagFields() as $fields) {
            $flagColumns = array_merge($flagColumns, $this->existingColumns($columns, $fields));
        }

        try {
            $rows = DB::table($schema . '.' . $table)
                ->whereRaw(
                    'UPPER(LTRIM(RTRIM(CAST(' . $this->quoteSqlServerIdentifier($userColumn) . ' AS NVARCHAR(255))))) = ?',
                    [strtoupper(trim($userCode))],
                )
                ->limit(50)
                ->get();
        } catch (\Throwable) {
            return [];
        }

        $modules = [];

        foreach ($rows as $row) {
            if (count($tableModules) > 0) {
                $modules = array_merge($modules, $tableModules);
            }

            $accessRow = array_change_key_case((array) $row, CASE_LOWER);
            $modules = array_merge($modules, $this->modulesFromAnyRowValues($accessRow));

            foreach ($moduleColumns as $column) {
                $modules = array_merge($modules, $this->modulesFromValue($accessRow[strtolower($column)] ?? null));
            }

            foreach ($this->moduleAccessFlagFields() as $module => $fields) {
                foreach ($fields as $field) {
                    $value = $accessRow[strtolower($field)] ?? null;

                    if ($value !== null && $this->isTruthy($value)) {
                        $modules[] = $module;
                    }
                }
            }
        }

        return array_values(array_unique($modules));
    }

    private function modulesFromAnyRowValues(array $row): array
    {
        $modules = [];

        foreach ($row as $key => $value) {
            $modules = array_merge($modules, $this->modulesFromText((string) $key));

            if (is_scalar($value) || $value === null) {
                $modules = array_merge($modules, $this->modulesFromValue($value));
            }
        }

        return array_values(array_unique($modules));
    }

    private function modulesFromPrivilegedUserType(array $row): array
    {
        $userType = strtoupper(trim((string) ($row['user_type'] ?? $row['usertype'] ?? '')));
        $role = strtoupper(trim((string) ($row['role'] ?? '')));

        if (in_array($userType, ['S', 'X', 'ADMIN', 'SUPERADMIN'], true) || in_array($role, ['ADMIN', 'APPROVER', 'SUPERADMIN'], true)) {
            return [self::MODULE_STORE_PORTAL, self::MODULE_COMMISSARY];
        }

        return [];
    }

    private function accessUserColumns(): array
    {
        return [
            'user_code',
            'usercode',
            'userid',
            'user_id',
            'login_id',
            'loginid',
            'username',
            'user_name',
            'username',
            'actcode',
            'employee_code',
            'employeecode',
            'emp_code',
            'empcode',
        ];
    }

    private function firstExistingColumn(array $columns, array $candidates): string
    {
        foreach ($candidates as $candidate) {
            $key = strtolower($candidate);

            if (isset($columns[$key])) {
                return $columns[$key];
            }
        }

        return '';
    }

    private function existingColumns(array $columns, array $candidates): array
    {
        $existing = [];

        foreach ($candidates as $candidate) {
            $key = strtolower($candidate);

            if (isset($columns[$key])) {
                $existing[] = $columns[$key];
            }
        }

        return array_values(array_unique($existing));
    }

    private function getAccessRowValue(array $row, array $keys): string
    {
        foreach ($keys as $key) {
            $value = $row[strtolower($key)] ?? null;

            if ($value !== null && trim((string) $value) !== '') {
                return trim((string) $value);
            }
        }

        return '';
    }

    private function quoteSqlServerIdentifier(string $identifier): string
    {
        return '[' . str_replace(']', ']]', $identifier) . ']';
    }

    private function modulesFromValue(mixed $value): array
    {
        if ($value === null) {
            return [];
        }

        if (is_array($value)) {
            $modules = [];

            foreach ($value as $key => $item) {
                if (is_string($key) && $this->isTruthy($item)) {
                    $modules = array_merge($modules, $this->modulesFromText($key));
                }

                $modules = array_merge($modules, $this->modulesFromValue($item));
            }

            return $modules;
        }

        if (is_object($value)) {
            return $this->modulesFromValue((array) $value);
        }

        $text = trim((string) $value);

        if ($text === '') {
            return [];
        }

        if (in_array($text[0], ['[', '{'], true)) {
            $decoded = json_decode($text, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                return $this->modulesFromValue($decoded);
            }
        }

        return $this->modulesFromText($text);
    }

    private function modulesFromText(string $text): array
    {
        $modules = [];
        $parts = preg_split('/[,;|\/]+/', $text) ?: [$text];

        foreach ($parts as $part) {
            $normalized = preg_replace('/[^A-Z0-9]+/', '', strtoupper(trim($part)));

            if ($normalized === '') {
                continue;
            }

            if (in_array($normalized, ['ALL', 'BOTH', 'ADMIN', 'FULLACCESS'], true)) {
                $modules[] = self::MODULE_STORE_PORTAL;
                $modules[] = self::MODULE_COMMISSARY;
                continue;
            }

            if (
                str_contains($normalized, 'STOREPORTAL') ||
                str_contains($normalized, 'STOREORDER') ||
                str_contains($normalized, 'STOREORDERING') ||
                str_contains($normalized, 'STOREFORECAST') ||
                $normalized === 'STORE' ||
                $normalized === 'SP'
            ) {
                $modules[] = self::MODULE_STORE_PORTAL;
            }

            if (
                str_contains($normalized, 'COMMISSARY') ||
                str_contains($normalized, 'COMISSARY') ||
                str_contains($normalized, 'COMMISARY') ||
                str_contains($normalized, 'COMISARY') ||
                str_contains($normalized, 'COMMISARRY') ||
                in_array($normalized, ['CM', 'COM', 'COMM', 'COMMI', 'CMS', 'CMSRY', 'CMY'], true)
            ) {
                $modules[] = self::MODULE_COMMISSARY;
            }
        }

        return $modules;
    }

    private function isTruthy(mixed $value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_numeric($value)) {
            return (float) $value !== 0.0;
        }

        $normalized = preg_replace('/[^A-Z0-9]+/', '', strtoupper(trim((string) $value)));

        return in_array($normalized, ['Y', 'YES', 'TRUE', 'T', '1', 'ALLOW', 'ALLOWED', 'ENABLE', 'ENABLED', 'ACTIVE', 'A'], true);
    }

    private function moduleLabel(string $module): string
    {
        return match ($module) {
            self::MODULE_COMMISSARY => 'Commissary',
            self::MODULE_STORE_PORTAL => 'Store Portal',
            default => $module,
        };
    }
}
