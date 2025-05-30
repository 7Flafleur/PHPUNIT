<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\once;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        $user = new User;

        $user->first_name = "Teresa";
        $user->surname = "Green";

        $this->assertEquals('Teresa Green', $user->getFullName());
    }

    public function testFullNameIsEmptyByDefault()
    {
        $user = new User;

        $this->assertEquals('', $user->getFullName());
    }

    public function testNotificationIsSent()
    {
        $user = new User;

        //returns same object type as original class
        $mock_mailer = $this->createMock(Mailer::class);


        $mock_mailer->expects($this->once()) // Matcher tests if method has benn called
                    ->method('sendMessage')
                    ->with($this->equalTo('test@example.com'), $this->equalTo('Hello'))
                    ->willReturn(true);

        $user->setMailer($mock_mailer);

        $user->email = 'test@example.com';

        $this->assertTrue($user->notify("Hello"));

    }

    public function testCannotNotifyUserWithNoEmail()
    {
        $user = new User;

        // builds mock with stubs,too, but
        $mock_mailer = $this->getMockBuilder(Mailer::class)
                            // lets you pick which methods to stub
                            ->onlyMethods([])
                            ->getMock();

        $user->setMailer($mock_mailer);

        $this->expectException(Exception::class);

        $user->notify("Hello");

    }


}



