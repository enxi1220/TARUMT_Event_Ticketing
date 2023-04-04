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
        $validExtensions = '/\.(jpg|jpeg|gif|png)$/i';
        $validMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];

        if (!preg_match($validExtensions, $poster['name']) || !in_array($poster['type'], $validMimeTypes)) {
            throw new Exception("Image with jpg, gif, and png format only.");
        }

        $data = json_decode($_POST['event']);
        $data->poster = $poster;

        // todo: rm hard code
        $data->updatedBy = "Kuma";

        $event = new Event();
        $event
            ->setEventId($data->eventId)
            ->setEventNo($data->eventNo)
            ->setName($data->name)
            ->setStatus($data->status)
            ->setPoster($data->poster)
            ->setCategoryId($data->categoryId)
            ->setVenue($data->venue)
            ->setRegisterStartDate($data->registerStartDate)
            ->setRegisterEndDate($data->registerEndDate)
            ->setEventStartDate($data->eventStartDate)
            ->setEventEndDate($data->eventEndDate)
            ->setDescription($data->description)
            ->setVipTicketPrice($data->vipTicketPrice)
            ->setStandardTicketPrice($data->stdTicketPrice)
            ->setBudgetTicketPrice($data->bgtTicketPrice)
            ->setOrganizerName($data->organizerName)
            ->setOrganizerMail($data->organizerMail)
            ->setOrganizerPhone($data->organizerPhone)
            ->setUpdatedBy($data->updatedBy);

        $eventNo = Update::Update($event);
        echo "Event $eventNo is updated.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        // echo $e;
    }
}
