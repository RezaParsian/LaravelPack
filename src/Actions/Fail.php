<?php

namespace Rp76\LaravelPack\Actions;

use Illuminate\Support\Facades\Response;

class Fail
{
    /**
     * @param string $message
     * @param int $status
     * @param array|null $errors
     * @return object
     */
    public function handel(string $message, int $status, ?array $errors): object
    {
        return Response::error(__($message), $errors, $status);
    }
}