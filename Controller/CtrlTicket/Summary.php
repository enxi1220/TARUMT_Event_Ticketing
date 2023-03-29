<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllTicket/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['eventId'])) {
            throw new Exception("Event is not set.");
        }

        $eventId = json_decode($_GET['eventId']);
        
        // cincai put a concrete class...
        $ticket = new TicketStandard();
        $ticket->setEventId($eventId);

        $result = Read::Read($ticket);
        
        $output = array_map(function ($ticket) {
            return array(
                'ticketId' => $ticket->getTicketId(),
                'eventId' => $ticket->getEventId(),
                'ticketNo' => $ticket->getTicketNo(),
                'owner' => $ticket->getOwner(),
                'status' => $ticket->getStatus(),
                'updatedDate' => $ticket->getUpdatedDate(),
                'updatedBy' => $ticket->getUpdatedBy(),
                'eventNo' => $ticket->getEvent()
                    ->getEventNo(),
                'eventName' => $ticket->getEvent()
                    ->getName(),
                'description' => $ticket->description()
            );
        }, $result);

        echo json_encode($output);
    } catch (Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
