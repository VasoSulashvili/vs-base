<?php

namespace VS\Base;


use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use VS\Admin\Http\Middleware\AdminAuth;
use VS\Base\Exceptions\APIException;
use VS\Base\Exceptions\APIExceptionHandler;
use VS\Base\Http\Middleware\ForceJSONResponseMiddleware;

class VSBaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerMiddleware();

        $this->exceptionHandler();
    }

    protected function registerMiddleware()
    {
        $this->app['router']->aliasMiddleware('force.json', ForceJSONResponseMiddleware::class);
    }

    protected function exceptionHandler()
    {
        $this->app->make(\Illuminate\Contracts\Debug\ExceptionHandler::class)->renderable(function (\Throwable $e, $request) {
            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                    'errors' => 'Invalid client credentials.',
                ], 401);
            } elseif ($e instanceof APIException) {
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
