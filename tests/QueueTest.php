<?php

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testNewQueueIsEmpty(): Queue
    {
        $queue = new Queue;

        $this->assertSame(0, $queue->getCount());

        return $queue;
    }

    #[Depends('testNewQueueIsEmpty')]
    public function testAnItemIsAddedToTheQueue(Queue $queue): Queue
    {
        $queue->push('hello');

        $this->assertSame(1, $queue->getCount());

        return $queue;
    }

    #[Depends('testAnItemIsAddedToTheQueue')]
    public function testAnItemIsRemovedFromTheQueue(Queue $queue): void
    {
        $item = $queue->pop();

        $this->assertSame(0, $queue->getCount());
        $this->assertSame('hello', $item);
    }
}