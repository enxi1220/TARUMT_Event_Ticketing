<?php

/**
 * Description of Ticket
 *
 * @author enxil
 */
abstract class Ticket {
    private $ticketId;
    private $eventId;
    private $ticketNo;
    private $owner;
    private $status;
    private $updatedDate;
    private $updatedBy;
    
    public function __construct($eventId) {
        $this->eventId = $eventId;
    }
    
    public function getTicketId() {
        return $this->ticketId;
    }

    public function getEventId() {
        return $this->eventId;
    }

    public function getTicketNo() {
        return $this->ticketNo;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    public function setTicketId($ticketId): void {
        $this->ticketId = $ticketId;
    }

    public function setEventId($eventId): void {
        $this->eventId = $eventId;
    }

    public function setTicketNo($ticketNo): void {
        $this->ticketNo = $ticketNo;
    }

    public function setOwner($owner): void {
        $this->owner = $owner;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setUpdatedDate($updatedDate): void {
        $this->updatedDate = $updatedDate;
    }

    public function setUpdatedBy($updatedBy): void {
        $this->updatedBy = $updatedBy;
    }

    abstract function ticketPrefix();
}

