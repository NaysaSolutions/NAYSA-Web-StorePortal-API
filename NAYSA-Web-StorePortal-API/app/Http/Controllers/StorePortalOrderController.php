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
    private const CACHE_PREFIX = 'store_portal_order:v1';

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

            return $decoded ?? [];
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
            'details' => 'required|array|min:1',
            'details.*.itemCode' => 'required|string',
            'details.*.itemName' => 'nullable|string',
            'details.*.uomCode' => 'nullable|string',
            'details.*.deliveryDate' => 'required|date',
            'details.*.orderQty' => 'required|numeric|min:0',
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

        $details = collect($request->details)
            ->filter(fn ($row) => !empty($row['itemCode']) && !empty($row['deliveryDate']))
            ->map(function ($row) {
                return [
                    'itemCode' => trim((string) ($row['itemCode'] ?? '')),
                    'itemName' => trim((string) ($row['itemName'] ?? '')),
                    'uomCode' => trim((string) ($row['uomCode'] ?? '')),
                    'deliveryDate' => Carbon::parse($row['deliveryDate'])->toDateString(),
                    'orderQty' => (float) ($row['orderQty'] ?? 0),
                ];
            })
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
            'startDate' => Carbon::parse($request->startDate)->toDateString(),
            'endDate' => Carbon::parse($request->endDate)->toDateString(),
            'orderType' => $request->orderType,
            'details' => $details,
        ]);

        $this->bumpStorePortalOrderCacheVersion($request->storeCode);

        return response()->json([
            'message' => 'Weekly forecast submitted successfully.',
            'data' => $result,
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

    public function querySummary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'orderType' => 'required|in:WeeklyForecast,ConfirmedOrder',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid query parameters.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->execStorePortalSproc($request, 'QuerySummary', [
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'orderType' => $request->orderType,
        ]);

        return response()->json([
            'message' => 'Summary loaded successfully.',
            'data' => $data,
        ]);
    }

    public function queryDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'orderType' => 'required|in:WeeklyForecast,ConfirmedOrder',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid query parameters.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->execStorePortalSproc($request, 'QueryDetail', [
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'orderType' => $request->orderType,
        ]);

        return response()->json([
            'message' => 'Detail loaded successfully.',
            'data' => $data,
        ]);
    }
}
