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
        $event = $result[0];
        $output = array(
            'eventId' => $event->getEventId(),
            'categoryId' => $event->getCategoryId(),
            'eventNo' => $event->getEventNo(),
            'name' => $event->getName(),
            'poster' => $event->getPoster(),
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
            'tickets' => $event->getTickets(),
            'categoryName' => $event->getCategory()
                                    ->getName()
        );
        
        echo json_encode($output);
        
        // $eventData = array(function ($event) {
        //     return array(
        //         'eventId' => $event->getEventId(),
        //         'categoryId' => $event->getCategoryId(),
        //         'eventNo' => $event->getEventNo(),
        //         'name' => $event->getName(),
        //         'poster' => $event->getPoster(),
        //         'venue' => $event->getVenue(),
        //         'registerStartDate' => $event->getRegisterStartDate(),
        //         'registerEndDate' => $event->getRegisterEndDate(),
        //         'eventStartDate' => $event->getEventStartDate(),
        //         'eventEndDate' => $event->getEventEndDate(),
        //         'description' => $event->getDescription(),
        //         'vipTicketQty' => $event->getVipTicketQty(),
        //         'standardTicketQty' => $event->getStandardTicketQty(),
        //         'budgetTicketQty' => $event->getBudgetTicketQty(),
        //         'vipTicketPrice' => $event->getVipTicketPrice(),
        //         'standardTicketPrice' => $event->getStandardTicketPrice(),
        //         'budgetTicketPrice' => $event->getBudgetTicketPrice(),
        //         'organizerName' => $event->getOrganizerName(),
        //         'organizerPhone' => $event->getOrganizerPhone(),
        //         'organizerMail' => $event->getOrganizerMail(),
        //         'status' => $event->getStatus(),
        //         'createdDate' => $event->getCreatedDate(),
        //         'createdBy' => $event->getCreatedBy(),
        //         'updatedDate' => $event->getUpdatedDate(),
        //         'updatedBy' => $event->getUpdatedBy(),
        //         'category' => $event->getCategory(),
        //         'tickets' => $event->getTickets(),
        //     );
        // }, $result);
        // echo json_encode($eventData);
        // $result = $result[0]; //array -> object
        // echo $result->getEventNo();
        // echo $result->getEventId();
        // echo json_decode(json_encode($result));
        // $output = json_encode($result);
        // echo gettype($result);
        // echo json_encode($result);
        // echo json_encode($result);
        // echo json_encode($result, JSON_UNESCAPED_UNICODE);
    } catch (Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $ex->getMessage();
        echo $e;
    }
}
