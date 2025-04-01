<?php

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{

    protected $queue;

    //fixture
    protected function setUp(): void
    {
        $this->queue = new Queue;
    }

    //mainly used when creating external resources
    protected function tearDown(): void
    {
        unset($this->queue);
    }

    // test depended on = producer
    public function testNewQueueIsEmpty()
    {

        $this->assertSame(0, $this->queue->getCount());

    }

    // dependend test = consumer
    // #[Depends('testNewQueueIsEmpty')]
    public function testAnItemIsAddedToTheQueue()
    {
        $this->queue->push('hello');

        $this->assertSame(1, $this->queue->getCount());

    }

    //

    public function testAnItemIsRemovedFromTheQueue(): void
    {
        $this->queue->push('test');
        $item = $this->queue->pop();

        $this->assertSame(0, $this->queue->getCount());
        $this->assertSame('test', $item);
    }


    public function testAnItemIsRemovedFromTheFrontOfTheQueue()
    {

    }



}