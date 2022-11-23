<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;

class ApiResource
{
    private string $code;
    private mixed $message;
    private string $status;

    public function __construct(string $code, mixed $message, string $status = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->status = $status;
    }


    public function toArray()
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
        ];
    }

    public function responseApiMessage(): JsonResponse
    {
        return response()->json($this->toArray(), $this->status);
    }
}
