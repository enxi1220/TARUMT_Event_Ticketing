<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/Read.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        if (!isset($_GET['bookingId'])) {
            throw new Exception("Booking not found.");
        }

        $bookingId = json_decode($_GET['bookingId']);
        $booking = new Booking();
        $booking->setBookingId($bookingId);

        $result = Read::Read($booking);
        $result = $result[0];

        $bookingDetails = array();

        foreach ($result->getBookingDetails() as $bookingDetail) {
            $ticket = $bookingDetail->getTicket();
            $bookingDetails[] = array(
                'ticketNo' => $ticket->getTicketNo(),
//                'desc' => $ticket->description(),
//                'type' => $ticket->type(),
                
            );
        }

        $output = array(
            'bookingId' => $result->getBookingId(),
            'bookingNo' => $result->getBookingNo(),
            'eventId' => $result->getEventId(),
            'userId' => $result->getUserId(),
            'createdBy' => $result->getCreatedBy(),
            'createdDate' => $result->getCreatedDate(),
            'ticketCount' => $result->getTicketCount(),
            'bookingDetails' => $bookingDetails,
            'customerMail' => $result->getUser()->getMail(),
            'customerPhone' => $result->getUser()->getPhone(),
            'eventNo' => $result->getEvent()->getEventNo(),
            'eventName' => $result->getEvent()->getName(),
            'poster' => $result->getEvent()->getPoster(),
            'venue' => $result->getEvent()->getVenue(),
            'eventStartDate' => $result->getEvent()->getEventStartDate(),
            'eventEndDate' => $result->getEvent()->getEventEndDate(),
            'posterPath' => $result->getEvent()->posterPath() . $result->getEvent()->getPoster()
        );
        // optimize to nested..xml? support complex..but js

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}


