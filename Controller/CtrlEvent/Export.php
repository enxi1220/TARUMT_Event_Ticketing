<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $event = new Event();
        $result = Read::Read($event);

        if (empty($result)) {
            exit;
        }

        // todo: specify needed elements
        $data = array();
        foreach ($result as $event) {
            $data[] = array(
                'Event No' => $event->getEventNo(),
                'Name' => $event->getName(),
                'Description' => $event->getDescription(),
                'Start Date' => $event->getRegisterStartDate(),
                'Venue' => $event->getVenue(),
                'Organizer' => $event->getOrganizerName(),
            );
        }

    // todo: cont. xml

    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
