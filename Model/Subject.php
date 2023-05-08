<?php

require_once 'IObserver.php';

class Subject
{
    private $observers;

    public function __construct()
    {
        $this->observers = array();
    }

    public function attach(IObserver $observer)
    { //register the observer
        array_push($this->observers, $observer);
    }

    public function detach(IObserver $observer)
    {
        $index = 0;
        foreach ($this->observers as $o) {
            if ($o == $observer) {
                array_splice($this->observers, $index);
            }
            $index++;
        }
    }

    public function notify()
    {
        foreach ($this->observers as $o) {
            $o->update($this);
        }
    }
}