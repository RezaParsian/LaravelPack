<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
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

/**
 * @param string $message
 * @param array $data
 * @param string $file
 */
function customLog(string $message, array $data, string $file = "custom"): void
{
    Log::build([
        'driver' => 'single',
        'path' => storage_path("logs/$file.log")
    ])->info($message, $data);
}

/**
 * @param UploadedFile|null $file
 * @param string $path
 * @return string|null
 */
function uploadFile(?UploadedFile $file, string $path = "uploads/"): ?string
{
    if (!$file)
        return null;

    $imageName = uniqid() . "." . $file->getClientOriginalExtension();
    $file->move(public_path($path), $imageName);

    return $path . $imageName;
}
