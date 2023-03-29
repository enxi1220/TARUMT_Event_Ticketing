<?php

/**
 * Description of Ticket
 *
 * @author enxil
 */
abstract class Ticket
{
    private $ticketId;
    private $eventId;
    private $ticketNo;
    private $owner;
    private $status;
    private $updatedDate;
    private $updatedBy;

    private $event;
    private $eventNo;

    public function __construct()
    {
    }

    public function getTicketId()
    {
        return $this->ticketId;
    }

    public function getEventId()
    {
        return $this->eventId;
    }

    public function getTicketNo()
    {
        return $this->ticketNo;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getEventNo()
    {
        return $this->eventNo;
    }

    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;
        return $this;
    }

    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
        return $this;
    }

    public function setTicketNo($ticketNo)
    {
        $this->ticketNo = $ticketNo;
        return $this;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
        return $this;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    public function setEventNo($eventNo)
    {
        $this->eventNo = $eventNo;
        return $this;
    }

    abstract function prefix();
    abstract function description();
}
