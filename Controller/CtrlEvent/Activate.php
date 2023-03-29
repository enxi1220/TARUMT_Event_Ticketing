<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Activate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['event'])) {
            throw new Exception("No event is selected.");
        }

        $data = json_decode($_POST['event']);
        // rm hard code
        $data->updatedBy = "Kuma";
        
        $event = new Event();
        $event
            ->setEventId($data->eventId)
            ->setEventNo($data->eventNo)
            ->setUpdatedBy($data->updatedBy);   

        Activate::Activate($event);
        
        echo "Event {$event->getEventNo()} is activated successfully";
    } catch (Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
