<?php

use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testMock()
    {
        // $mailer = new Mailer;
        // $result = $mailer->sendMessage('dave@example.com', 'Hello');



        $mock = $this->createMock(Mailer::class);

        // stubs (replace original method from mocked class ) return null by default, but can be customized
        $mock->method('sendMessage')
             ->willReturn(true);

        $result = $mock->sendMessage('dave@example.com', 'Hello');

         $this->assertTrue($result);


    }
}