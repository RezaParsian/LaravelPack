<?php

use Illuminate\Support\Facades\Response;

/**
 * @param $data
 * @param int $status
 * @param string $message
 * @param array $headers
 * @return mixed
 */
function success($data, int $status = 200, string $message = "info.received_successfully", array $headers = [])
{
    return Response::success($data, __($message), $status, $headers);
}

/**
 * @param string $message
 * @param int $status
 * @param array|null $errors
 * @return mixed
 */
function error(string $message, int $status, ?array $errors)
{
    return Response::error(__($message), $errors, $status);
}
