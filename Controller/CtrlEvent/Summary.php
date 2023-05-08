<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $event = new Event();
        $result = Read::Read($event);
        $output = array_map(
            function ($event) {
                return array(
                    'eventId' => $event->getEventId(),
                    'categoryId' => $event->getCategoryId(),
                    'eventNo' => $event->getEventNo(),
                    'name' => $event->getName(),
                    'poster' => $event->posterPath() . $event->getPoster(),
                    'venue' => $event->getVenue(),
                    'registerStartDate' => $event->getRegisterStartDate(),
                    'registerEndDate' => $event->getRegisterEndDate(),
                    'eventStartDate' => $event->getEventStartDate(),
                    'eventEndDate' => $event->getEventEndDate(),
                    'description' => $event->getDescription(),
                    'vipTicketQty' => $event->getVipTicketQty(),
                    'standardTicketQty' => $event->getStandardTicketQty(),
                    'budgetTicketQty' => $event->getBudgetTicketQty(),
                    'vipTicketPrice' => $event->getVipTicketPrice(),
                    'standardTicketPrice' => $event->getStandardTicketPrice(),
                    'budgetTicketPrice' => $event->getBudgetTicketPrice(),
                    'organizerName' => $event->getOrganizerName(),
                    'organizerPhone' => $event->getOrganizerPhone(),
                    'organizerMail' => $event->getOrganizerMail(),
                    'status' => $event->getStatus(),
                    'createdDate' => $event->getCreatedDate(),
                    'createdBy' => $event->getCreatedBy(),
                    'updatedDate' => $event->getUpdatedDate(),
                    'updatedBy' => $event->getUpdatedBy(),
                    'category' => $event->getCategory(),
                    'tickets' => $event->getTickets()
                );
            },
            $result
        );

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
