<?php

namespace Exceptions;

use App\Exceptions\ApiMessages;
use PHPUnit\Framework\TestCase;

class ApiMessagesTest extends TestCase
{
    private $message = 'Message title';
    private $data = ['error' => 'error message'];

    public function testGetInfo()
    {
        $apiMessage = new ApiMessages($this->message, $this->data);

        $expectMessage = [
          'error' => $this->message,
          'errors' => $this->data
        ];

        $this->assertEquals($expectMessage, $apiMessage->getInfo());

    }

    public function testShouldNotApiMessage()
    {
        $apiMessage = new ApiMessages();
        $this->assertTrue(empty($apiMessage->getInfo()));
    }
}
