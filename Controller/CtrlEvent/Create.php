<?php

#  Author: Lim En Xi

include $_SERVER['DOCUMENT_ROOT']."/TARUMT_Event_Ticketing/BusinessLogic/BllEent/Create.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    try {
        if (!isset($_POST['event'])) {
            throw new Exception("Event is not set.");
        }
        if (!isset($_FILES['poster'])) {
            throw new Exception("Please upload event poster");
        }

        $event = json_decode($_POST['event']);
        $event->poster = $_FILES['poster'];
        $ext = pathinfo($event->poster['name'], PATHINFO_EXTENSION);
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png') {
            throw new Exception("Image with jpg, gif and png format ONLY.");
        }

        echo $event->poster;
        Create::Create($event);
        echo "Event is added";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
    }
}
