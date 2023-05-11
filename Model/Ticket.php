<?php

/**
 * Description of Ticket
 *
 * @author enxil
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/ITicketFactory.php";

abstract class Ticket implements ITicketFactory
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
    private $count;
    private $requestedAmount;

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

    public function getCount()
    {
        return $this->count;
    }

    public function getRequestedAmount()
    {
        return $this->requestedAmount;
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

    public function setUpdatedDate($updatedDate = null)
    {
        $args = func_get_args();

        switch (count($args)) {
            case 0:
                $this->updatedDate = DateHelper::GetMalaysiaDateTime();
                break;
            case 1:
                $this->updatedDate = $updatedDate;
                break;
            default:
                // Invalid number of arguments
                break;
        }

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

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    public function setRequestedAmount($requestedAmount)
    {
        $this->requestedAmount = $requestedAmount;
        return $this;
    }

    public function isAvailable(Ticket $ticket): bool
    {
        return !($ticket->getCount() < $ticket->getRequestedAmount());
    }

    abstract function prefix();
    abstract function description();
    abstract function type();
}
