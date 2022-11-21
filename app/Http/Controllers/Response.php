<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response as HttpResponse;

trait Response
{
    public function response(
        array|string|JsonResource $data = [],
        int                       $status = 200,
        array                     $headers = [],
        int                       $options = 0
    ): JsonResponse|\Illuminate\Http\Response
    {
        return HttpResponse::make($data, $status, $headers, $options);
    }
}
