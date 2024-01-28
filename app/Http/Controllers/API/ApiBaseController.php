<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('localization');
    }
    public function successResponse($data, $message = '', $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ], $code);
    }
    public function errorResponse($message, $code)
    {
        return response()->json([
            'error' => $message,
            'code' => $code
        ], $code);
    }
}
