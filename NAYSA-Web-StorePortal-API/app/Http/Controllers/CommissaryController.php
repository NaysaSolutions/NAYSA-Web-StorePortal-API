<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;

class CommissaryController extends Controller
{
    private function execCommissarySproc(string $mode, array $jsonData = []): array
    {
        $params = json_encode([
            'json_data' => $jsonData,
        ]);

        $rows = DB::connection('tenant')->select(
            'EXEC dbo.sproc_PHP_CommissaryForecast @mode = ?, @params = ?',
            [$mode, $params]
        );

        if (count($rows) === 0) {
            return [];
        }

        if (!isset($rows[0]->result)) {
            return json_decode(json_encode($rows), true) ?: [];
        }

        $decoded = json_decode($rows[0]->result, true);

        if ($decoded === null && $rows[0]->result !== null && $rows[0]->result !== '') {
            throw new HttpResponseException(response()->json([
                'message' => 'Invalid JSON returned by Commissary Forecast procedure.',
                'raw' => $rows[0]->result,
            ], 422));
        }

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
                'message' => $sprocError['errorMessage'] ?? 'Commissary Forecast procedure error.',
                'errors' => $sprocError,
            ], 422));
        }

        return $decoded ?: [];
    }

    public function getCategories(Request $request)
    {
        $data = $this->execCommissarySproc('CategoryList');

        return response()->json([
            'message' => 'Commissary categories loaded successfully.',
            'data' => $data,
        ]);
    }

    public function getSummary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'category' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid commissary summary query parameters.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->execCommissarySproc('QuerySummary', [
            'startDate' => Carbon::parse($request->startDate)->toDateString(),
            'endDate' => Carbon::parse($request->endDate)->toDateString(),
            'category' => $request->filled('category') ? $request->category : 'All',
        ]);

        return response()->json([
            'message' => 'Commissary summary loaded successfully.',
            'data' => $data,
        ]);
    }

    public function getDetailed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'category' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid commissary detailed query parameters.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $this->execCommissarySproc('QueryDetailed', [
            'startDate' => Carbon::parse($request->startDate)->toDateString(),
            'endDate' => Carbon::parse($request->endDate)->toDateString(),
            'category' => $request->filled('category') ? $request->category : 'All',
        ]);

        return response()->json([
            'message' => 'Commissary detail loaded successfully.',
            'data' => $data,
        ]);
    }
}
