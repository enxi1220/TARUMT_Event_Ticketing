<?php

/**
 * Description of Booking
 *
 * @author enxil
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/BookingDetail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

class FoTicket
{

    private $bookingId;
    private $bookingNo;
    private $eventId;
    private $createdBy;
    private $createdDate;
    private $ticketCount;
    private $bookingDetailId;
    private $bookingDetails = array();
    private Ticket $ticket;
    private $ticketId;
    private $ticketNo;
    
    private $event;
    private $eventNo;
    private $eventName;
    
    
    
        public function getBookingDetailId()
    {
        return $this->bookingDetailId;
    }
    
    public function getBookingId() {
        return $this->bookingId;
    }

    public function getBookingNo() {
        return $this->bookingNo;
    }

    public function getEventId() {
        return $this->eventId;
    }
    public function getEventName() {
        return $this->eventName;
    }


    public function getCreatedBy() {
        return $this->createdBy;
    }

    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function getTicketCount() {
        return $this->ticketCount;
    }

    public function getBookingDetails() {
        return $this->bookingDetails;
    }

    public function getTicketId() {
        return $this->ticketId;
    }

    public function getEvent() {
        return $this->event;
    }

    public function getTicketNo() {
        return $this->ticketNo;
    }

        public function getEventNo()
    {
        return $this->eventNo;
    }
        public function getTicket(): Ticket {
        return $this->ticket;
    }

    public function getBooking(): Booking {
        return $this->booking;
    }

    public function getBookingDetail(): BookingDetail {
        return $this->bookingDetail;
    }

    public function setTicket(Ticket $ticket) {
        $this->ticket = $ticket;
        return $this;
    }

    public function setBooking(Booking $booking){
        $this->booking = $booking;
        return $this;
    }

    public function setBookingDetail(BookingDetail $bookingDetail){
        $this->bookingDetail = $bookingDetail;
        return $this;
    }


    public function setBookingId($bookingId){
        $this->bookingId = $bookingId;
        return $this;
    }

    public function setBookingNo($bookingNo){
        $this->bookingNo = $bookingNo;
        return $this;
    }

    public function setEventName($eventName) {
            $this->eventName = $eventName;
            return $this;
        }

    public function setCreatedBy($createdBy){
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
        return $this;
    }

    public function setTicketCount($ticketCount){
        $this->ticketCount = $ticketCount;
        return $this;
    }

    public function setBookingDetails($bookingDetails){
        $this->bookingDetails = $bookingDetails;
        return $this;
    }
    public function setTicketId($ticketId) {
        $this->ticketId = $ticketId;
        return $this;
    }

    public function setEvent($event) {
        $this->event = $event;
        return $this;
    }

    public function setTicketNo($ticketNo) {
        $this->ticketNo = $ticketNo;
        return $this;
    }
        public function setBookingDetailId($bookingDetailId)
    {
        $this->bookingDetailId = $bookingDetailId;
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
