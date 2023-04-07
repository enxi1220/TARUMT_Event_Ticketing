<?php

/**
 * Description of Booking
 *
 * @author enxil
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

class Booking
{

    private $bookingId;
    private $bookingNo;
    private $eventId;
    private $userId;
    private $createdBy;
    private $createdDate;

    private $bookingDetails = array();
    private User $user;
    private Payment $payment;
    private Event $event;

    public function __construct()
    {
    }

    public function getBookingId()
    {
        return $this->bookingId;
    }

    public function getBookingNo()
    {
        return $this->bookingNo;
    }

    public function getEventId()
    {
        return $this->eventId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function getBookingDetails()
    {
        return $this->bookingDetails;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }
    
    public function getEvent(): Event 
    {
        return $this->event;
    }

    public function setBookingId($bookingId): self
    {
        $this->bookingId = $bookingId;
        return $this;
    }

    public function setBookingNo($bookingNo): self
    {
        $this->bookingNo = $bookingNo == null ? UniqueNoHelper::RandomCode($this->prefix()) : $bookingNo;
        return $this;
    }

    public function setEventId($eventId): self
    {
        $this->eventId = $eventId;
        return $this;
    }

    public function setUserId($userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function setCreatedBy($createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setCreatedDate($createdDate = null): self
    {
        $this->createdDate = $createdDate == null ? DateHelper::GetMalaysiaDateTime() : $createdDate;
        return $this;
    }

    public function setBookingDetails($bookingDetails): self
    {
        $this->bookingDetails = $bookingDetails;
        return $this;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setPayment(Payment $payment): self
    {
        $this->payment = $payment;
        return $this;
    }
    
    public function setEvent(Event $event): self
    {
        $this->event = $event;
        return $this;
    }

    
    public function prefix()
    {
        return PrefixConstant::BOOKING;
    }
}
