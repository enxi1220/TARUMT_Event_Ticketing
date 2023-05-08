<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/BookingRead.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $booking = new Booking();
        // todo: get session user, rm hardcode
//        $booking->setUserId($_SESSION['userId']);
//        $booking->setCreatedBy($_SESSION['username']);
        if (isset($_SESSION['userId'])) {
            // todo: get session user, rm hardcode
            $booking->setUserId($_SESSION['userId']);
            $booking->setCreatedBy($_SESSION['username']);
        }

        $result = BookingRead::Read($booking);

        $output = array_map(function ($booking) {
           
            return array(
        'bookingId' => $booking->getBookingId(),
        'bookingNo' => $booking->getBookingNo(),
        'eventId' => $booking->getEventId(),
        'userId' => $booking->getUserId(),
        'createdBy' => $booking->getCreatedBy(),
        'createdDate' => $booking->getCreatedDate(),
        'ticketCount' => $booking->getTicketCount(),
        'price' => $booking->getPayment()->getPrice(),
        'eventNo' => $booking->getEvent()->getEventNo(),
        'eventName' => $booking->getEvent()->getName(),
        'poster' => $booking->getEvent()->getPoster(),
        'venue' => $booking->getEvent()->getVenue(),
        'eventStartDate' => $booking->getEvent()->getEventStartDate(),
        'eventEndDate' => $booking->getEvent()->getEventEndDate(),
        'posterPath' => $booking->getEvent()->posterPath() . $booking->getEvent()->getPoster()
            );
        }, $result);

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}


