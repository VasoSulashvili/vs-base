<?php

namespace VS\Base;


use Illuminate\Support\ServiceProvider;
use VS\Base\Exceptions\APIException;
use VS\Base\Exceptions\APIExceptionHandler;

class VSBaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(APIExceptionHandler::class, APIExceptionHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        $this->app->make(\Illuminate\Contracts\Debug\ExceptionHandler::class)->reportable(function (Throwable $e) {
//            if ($e instanceof ModelNotFoundException) {
//                Log::error('Model not found: ' . $e->getMessage());
//                // Handle the specific exception, or rethrow
//            }
//            elseif ($e instanceof NotFoundHttpException) {
//                Log::error('Route not found: ' . $e->getMessage());
//                // Handle the NotFoundHttpException or rethrow
//            } else {
//                // Log other general exceptions or handle them differently
//                Log::error('Unhandled exception: ' . $e->getMessage());
//            }
//        });

        $this->app->make(\Illuminate\Contracts\Debug\ExceptionHandler::class)->renderable(function (\Throwable $e, $request) {
            if ($e instanceof APIException) {
                return response()->json([
                    'status' => false,
                    'message' => 'An error occurred.',
                    'errors' => $e->getMessage(),
                ], $e->getCode());
            } elseif ($e instanceof \Throwable) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ], 500);
            }
        });
    }
}
