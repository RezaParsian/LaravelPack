<?php

use Illuminate\Support\Facades\Response;

function success($data, string $message = "info.received_successfully", int $status = 200, array $headers = [])
{
    return Response::success($data, __($message), $status, $headers);
}

function error(string $message, ?array $errors, int $status)
{
    return Response::error(__($message), $errors, $status);
}
