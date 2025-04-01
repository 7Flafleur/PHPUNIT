<?php


class Queue
{

    protected $items = [];

    // append to the end of the array
    public function push($item):void
    {
        $this->items[] = $item;
    }


    public function pop()
    {
        //removes item from the beginning of the array
        return array_shift($this->items);
    }


    public function getCount():int
    {
        return count($this->items);
    }

    public function clear()
    {
        $this->items=[];
    }
}
