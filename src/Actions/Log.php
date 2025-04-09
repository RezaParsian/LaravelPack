<?php

namespace Rp76\LaravelPack\Actions;

use Illuminate\Support\Facades\Log as LogFacade;

class Log
{
    /**
     * @param string $message
     * @param array $data
     * @param string $file
     */
    public function handle(string $message, array $data, string $file = "custom"): void
    {
        LogFacade::build([
            'driver' => 'single',
            'path' => storage_path("logs/$file.log")
        ])->info($message, $data);
    }
}