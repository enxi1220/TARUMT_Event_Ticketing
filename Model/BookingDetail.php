<?php

/**
 * Description of BookingDetail
 *
 * @author enxil
 */

 require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";

class BookingDetail
{
    private $bookingDetailId;
    private $bookingId;
    private $ticketId;
    private Ticket $ticket;

    public function __construct()
    {
    }

    public function getBookingDetailId()
    {
        return $this->bookingDetailId;
    }

    public function getBookingId()
    {
        return $this->bookingId;
    }

    public function getTicketId()
    {
        return $this->ticketId;
    }
    
    public function getTicket()
    {
        return $this->ticket;
    }
    
    public function setBookingDetailId($bookingDetailId): self
    {
        $this->bookingDetailId = $bookingDetailId;
        return $this;
    }

    public function setBookingId($bookingId): self
    {
        $this->bookingId = $bookingId;
        return $this;
    }

    public function setTicketId($ticketId): self
    {
        $this->ticketId = $ticketId;
        return $this;
    }
    
    public function setTicket($ticket): self
    {
        $this->ticket = $ticket;
        return $this;
    }
}
