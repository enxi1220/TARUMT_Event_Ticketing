<?php
require_once 'Subject.php';
/**
 *
 * @author vinnie chin
 */
interface Observer {
    public function update(Subject $subject);
}
