<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['eventId'])) {
            throw new Exception("Event is not set.");
        }

        $eventId = json_decode($_GET['eventId']);
        $event = new Event();
        $event->setEventId($eventId);

        $result = Read::Read($event);
        $result = $result[0];
        $output = array(
            'eventId' => $result->getEventId(),
            'categoryId' => $result->getCategoryId(),
            'eventNo' => $result->getEventNo(),
            'name' => $result->getName(),
            'poster' => $result->getPoster(),
            'venue' => $result->getVenue(),
            'registerStartDate' => $result->getRegisterStartDate(),
            'registerEndDate' => $result->getRegisterEndDate(),
            'eventStartDate' => $result->getEventStartDate(),
            'eventEndDate' => $result->getEventEndDate(),
            'description' => $result->getDescription(),
            'vipTicketQty' => $result->getVipTicketQty(),
            'standardTicketQty' => $result->getStandardTicketQty(),
            'budgetTicketQty' => $result->getBudgetTicketQty(),
            'vipTicketPrice' => $result->getVipTicketPrice(),
            'standardTicketPrice' => $result->getStandardTicketPrice(),
            'budgetTicketPrice' => $result->getBudgetTicketPrice(),
            'organizerName' => $result->getOrganizerName(),
            'organizerPhone' => $result->getOrganizerPhone(),
            'organizerMail' => $result->getOrganizerMail(),
            'status' => $result->getStatus(),
            'createdDate' => $result->getCreatedDate(),
            'createdBy' => $result->getCreatedBy(),
            'updatedDate' => $result->getUpdatedDate(),
            'updatedBy' => $result->getUpdatedBy(),
            'category' => $result->getCategory(),
            'tickets' => $result->getTickets(),
            'categoryName' => $result->getCategory()
                                    ->getName(),
            'posterPath' => $_SERVER['DOCUMENT_ROOT'] . $result->posterPath() . $result->getPoster()
        );
        // optimize to nested..xml? support complex..but js

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
