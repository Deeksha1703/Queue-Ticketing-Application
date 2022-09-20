<!--
    Author: Deeksha Sridhar
    Last Modified: 13/09/2022

    File that contains the IQueuable interface along with the Stack and Queue classes which implement the IQueuable interface.

    An interface specifies a contract that a class must follow. Any class that implements a given interface is expected to behave 
    consistently in terms of what can be called, how it can be called, and what is returned.

    A stack is a linear data structure in which operations are performed in a specific order. The order can be LIFO (last in, first out) 
    or FILO (First In Last Out).

    A queue is a linear data structure that is open at both ends and performs operations in First In First Out (FIFO) order. A queue is 
    defined as a list in which all additions to the list occur at one end and all deletions occur at the other. 
-->
<?php

// IQueuable interface
interface IQueuable 
{
    //adds value to queue and returns new queue
    public function enqueue(string $value): mixed;

    //removes item from queue, and returns the item removed
    public function dequeue(): string;

    //returns a list of all the items in the queue
    public function getQueue(): mixed;

    //returns the number of items in the queue
    public function size(): int;
}

?>