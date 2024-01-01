<?php

namespace Rp76\LaravelPack;

use Illuminate\Http\JsonResponse;

class Response extends JsonResponse
{
    public bool $status;
    public object $json;

    public function __construct($data = null, $status = 200, $headers = [], $options = 0, $json = false)
    {
        $this->status = $status >= 200 && $status < 300;
        $this->json = (object)(@$data["data"] ?? []);
        parent::__construct($data, $status, $headers, $options, $json);
    }
}
