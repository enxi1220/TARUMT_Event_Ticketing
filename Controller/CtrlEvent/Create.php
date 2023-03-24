<?php

#  Author: Lim En Xi
// collect value from front end
// validation without database

include $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Create.php";
include $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

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
        // rm hard code
        $data->createdBy = "Kuma";

        $event = new Event();
        $event->setName($data->name)
            ->setPoster($data->posterPath)
            ->setCategoryId($data->categoryId)
            ->setVenue($data->venue)
            ->setRegisterStartDate($data->registerStartDate)
            ->setRegisterEndDate($data->registerEndDate)
            ->setEventStartDate($data->eventStartDate)
            ->setEventEndDate($data->eventEndDate)
            ->setDescripton($data->description)
            ->setVipTicketQty($data->vipTicketQty)
            ->setStandardTicketQty($data->stdTicketQty)
            ->setBudgetTicketQty($data->bgtTicketQty)
            ->setVipTicketPrice($data->vipTicketPrice)
            ->setStandardTicketPrice($data->stdTicketPrice)
            ->setBudgetTicketPrice($data->bgtTicketPrice)
            ->setOrganizerName($data->organizerName)
            ->setOrganizerMail($data->organizerPhone)
            ->setOrganizerPhone($data->organizerMail)
            ->setCreatedBy($data->createdBy);

        Create::Create($event);
        echo "Event is added";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
    }
}
