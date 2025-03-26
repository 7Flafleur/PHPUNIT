<?php


class Queue
{

    protected $items = [];

    public function push($item):void
    {
        $this->items[] = $item;
    }


    public function pop()
    {
        return array_shift($this->items);
    }


    public function getCount():int
    {
        return count($this->items);
    }
}
