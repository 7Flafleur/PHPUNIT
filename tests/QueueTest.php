<?php

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{

    // static = belongs to class, shared across ll instances
    protected static $queue;

    //fixture, run before every single test method
    protected function setUp(): void
    {
        static::$queue->clear();
    }

    // //mainly used when creating external resources
    // protected function tearDown(): void
    // {
    //     unset($this->queue);
    // }

    // just executed once,before the first test. Called without creating an instance (static)
    public static function setUpBeforeClass(): void
    {
        // could be connection to a queue server
        static::$queue = new Queue;

    }

    // just executed once,after the last test
    public static function tearDownAfterClass(): void
    {
        // could be disconnection from a server,clos db connection
        static::$queue = null;
    }

    // test depended on = producer if no fixture is used
    public function testNewQueueIsEmpty()
    {

        $this->assertSame(0, static::$queue->getCount());

    }

    // dependend test = consumer
    // #[Depends('testNewQueueIsEmpty')]
    public function testAnItemIsAddedToTheQueue()
    {
        static::$queue->push('hello');

        $this->assertSame(1, static::$queue->getCount());

    }


    public function testAnItemIsRemovedFromTheQueue(): void
    {
        static::$queue->push('test');
        $item = static::$queue->pop();

        $this->assertSame(0, static::$queue->getCount());
        $this->assertSame('test', $item);
    }


    public function testAnItemIsRemovedFromTheFrontOfTheQueue()
    {
        static::$queue->push('first');
        static::$queue->push('second');

        $item = static::$queue->pop();
        $this->assertSame('first', $item);

    }



}