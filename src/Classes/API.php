<?php

namespace VS\Base\Classes;

class API
{
    public static function response(mixed $data = [], bool $status = true, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error(string $message, int $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }

}
