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

// Stack class which implements the IQueuable interface
class Stack implements IQueuable
{
    // declaring variables
    private $queue = [];
    private $size = 0;

    /*
    Function to add value to the queue and return the new queue. The item will be added to the top of the stack
    Parameters:
        - value: String to be added to the queue
    Returns:
        - queue: The new queue which contains the added value
    */
    public function enqueue(string $value): mixed {
        $this->queue[] = $value;
        $this->size++;
        return $this->queue;
    }

    /* Function to remove item from the queue and return the item removed. The item will be removed from the top of the stack
    Parameters: 
        - None
    Returns:
        - The item which is removed
    */
    public function dequeue(): string {
        $this->size--;
        return array_pop($this->queue);
    }

    /* Function which returns a list of all the items in the queue
    Paramters:
        - None
    Returns:
        - List of items in the queue
    */
    public function getQueue(): mixed {
        return $this->queue;
    }

    /* Function which returns the number of items in the queue
    Paramters:
        - None
    Returns:
        - size: Number of items in the array
    */
    public function size(): int {
        return $this->size;
    }

}

// Queue class which implements the IQueuable interface
class Queue implements IQueuable
{
    // declaring variables
    private $queue = [];
    private $size = 0;

     /*
    Function to add value to the queue and return the new queue. The item will be inserted at the end of the queue called the rear. 
    Parameters:
        - value: String to be added to the queue
    Returns:
        - queue: The new queue which contains the added value
    */
    public function enqueue(string $value): mixed {
        $this->queue[] = $value;
        $this->size++;
        return $this->queue;
    }

    /* Function to remove item from the queue and return the item removed. The item will be removed from the front of the queue. 
    Parameters: 
        - None
    Returns:
        - The item which is removed
    */
    public function dequeue(): string {
        $this->size--;
        return array_shift($this->queue);
    }

    /* Function which returns a list of all the items in the queue
    Paramters:
        - None
    Returns:
        - List of items in the queue
    */
    public function getQueue(): mixed {
        return $this->queue;
    }

    /* Function which returns the number of items in the queue
    Paramters:
        - None
    Returns:
        - size: Number of items in the array
    */
    public function size(): int {
        return $this->size;
    }

}

?>