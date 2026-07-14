<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;

class StorePortalOrderController extends Controller
{
    private const CACHE_PREFIX = 'store_portal_order:v2';

    private function execStorePortalSproc(Request $request, string $mode, array $jsonData)
    {
        $this->authorizeModuleAccess($request, self::MODULE_STORE_PORTAL);

        return $this->runStorePortalSproc($mode, $jsonData);
    }

    private function cachedStorePortalSproc(Request $request, string $mode, array $jsonData, int $ttlSeconds)
    {
        $this->authorizeModuleAccess($request, self::MODULE_STORE_PORTAL);

        return Cache::remember(
            $this->storePortalCacheKey($mode, $jsonData),
            $ttlSeconds,
            fn () => $this->runStorePortalSproc($mode, $jsonData)
        );
    }

    private function runStorePortalSproc(string $mode, array $jsonData)
    {
        $params = json_encode([
            'json_data' => $jsonData
        ]);

        $rows = DB::connection('tenant')->select(
            "EXEC dbo.sproc_PHP_StorePortalOrder @mode = ?, @params = ?",
            [$mode, $params]
        );

        if (count($rows) === 0) {
            return [];
        }

        if (isset($rows[0]->result)) {
            $decoded = json_decode($rows[0]->result, true);

            $sprocError = null;
            if (is_array($decoded)) {
                if (isset($decoded['errorNumber'])) {
                    $sprocError = $decoded;
                } elseif (isset($decoded[0]) && is_array($decoded[0]) && isset($decoded[0]['errorNumber'])) {
                    $sprocError = $decoded[0];
                }
            }

            if ($sprocError) {
                throw new HttpResponseException(response()->json([
                    'message' => $sprocError['errorMessage'] ?? 'Store Portal Order procedure error.',
                    'errors' => $sprocError,
                ], 422));
            }

            $data = $decoded ?? [];

            // Some database versions return every saved Weekly Forecast
            // revision. Only return the newest row per Store + Item + Date to
            // the entry grid; the history endpoint intentionally keeps all rows.
            if ($mode === 'LoadWeeklyForecast' && is_array($data) && array_is_list($data)) {
                return $this->latestWeeklyForecastRows($data);
            }

            return $data;
        }

        return json_decode(json_encode($rows), true);
    }

    private function storePortalCacheKey(string $mode, array $jsonData): string
    {
        $payload = $this->normalizeCachePayload($jsonData);

        if (in_array($mode, ['LoadWeeklyForecast', 'LoadWeeklyForecastHistory', 'LoadConfirmation'], true)) {
            $payload['_storeCacheVersion'] = $this->storePortalOrderCacheVersion($jsonData['storeCode'] ?? '');
        }

        return self::CACHE_PREFIX . ':' . $mode . ':' . sha1(json_encode($payload));
    }

    private function normalizeCachePayload(array $payload): array
    {
        ksort($payload);

        foreach ($payload as $key => $value) {
            if (is_array($value)) {
                $payload[$key] = $this->normalizeCachePayload($value);
            }
        }

        return $payload;
    }

    private function latestWeeklyForecastRows(array $rows): array
    {
        $latestRows = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $storeCode = (string) $this->forecastRowValue($row, ['storeCode', 'STORE_CODE'], '');
            $itemCode = (string) $this->forecastRowValue(
                $row,
                ['itemCode', 'ITEM_CODE', 'item_code', 'ITEM_NO'],
                ''
            );
            $deliveryDate = (string) $this->forecastRowValue(
                $row,
                ['deliveryDate', 'DELIVERY_DATE', 'delivery_date', 'ORDER_DATE'],
                ''
            );

            if ($itemCode === '' || $deliveryDate === '') {
                continue;
            }

            try {
                $deliveryDate = Carbon::parse($deliveryDate)->toDateString();
            } catch (\Throwable $e) {
                // Keep the database value when it cannot be parsed.
            }

            $key = strtoupper(trim($storeCode))
                . '|' . strtoupper(trim($itemCode))
                . '|' . $deliveryDate;

            if (!isset($latestRows[$key]) || $this->isNewerForecastRow($row, $latestRows[$key])) {
                $latestRows[$key] = $row;
            }
        }

        return array_values($latestRows);
    }

    private function isNewerForecastRow(array $candidate, array $current): bool
    {
        $revisionFields = [
            ['forecastId', 'FORECAST_ID', 'forecast_id', 'ORDER_ID', 'orderId'],
            ['detailId', 'DETAIL_ID', 'detail_id', 'DT1_ID', 'dt1Id'],
            ['weeklyForecastNo', 'WEEKLY_FORECAST_NO', 'ORDER_NO', 'orderNo'],
        ];

        foreach ($revisionFields as $fields) {
            $candidateRevision = $this->forecastRevisionNumber($this->forecastRowValue($candidate, $fields));
            $currentRevision = $this->forecastRevisionNumber($this->forecastRowValue($current, $fields));

            if ($candidateRevision !== null && $currentRevision !== null && $candidateRevision !== $currentRevision) {
                return $candidateRevision > $currentRevision;
            }
        }

        $candidateTimestamp = $this->forecastRevisionTimestamp($candidate);
        $currentTimestamp = $this->forecastRevisionTimestamp($current);

        if ($candidateTimestamp !== null && $currentTimestamp !== null && $candidateTimestamp !== $currentTimestamp) {
            return $candidateTimestamp > $currentTimestamp;
        }

        // Keep the first row on a complete tie. The sproc normally returns
        // newest rows first, and this prevents an older duplicate overwriting it.
        return false;
    }

    private function forecastRowValue(array $row, array $keys, $default = null)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row) && $row[$key] !== null && $row[$key] !== '') {
                return $row[$key];
            }
        }

        return $default;
    }

    private function forecastRevisionNumber($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        if (preg_match('/(\d+)\s*$/', (string) $value, $matches) === 1) {
            return (float) $matches[1];
        }

        return null;
    }

    private function forecastRevisionTimestamp(array $row): ?int
    {
        $date = $this->forecastRowValue(
            $row,
            ['revisionDate', 'REVISION_DATE', 'DATE_STAMP', 'dateStamp', 'createdDate', 'CREATED_DATE']
        );
        $time = $this->forecastRowValue(
            $row,
            ['revisionTime', 'REVISION_TIME', 'TIME_STAMP', 'timeStamp'],
            '00:00:00'
        );

        if ($date === null) {
            return null;
        }

        $timestamp = strtotime(trim((string) $date) . ' ' . trim((string) $time));

        return $timestamp === false ? null : $timestamp;
    }

    private function storePortalOrderCacheVersion(string $storeCode): string
    {
        return (string) Cache::get($this->storePortalOrderCacheVersionKey($storeCode), '0');
    }

    private function bumpStorePortalOrderCacheVersion(string $storeCode): void
    {
        Cache::put($this->storePortalOrderCacheVersionKey($storeCode), now()->format('Uu'), now()->addDay());
    }

    private function storePortalOrderCacheVersionKey(string $storeCode): string
    {
        return self::CACHE_PREFIX . ':store-version:' . sha1(strtoupper(trim($storeCode)));
    }

    public function storeContext(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userCode' => 'nullable|string',
            'storeCode' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid store context request.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->cachedStorePortalSproc($request, 'GetStoreContext', [
            'userCode' => $request->userCode,
            'storeCode' => $request->storeCode,
        ], 600);

        return response()->json([
            'message' => 'Store context loaded successfully.',
            'data' => $data,
        ]);
    }

    public function items(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userCode' => 'nullable|string',
            'storeCode' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid request.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->cachedStorePortalSproc($request, 'GetItems', [
            'userCode' => $request->userCode,
            'storeCode' => $request->storeCode,
        ], 600);

        return response()->json([
            'message' => 'Items loaded successfully.',
            'data' => $data,
        ]);
    }

    public function loadWeeklyForecast(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'storeCode' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'orderType' => 'nullable|in:WeeklyForecast',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid weekly forecast request.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Retrieval is allowed for any date range so old/past saved quantities
        // can still be loaded. Saving is also allowed for any forecast day count.
        $data = $this->cachedStorePortalSproc($request, 'LoadWeeklyForecast', [
            'userCode' => $request->userCode,
            'storeCode' => $request->storeCode,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'orderType' => $request->orderType ?? 'WeeklyForecast',
        ], 60);

        return response()->json([
            'message' => 'Weekly forecast loaded successfully.',
            'data' => $data,
        ]);
    }

    public function loadWeeklyForecastHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'storeCode' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid weekly forecast history request.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // History retrieval may be more than seven days.
        $data = $this->cachedStorePortalSproc($request, 'LoadWeeklyForecastHistory', [
            'userCode' => $request->userCode,
            'storeCode' => $request->storeCode,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'orderType' => 'WeeklyForecast',
        ], 60);

        return response()->json([
            'message' => 'Weekly forecast history loaded successfully.',
            'data' => $data,
        ]);
    }

    public function saveWeeklyForecast(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userCode' => 'nullable|string',
            'storeCode' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'orderType' => 'required|in:WeeklyForecast',
            'changedOnly' => 'nullable|boolean',
            'details' => 'required|array|min:1',
            'details.*.itemCode' => 'required|string',
            'details.*.itemName' => 'nullable|string',
            'details.*.categCode' => 'nullable|string',
            'details.*.uomCode' => 'nullable|string',
            'details.*.deliveryDate' => 'required|date',
            'details.*.orderQty' => 'required|numeric|min:0',
            'details.*.previousOrderQty' => 'nullable|numeric|min:0',
            'details.*.isEdited' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid weekly forecast data.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $userCode = $request->filled('userCode')
            ? $request->userCode
            : (optional($request->user())->USER_CODE
                ?? optional($request->user())->userCode
                ?? optional($request->user())->USERID
                ?? optional($request->user())->name
                ?? 'SYSTEM');

        $startDate = Carbon::parse($request->startDate)->startOfDay();
        $endDate = Carbon::parse($request->endDate)->startOfDay();

        $details = collect($request->details)
            ->filter(fn ($row) => !empty($row['itemCode']) && !empty($row['deliveryDate']))
            ->map(function ($row) use ($startDate, $endDate) {
                $deliveryDate = Carbon::parse($row['deliveryDate'])->startOfDay();

                // Today is valid. Only dates outside the selected header range
                // are rejected so the SQL header and its detail rows stay aligned.
                if ($deliveryDate->lt($startDate) || $deliveryDate->gt($endDate)) {
                    throw new HttpResponseException(response()->json([
                        'message' => 'A forecast detail date is outside the selected date range.',
                        'errors' => [
                            'deliveryDate' => $deliveryDate->toDateString(),
                            'startDate' => $startDate->toDateString(),
                            'endDate' => $endDate->toDateString(),
                        ],
                    ], 422));
                }

                return [
                    'itemCode' => trim((string) ($row['itemCode'] ?? '')),
                    'itemName' => trim((string) ($row['itemName'] ?? '')),
                    'categCode' => trim((string) ($row['categCode'] ?? '')),
                    'uomCode' => trim((string) ($row['uomCode'] ?? '')),
                    'deliveryDate' => $deliveryDate->toDateString(),
                    'orderQty' => (float) ($row['orderQty'] ?? 0),
                    'previousOrderQty' => (float) ($row['previousOrderQty'] ?? 0),
                    'isEdited' => (bool) ($row['isEdited'] ?? true),
                ];
            })
            // Keep only the last edit if a browser submits the same item/date twice.
            ->keyBy(fn ($row) => strtoupper($row['itemCode']) . '|' . $row['deliveryDate'])
            ->values()
            ->all();

        if (count($details) === 0) {
            return response()->json([
                'message' => 'No valid weekly forecast details to submit.',
            ], 422);
        }

        $result = $this->execStorePortalSproc($request, 'SaveWeeklyForecast', [
            'userCode' => $userCode,
            'storeCode' => $request->storeCode,
            'startDate' => $startDate->toDateString(),
            'endDate' => $endDate->toDateString(),
            'orderType' => $request->orderType,
            'changedOnly' => $request->boolean('changedOnly', true),
            'details' => $details,
        ]);

        $this->bumpStorePortalOrderCacheVersion($request->storeCode);

        return response()->json([
            'message' => count($details) . ' forecast quantity change(s) saved successfully.',
            'data' => $result,
            'savedDetails' => $details,
        ]);
    }

    public function loadConfirmation(Request $request)
    {
        $request->merge([
            'deliveryDate' => $request->deliveryDate ?? $request->forecastDateOrder,
        ]);

        $validator = Validator::make($request->all(), [
            'storeCode' => 'required|string',
            'deliveryDate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid confirmation request.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->cachedStorePortalSproc($request, 'LoadConfirmation', [
            'userCode' => $request->userCode,
            'storeCode' => $request->storeCode,
            'deliveryDate' => $request->deliveryDate,
            'forecastDateOrder' => $request->deliveryDate,
        ], 30);

        return response()->json([
            'message' => 'Forecast loaded for confirmation.',
            'data' => $data,
        ]);
    }

    public function confirmOrder(Request $request)
    {
        $request->merge([
            'deliveryDate' => $request->deliveryDate ?? $request->forecastDateOrder,
        ]);

        $validator = Validator::make($request->all(), [
            'userCode' => 'required|string',
            'storeCode' => 'required|string',
            'deliveryDate' => 'required|date',
            'orderType' => 'required|in:ConfirmedOrder',
            'details' => 'required|array|min:1',
            'details.*.itemCode' => 'required|string',
            'details.*.itemName' => 'nullable|string',
            'details.*.uomCode' => 'nullable|string',
            'details.*.deliveryDate' => 'required|date',
            'details.*.orderQty' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid confirmation data.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $requestDeliveryDate = Carbon::parse($request->deliveryDate)->toDateString();

        $details = collect($request->details)
            ->filter(fn ($row) => (float) ($row['orderQty'] ?? 0) > 0)
            ->map(function ($row) use ($requestDeliveryDate) {
                $row['deliveryDate'] = Carbon::parse($row['deliveryDate'] ?? $requestDeliveryDate)->toDateString();
                return $row;
            })
            ->values()
            ->all();

        if (count($details) === 0) {
            return response()->json([
                'message' => 'No confirmed quantity to submit.',
            ], 422);
        }

        $headerDeliveryDate = collect($details)
            ->pluck('deliveryDate')
            ->filter()
            ->sort()
            ->first() ?? $requestDeliveryDate;

        $result = $this->execStorePortalSproc($request, 'ConfirmOrder', [
            'userCode' => $request->userCode,
            'storeCode' => $request->storeCode,
            'deliveryDate' => $headerDeliveryDate,
            'forecastDateOrder' => $headerDeliveryDate,
            'orderType' => $request->orderType,
            'details' => $details,
        ]);

        $this->bumpStorePortalOrderCacheVersion($request->storeCode);

        return response()->json([
            'message' => 'Order confirmed and transmitted to NAYSA Financials successfully.',
            'data' => $result,
        ]);
    }
}
