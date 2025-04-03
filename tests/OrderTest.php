
<?php
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{            public function tearDown():void
    {
        Mockery::close();
    }

    // public function testOrderIsProcessed()
    // {

    //     $gateway = $this->createMock('PaymentGateWay');

    //     $order = new Order($gateway);

    //     $order->amount = 200;

    //     $this->assertTrue($order->process());
    // }

    public function testOrderIsProcessedUsingMockery()
    {

        $gateway = Mockery::mock('PaymentGateWay');

        $gateway->shouldReceive('charge')
                ->once()
                ->with(200)
                ->andReturn(true);

        $order = new Order($gateway);

        $order->amount = 200;

        $this->assertTrue($order->process());

    }
}