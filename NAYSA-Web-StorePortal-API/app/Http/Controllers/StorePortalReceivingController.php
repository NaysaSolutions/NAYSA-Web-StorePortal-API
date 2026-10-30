<?php

namespace App\Http\Controllers;

use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use JsonException;
use Throwable;

class StorePortalReceivingController extends Controller
{
    /**
     * Load confirmed and supplementary Store Portal lines for one order date.
     * Only lines already linked to a valid, non-cancelled DR are returned.
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'storeCode' => ['required', 'string', 'max:100'],
            'orderDate' => ['required', 'date_format:Y-m-d'],
        ]);

        try {
            $result = $this->executeProcedure('LoadReceivingItems', $validated);

            return response()->json([
                'data' => is_array($result) && array_is_list($result) ? $result : [],
            ]);
        } catch (DomainException $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (Throwable $exception) {
            Log::error('Unable to load Store Portal receiving items.', [
                'storeCode' => $validated['storeCode'],
                'orderDate' => $validated['orderDate'],
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Unable to load received items. Please try again.',
            ], 500);
        }
    }

    /**
     * Save one receiving batch. Multiple partial receipts are allowed, but the
     * accumulated received quantity cannot exceed the Store Order detail qty.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'userCode' => ['required', 'string', 'max:100'],
            'storeCode' => ['required', 'string', 'max:100'],
            'orderDate' => ['required', 'date_format:Y-m-d'],
            'receivedDate' => ['required', 'date_format:Y-m-d'],
            'remarks' => ['nullable', 'string', 'max:500'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.lineId' => ['required', 'integer', 'min:1'],
            'details.*.receivedQty' => ['required', 'numeric', 'min:0'],
            'details.*.forceClose' => ['sometimes', 'boolean'],
        ], [
            'details.*.receivedQty.required' => 'Enter a received quantity for every selected item.',
            'details.*.receivedQty.numeric' => 'Received quantity must be a valid number.',
            'details.*.receivedQty.min' => 'Received quantity cannot be less than 0.',
        ]);

        foreach ($validated['details'] as $index => $detail) {
            $receivedQty = (float) $detail['receivedQty'];
            $forceClose = filter_var(
                $detail['forceClose'] ?? false,
                FILTER_VALIDATE_BOOLEAN
            );

            if ($forceClose && $receivedQty !== 0.0) {
                throw ValidationException::withMessages([
                    "details.{$index}.receivedQty" =>
                        'Received quantity must be 0 when Force Close is selected.',
                ]);
            }

            if (!$forceClose && $receivedQty < 0.000001) {
                throw ValidationException::withMessages([
                    "details.{$index}.receivedQty" =>
                        'Received quantity must be greater than 0 unless Force Close is selected.',
                ]);
            }
        }

        // Only send server-required values. Item, DR, order, and quantity
        // snapshots are read again from SQL and are never trusted from React.
        $parameters = [
            'userCode' => trim($validated['userCode']),
            'storeCode' => trim($validated['storeCode']),
            'orderDate' => $validated['orderDate'],
            'receivedDate' => $validated['receivedDate'],
            'remarks' => trim((string) ($validated['remarks'] ?? '')),
            'details' => array_map(
                static fn (array $detail): array => [
                    'lineId' => (int) $detail['lineId'],
                    'receivedQty' => (float) $detail['receivedQty'],
                    'forceClose' => filter_var(
                        $detail['forceClose'] ?? false,
                        FILTER_VALIDATE_BOOLEAN
                    ),
                ],
                $validated['details']
            ),
        ];

        try {
            $result = $this->executeProcedure('SaveReceivingItems', $parameters);

            return response()->json(is_array($result) ? $result : [
                'message' => 'Received items saved successfully.',
            ]);
        } catch (DomainException $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (Throwable $exception) {
            Log::error('Unable to save Store Portal receiving items.', [
                'storeCode' => $validated['storeCode'],
                'orderDate' => $validated['orderDate'],
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Unable to save received items. Please try again.',
            ], 500);
        }
    }

    /**
     * @throws DomainException
     * @throws JsonException
     */
    private function executeProcedure(string $mode, array $data): array
    {
        $params = json_encode(
            ['json_data' => $data],
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        $rows = DB::select(
            'EXEC dbo.sproc_PHP_StorePortalReceiving @mode = ?, @params = ?',
            [$mode, $params]
        );

        $row = $rows[0] ?? null;
        $json = $row?->result ?? $row?->RESULT ?? null;

        if (!is_string($json) || trim($json) === '') {
            return [];
        }

        $result = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        if (is_array($result) && isset($result['errorMessage'])) {
            throw new DomainException((string) $result['errorMessage']);
        }

        return is_array($result) ? $result : [];
    }
}
