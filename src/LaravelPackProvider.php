<?php

namespace Rp76\LaravelPack;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Rp76\LaravelPack\Response as RpResponse;

class LaravelPackProvider extends ServiceProvider
{
    public function register(): void
    {
        Response::macro('success', function ($data, string $message, int $status, array $headers = []) {
            return new RpResponse([
                'status' => true,
                'message' => $message,
                'info' => key_exists('resource', (array)$data) ? $data->response()->getData() : $data
            ], $status, array_merge(
                [
                    'version' => config('app.version'),
                    'app_name' => config('app.name')
                ],
                $headers
            ));
        });

        Response::macro('error', function ($message, ?array $errors, $status, array $headers = []) {
            return new RpResponse([
                'status' => false,
                'message' => $message,
                'errors' => $errors
            ], $status, array_merge(
                [
                    'version' => config('app.version'),
                    'app_name' => config('app.name')
                ],
                $headers
            ));
        });
    }

    public function boot():void
    {
        $this->publishesMigrations([
            __DIR__ . '/migrations' => database_path('migrations'),
        ]);

        $this->publishes([
            __DIR__ . '/stubs' => base_path('stubs'),
        ]);

        Model::preventLazyLoading();
        JsonResource::withoutWrapping();
    }
}