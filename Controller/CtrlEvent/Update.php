<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
//in progress, no done yet
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['event'])) {
            throw new Exception("Event information is not complete.");
        }

        if (!isset($_FILES['poster'])) {
            throw new Exception("Please upload event poster");
        }

        $poster = $_FILES['poster'];
        $ext = pathinfo($poster['name'], PATHINFO_EXTENSION);

        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png') {
            throw new Exception("Image with jpg, gif and png format only.");
        }

        $uniqueName = uniqid() . '.' . strtolower($ext);
        $data = json_decode($_POST['event']);
        $data->posterPath = '/TARUMT_Event_Ticketing/Web/Poster/' . $uniqueName;
        $data->poster = $data->posterPath;
        // todo: rm hard code
        $data->updatedBy = "Kuma";

        $event = new Event();
        $event
            ->setEventId($data->eventId)
            ->setEventNo($data->eventNo)
            ->setName($data->name)
            ->setStatus($data->status)
            ->setPoster($data->posterPath)
            ->setCategoryId($data->categoryId)
            ->setVenue($data->venue)
            ->setRegisterStartDate($data->registerStartDate)
            ->setRegisterEndDate($data->registerEndDate)
            ->setEventStartDate($data->eventStartDate)
            ->setEventEndDate($data->eventEndDate)
            ->setDescription($data->description)
            // ->setVipTicketQty($data->vipTicketQty)
            // ->setStandardTicketQty($data->stdTicketQty)
            // ->setBudgetTicketQty($data->bgtTicketQty)
            ->setVipTicketPrice($data->vipTicketPrice)
            ->setStandardTicketPrice($data->stdTicketPrice)
            ->setBudgetTicketPrice($data->bgtTicketPrice)
            ->setOrganizerName($data->organizerName)
            ->setOrganizerMail($data->organizerMail)
            ->setOrganizerPhone($data->organizerPhone)
            ->setUpdatedBy($data->updatedBy);

        $eventNo = Update::Update($event);
        echo "Event $eventNo is updated";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        // echo $e;
    }
}

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
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $ex->getMessage();
        echo $e;
    }
}
