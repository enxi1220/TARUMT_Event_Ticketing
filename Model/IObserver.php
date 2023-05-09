<?php
require_once 'Subject.php';

interface IObserver {
    public function update(Subject $subject);
}