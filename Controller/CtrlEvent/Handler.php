<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Activate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Deactivate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/RESTfulAPI.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/LoginUser.php";

$action = $_GET["action"] ?? "";
if ($action !== "Summary" && $action !== "Read"){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    if (empty($data)) {
        RESTfulAPI::response(404, "No data is submitted");
        exit;
    }
}

switch ($action) {
    case "Summary":
        summary();
        break;
    case "Read":
        read();
        break;
    case "Deactivate":
        deactivate($data);
        break;
    case "Activate":
        activate($data);
        break;
    case "Create":
        create($data);
        break;
    case "Update":
        update($data);
        break;
    default:
        RESTfulAPI::response(400, "Bad Request");
        break;
}

function update($data)
{
    $event = new Event();
    $event
        ->setEventId($data->eventId)
        ->setEventNo($data->eventNo)
        ->setName($data->name)
        ->setStatus($data->status)
        ->setPoster(get_object_vars($data->poster))
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

    try {
        $eventNo = Update::Update($event);
        RESTfulAPI::response(200, "Event $eventNo is updated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function create($data)
{
    $event = new Event();
    $event
        ->setName($data->name)
        ->setPoster(get_object_vars($data->poster))
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
    try {
        $eventNo = Create::Create($event);
        RESTfulAPI::response(200, "Event $eventNo is added.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function activate($data)
{
    $event = new Event();
    $event
        ->setEventId($data->eventId)
        ->setEventNo($data->eventNo)
        ->setUpdatedBy($data->updatedBy);
    try {
        Activate::Activate($event);
        RESTfulAPI::response(200, "Event {$event->getEventNo()} is activated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function deactivate($data)
{
    $event = new Event();
    $event
        ->setEventId($data->eventId)
        ->setEventNo($data->eventNo)
        ->setUpdatedBy($data->updatedBy);
    try {
        Deactivate::Deactivate($event);
        RESTfulAPI::response(200, "Event {$event->getEventNo()} is deactivated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function read()
{
    $eventId = $_GET['eventId'] ?? 0;
    $event = new Event();
    $event->setEventId($eventId);
    $result = EventRead::Read($event);

    if (empty($result)) {
        RESTfulAPI::response(404, "Data Not Found", null);
        return;
    }

    $result = $result[0];
    $output = array(
        'eventId' => $result->getEventId(),
        'categoryId' => $result->getCategoryId(),
        'eventNo' => $result->getEventNo(),
        'name' => $result->getName(),
        'poster' => $result->getPoster(),
        'venue' => $result->getVenue(),
        'registerStartDate' => $result->getRegisterStartDate(),
        'registerEndDate' => $result->getRegisterEndDate(),
        'eventStartDate' => $result->getEventStartDate(),
        'eventEndDate' => $result->getEventEndDate(),
        'description' => $result->getDescription(),
        'vipTicketQty' => $result->getVipTicketQty(),
        'standardTicketQty' => $result->getStandardTicketQty(),
        'budgetTicketQty' => $result->getBudgetTicketQty(),
        'vipTicketPrice' => $result->getVipTicketPrice(),
        'standardTicketPrice' => $result->getStandardTicketPrice(),
        'budgetTicketPrice' => $result->getBudgetTicketPrice(),
        'organizerName' => $result->getOrganizerName(),
        'organizerPhone' => $result->getOrganizerPhone(),
        'organizerMail' => $result->getOrganizerMail(),
        'status' => $result->getStatus(),
        'createdDate' => $result->getCreatedDate(),
        'createdBy' => $result->getCreatedBy(),
        'updatedDate' => $result->getUpdatedDate(),
        'updatedBy' => $result->getUpdatedBy(),
        'category' => $result->getCategory(),
        'tickets' => $result->getTickets(),
        'categoryName' => $result->getCategory()
            ->getName(),
        'posterPath' => $result->posterPath() . $result->getPoster()
    );

    RESTfulAPI::response(200, "Data Found", $output);
}

function summary()
{   
    // todo: move to login process
    // $loginUser = new LoginUser();
    // $loginUser->attach(new Event());
    // $loginUser->setLoginUser("enxi");
    // ----------

    $event = new Event();
    $result = EventRead::Read($event);

    $output = array_map(
        function ($event) {
            return array(
                'eventId' => $event->getEventId(),
                'categoryId' => $event->getCategoryId(),
                'eventNo' => $event->getEventNo(),
                'name' => $event->getName(),
                'poster' => $event->posterPath() . $event->getPoster(),
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
                'tickets' => $event->getTickets()
            );
        },
        $result
    );

    RESTfulAPI::response(200, "Data Found", $output);
}
