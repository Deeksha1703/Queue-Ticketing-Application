<!--
    Author: Deeksha Sridhar
    Last Modified: 13/09/2022

    File that contains the Stack class

    A stack is a linear data structure in which operations are performed in a specific order. The order can be LIFO (last in, first out) 
    or FILO (First In Last Out).
-->
<?php
include 'Apps/interface/IQueuable.php';
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
?>