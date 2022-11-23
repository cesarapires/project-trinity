<?php

namespace App\Exceptions;

class ApiMessages
{
    private array $info = [];

    public function __construct(string $message = null, array $data = [])
    {
        if (!empty($message)) {
            $this->info['error'] = $message;
        }
        if (!empty($data)) {
            $this->info['errors'] = $data;
        }
    }

    public function getInfo(): array
    {
        return $this->info;
    }

}
