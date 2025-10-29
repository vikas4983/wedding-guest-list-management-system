<?php

namespace App\Http\responses;

class ApiResponse
{

    public static function success($data = null, $message = 'ok', $action =null,$status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'action' => $action,
            'editForm' => $data,
        ], $status);
    }

    public static function error($message = 'Something went wrong', $errors = null, $status = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }

    public static function created($data = null, $message = 'created')
    {
        return self::success($data, $message, 201);
    }

    public static function validation($errors, $message = 'Validation failed')
    {
        return self::error($errors, $message, 422);
    }
}
