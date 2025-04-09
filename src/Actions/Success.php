<?php

namespace Rp76\LaravelPack\Actions;

use Illuminate\Support\Facades\Response;

class Success
{
    /**
     * @param $data
     * @param int $status
     * @param string $message
     * @param array $headers
     * @return object
     */
    public function handle($data, int $status = 200, string $message = "info.received_successfully", array $headers = []): object
    {
        return Response::success($data, __($message), $status, $headers);
    }
}