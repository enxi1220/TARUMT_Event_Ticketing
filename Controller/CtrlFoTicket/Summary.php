<?php

#  Author: Tan Lin Yi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllFoTicket/Read.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['bookingId'])) {
            throw new Exception("Ticket not found.");
        }

       $bookingId = json_decode($_GET['bookingId']);

        $FoTicket = new FoTicket();
        $FoTicket->setBookingId($bookingId);

        $result = FoTicketRead::Read($FoTicket);
        
        $output = array_map(function ($FoTicket) {
            return array(
                'bookingDetailId' => $FoTicket->getBookingDetailId(),
                'bookingId' => $FoTicket->getBookingId(),
                'ticketId' => $FoTicket->getTicketId(),
                'ticketNo' => $FoTicket->getTicket() ->getTicketNo(),
                'eventId' => $FoTicket->getEvent()
                    ->getEventId(),
                'eventNo' => $FoTicket->getEvent()
                    ->getEventNo(),
                'eventName' => $FoTicket->getEvent()
                    ->getName(),
                'eventStartDate' => $FoTicket->getEvent()
                    ->getEventStartDate(),
                'poster' => $FoTicket->getEvent()
                    ->posterPath().$FoTicket->getEvent()
                    ->getPoster(),
            );
        }, $result);

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
