<?php
session_start();
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
// Serialize the event object
$serializedEvent = serialize($event);

// Store the serialized event in the session
$_SESSION['event'] = $serializedEvent;

    echo "Event $eventNo is added.";
//
//    ob_start(); // start output buffering
//
//
//    // flush the output buffer
//    ob_end_flush();
//
//    $event->attach(new User());
//    $event->notify();
//

//         $eventData = serialize($event);
//$eventData = str_replace("\0", "", $eventData);
//$command = "php NotifyScript.php ".escapeshellarg($eventData)." > /dev/null 2>&1 &";
//$returnValue = 0;
//$output = array();
//exec($command, $output, $returnValue);
//
//if ($returnValue !== 0) {
//    // Handle error
//    echo "Error: Unable to execute command";
//    // You may also want to log the error message and/or the return value
//}
//         $eventData = serialize($event);
//$eventData = str_replace("\0", "", $eventData);
//$eventDataEncoded = base64_encode($eventData);
//$command = "php notify_script.php $eventDataEncoded > /dev/null 2>&1 &";
//exec($command);
//         
//         $eventData = base64_encode(serialize($event));
//$command = "php notify_script.php $eventData > /dev/null 2>&1 &";
//exec($command);
//         $eventData = serialize($event);
//         $eventData = json_encode($event);
//$eventData = str_replace("\0", "", $eventData);
//$command = "php notify_script.php $eventData > /dev/null 2>&1 &";
//exec($command);
//// Serialize the $event object
//$event_data = serialize($event);
//
//// Pass the serialized $event object as an argument
//exec("php notify_script.php '$event_data' > /dev/null 2>&1 &");
//         exec("php notify_script.php $event > /dev/null 2>&1 &");
        // fork a child process to execute notify() method
//    $pid = pcntl_fork();
//    if ($pid == -1) {
//        throw new Exception("Failed to fork process.");
//    } else if ($pid == 0) {
//        // child process
//        $event->attach(new User());
//        $event->notify();
//        exit(0);
//    }
////
//         // Turn on output buffering
//    ob_start();
//
//    // Print success message
//    echo "Event $eventNo is added.";
//
//    // Flush the output buffer to send the success message to the browser
//    ob_flush();
//    flush();
//
//    // Allow the script to continue executing even if the user aborts the connection
//    ignore_user_abort(true);
//
//    // Call notify() method
//    $event->attach(new User());
//    $event->notify();
//        register_shutdown_function('notify_event', $event);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}

//function notify_event(Event $event) {
//
//    $event->attach(new User());
//    $event->notify();
//}
