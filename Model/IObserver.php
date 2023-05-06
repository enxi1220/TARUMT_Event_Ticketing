<?php
require_once 'ISubject.php';

interface IObserver {
    public function update(Subject $subject);
}