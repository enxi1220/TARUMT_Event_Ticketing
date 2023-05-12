<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllParticipant/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Participant.php";

/**
 * @author Tan Lin Yi
 */
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['eventId'])) {
            throw new Exception("Event is not set.");
        }

        $eventId = json_decode($_GET['eventId']);

        $participant = new Participant();
        $participant->setEventId($eventId);

        $result = ParticipantRead::Read($participant);

        $output = array_map(function ($participant) {
            return array(
                'username' => $participant->getUsername(),
                'name' => $participant->getName(),
                'phone' => $participant->getPhone(),
                'mail' => $participant->getMail()
            );
        }, $result);

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e;
    }
}
