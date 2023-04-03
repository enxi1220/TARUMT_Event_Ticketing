<?php
#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllTicket/ReadNewQuantity.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    try{
        if (!isset($_POST['ticket'])) {
            throw new Exception("Please fill in quantity");
        }

        $ticket = json_decode($_POST['ticket']);

        $vip = new TicketVIP;
        $vip
            ->setRequestedAmount($ticket->vipTicketQty)
            ->setEventId($ticket->eventId);

        $std = new TicketStandard;
        $std->setRequestedAmount($ticket->stdTicketQty);

        $bgt = new TicketBudget;
        $bgt->setRequestedAmount($ticket->bgtTicketQty);

        $result =  ReadNewQuantity::Read($vip, $std, $bgt);

        echo "Please proceed with payment to complete transaction.";

    } catch (Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        // echo $e;
    }
}