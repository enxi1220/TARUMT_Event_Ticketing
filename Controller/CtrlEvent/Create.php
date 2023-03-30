<?php

#  Author: Lim En Xi
// collect value from front end
// validation without database

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

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
        $data = json_decode($_POST['event']);
        $data->poster = $poster;

        // todo: date from date to validation
        // if($data->registerStartDate > $data->registerEndDate){
        //     throw new Exception("Register start date should be earlier than register end date.");
        // }
        // if($data->registerStartDate > $data->eventStartDate){
        //     throw new Exception("Register start date should be earlier than event start date.");
        // }
        // if($data->eventStartDate > $data->eventEndDate){
        //     throw new Exception("Event start date should be earlier than event end date.");
        // }
        // if($data->registerStartDate < DateHelper::GetMalaysiaDateTime()){
        //     throw new Exception("Back date for is not allowed to select on register start date.");
        // }
        // if($data->eventStartDate < DateHelper::GetMalaysiaDateTime()){
        //     throw new Exception("Back date is not allowed to select on event start date.");
        // }

        // todo: rm hard code
        $data->createdBy = "Kuma";

        $event = new Event();
        $event
            ->setName($data->name)
            ->setPoster($data->poster)
            ->setCategoryId($data->categoryId)
            ->setVenue($data->venue)
            ->setRegisterStartDate($data->registerStartDate)
            ->setRegisterEndDate($data->registerEndDate)
            ->setEventStartDate($data->eventStartDate)
            ->setEventEndDate($data->eventEndDate)
            ->setDescription($data->description)
            ->setVipTicketQty($data->vipTicketQty)
            ->setStandardTicketQty($data->stdTicketQty)
            ->setBudgetTicketQty($data->bgtTicketQty)
            ->setVipTicketPrice($data->vipTicketPrice)
            ->setStandardTicketPrice($data->stdTicketPrice)
            ->setBudgetTicketPrice($data->bgtTicketPrice)
            ->setOrganizerName($data->organizerName)
            ->setOrganizerMail($data->organizerMail)
            ->setOrganizerPhone($data->organizerPhone)
            ->setCreatedBy($data->createdBy);

        $eventNo = Create::Create($event);
        echo "Event $eventNo is added";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
