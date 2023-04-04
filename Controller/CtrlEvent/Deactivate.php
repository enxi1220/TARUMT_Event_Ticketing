<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Deactivate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['event'])) {
            throw new Exception("No event is selected.");
        }

        $data = json_decode($_POST['event']);
        // todo: rm hard code
        $data->updatedBy = "Kuma";
        
        $event = new Event();
        $event
            ->setEventId($data->eventId)
            ->setEventNo($data->eventNo)
            ->setUpdatedBy($data->updatedBy);

        Deactivate::Deactivate($event);
        
        echo "Event {$event->getEventNo()} is deactivated.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
