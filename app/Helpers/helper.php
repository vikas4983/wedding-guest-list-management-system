<?php


use App\Http\responses\ApiResponse;

if (!function_exists('api_success')) {
    function api_success($data = null, $message = 'ok', $action=null, $status = 200 )
    {
        return ApiResponse::success($data, $message, $action,$status);
    }
}

if (!function_exists('api_error')) {
    function api_error($message = 'Something went wrong', $errors = null, $status = 500)
    {
        return ApiResponse::error($message, $errors, $status);
    }
}

if (!function_exists('api_created')) {
    function api_created($data = null, $message = 'created')
    {
        return ApiResponse::created($data, $message);
    }
}
