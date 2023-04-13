<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        if (!isset($_POST['ticket'])) {
            throw new Exception("Please fill in quantity.");
        }

        $data = json_decode($_POST['ticket']);

        // todo: rm hard code
        $data->userId = 1;
        $data->createdBy = "John Doe";

        $booking = new Booking();
        $booking->setEventId($data->eventId);
        $booking->setCreatedBy($data->createdBy);
        $booking->setUserId($data->userId);
        
        $event = new Event();
        $booking->setEvent($event->setEventId($data->eventId));

        $vip = new TicketVIP;
        $vip->setRequestedAmount($data->vipTicketQty);

        $std = new TicketStandard;
        $std->setRequestedAmount($data->stdTicketQty);

        $bgt = new TicketBudget;
        $bgt->setRequestedAmount($data->bgtTicketQty);

        Create::Create($booking, $vip, $std, $bgt);
        echo "You have successfully purchase the ticket(s).";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
