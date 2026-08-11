<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupplementaryOrderController extends Controller
{
    private function runSupplementarySproc(Request $request, string $mode, array $jsonData)
    {
        $this->authorizeModuleAccess($request, self::MODULE_STORE_PORTAL);

        $params = json_encode([
            'json_data' => $jsonData,
        ]);

        $rows = DB::connection('tenant')->select(
            'EXEC dbo.sproc_PHP_StorePortalOrder @mode = ?, @params = ?',
            [$mode, $params]
        );

        if (count($rows) === 0) {
            return [];
        }

        if (!isset($rows[0]->result)) {
            return json_decode(json_encode($rows), true);
        }

        $decoded = json_decode($rows[0]->result, true);
        $procedureError = null;

        if (is_array($decoded)) {
            if (isset($decoded['errorNumber'])) {
                $procedureError = $decoded;
            } elseif (isset($decoded[0]) && is_array($decoded[0]) && isset($decoded[0]['errorNumber'])) {
                $procedureError = $decoded[0];
            }
        }

        if ($procedureError) {
            throw new HttpResponseException(response()->json([
                'message' => $procedureError['errorMessage'] ?? 'Supplementary Order procedure error.',
                'errors' => $procedureError,
            ], 422));
        }

        return $decoded ?? [];
    }

    public function loadSupplementary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userCode' => 'nullable|string|max:100',
            'storeCode' => 'required|string|max:100',
            'storeType' => 'required|string|max:100',
            'deliveryDate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid supplementary item request.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->runSupplementarySproc($request, 'LoadSupplementary', [
            'userCode' => $request->userCode,
            'storeCode' => trim((string) $request->storeCode),
            'storeType' => trim((string) $request->storeType),
            'deliveryDate' => Carbon::parse($request->deliveryDate)->toDateString(),
        ]);

        return response()->json([
            'message' => 'Supplementary items loaded successfully.',
            'data' => $data,
        ]);
    }

    public function submitSupplementaryOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userCode' => 'required|string|max:100',
            'storeCode' => 'required|string|max:100',
            'storeType' => 'required|string|max:100',
            'deliveryDate' => 'required|date',
            'details' => 'required|array|min:1',
            'details.*.itemCode' => 'required|string|max:100',
            'details.*.itemName' => 'nullable|string|max:255',
            'details.*.categCode' => 'nullable|string|max:100',
            'details.*.uomCode' => 'nullable|string|max:50',
            'details.*.deliveryDate' => 'required|date',
            'details.*.orderQty' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid supplementary order data.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $deliveryDate = Carbon::parse($request->deliveryDate)->toDateString();
        $details = collect($request->details)
            ->map(function (array $row) use ($deliveryDate) {
                $lineDate = Carbon::parse($row['deliveryDate'])->toDateString();

                if ($lineDate !== $deliveryDate) {
                    throw new HttpResponseException(response()->json([
                        'message' => 'All supplementary line dates must match the selected Delivery Date.',
                    ], 422));
                }

                return [
                    'itemCode' => trim((string) $row['itemCode']),
                    'itemName' => trim((string) ($row['itemName'] ?? '')),
                    'categCode' => trim((string) ($row['categCode'] ?? '')),
                    'uomCode' => trim((string) ($row['uomCode'] ?? '')),
                    'deliveryDate' => $lineDate,
                    'orderQty' => (float) $row['orderQty'],
                ];
            })
            ->values()
            ->all();

        $data = $this->runSupplementarySproc($request, 'SubmitSupplementaryOrder', [
            'userCode' => trim((string) $request->userCode),
            'storeCode' => trim((string) $request->storeCode),
            'storeType' => trim((string) $request->storeType),
            'deliveryDate' => $deliveryDate,
            'orderType' => 'SupplementaryOrder',
            'details' => $details,
        ]);

        return response()->json([
            'message' => 'Supplementary Order submitted successfully.',
            'data' => $data,
        ]);
    }
}
