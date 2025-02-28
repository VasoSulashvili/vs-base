<?php

declare(strict_types=1);

namespace VS\Base\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;

class APIExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception): JsonResponse
    {
//        dd($exception);
        return response()->json([
            'status'  => false,
            'error'   => $exception->getMessage(),
            'message' => 'An error occurred.',
        ], $exception->getCode());
    }
}
