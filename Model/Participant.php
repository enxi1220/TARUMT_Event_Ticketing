<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Participant
 *
 * @author Tan Lin Yi
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

class Participant {
    private $userId;
    private $username;
    private $name;
    private $phone;
    private $mail;
    
    private $event;
    private $eventId;
    private $eventNo;
    
    public function getUserId() {
        return $this->userId;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getUsername() {
        return $this->username;
    }



    public function getPhone() {
            return $this->phone;
    }

    public function getMail() {
        return $this->mail;
    }
    
    public function getEvent()
    {
        return $this->event;
    }
    
    public function getEventId()
    {
        return $this->eventId;
    }
    
        public function getEventNo()
    {
        return $this->eventNo;
    }


    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }
    
        public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }
    
        public function setEventId($eventId)
    {
        $this->eventId = $eventId;
        return $this;
    }
    
        public function setEventNo($eventNo)
    {
        $this->eventNo = $eventNo;
        return $this;
    }




}

