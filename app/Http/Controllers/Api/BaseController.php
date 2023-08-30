<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected static array $response = [
        'status' => true,
        'message' => "OK",
        'data' => null,
    ];

    /**
     * @param $code
     * @param $status
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    public function response(
        $code, $status, $message, $data = null
    ): JsonResponse
    {
        self::$response['message'] = $message;
        self::$response['status'] = $status;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }
}
