<?php

#  Author: Vinnie Chin Loh Xin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/RESTfulAPI.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/LoginUser.php";

$action = $_GET["action"] ?? "";
if ($action !== "Summary" && $action !== "Read") {
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
    case "Create":
        create($data);
        break;
    default:
        RESTfulAPI::response(400, "Bad Request");
        break;
}

function create($data) {
    
}

function read() {

    $bookingId = $_GET['bookingId'] ?? 0;
    $booking = new Booking();
    $booking->setBookingId($bookingId);

    $result = BookingRead::Read($booking);

    if (empty($result)) {
        RESTfulAPI::response(404, "Data Not Found", null);
        return;
    }
    $result = $result[0];

    $bookingDetails = array();

    foreach ($result->getPayment()->getPaymentDetails() as $paymentDetail) {
        $bookingDetails[] = array(
            'ticketNo' => $paymentDetail->getTicketNo(),
            'ticketPrice' => $paymentDetail->getTicketPrice()
        );
    }



    $output = array(
        'bookingId' => $result->getBookingId(),
        'bookingNo' => $result->getBookingNo(),
        'eventId' => $result->getEventId(),
        'userId' => $result->getUserId(),
        'createdBy' => $result->getCreatedBy(),
        'createdDate' => $result->getCreatedDate(),
        'ticketCount' => $result->getTicketCount(),
        'bookingDetails' => $bookingDetails,
        'price' => $result->getPayment()->getPrice(),
        'customerMail' => $result->getUser()->getMail(),
        'customerPhone' => $result->getUser()->getPhone(),
        'eventNo' => $result->getEvent()->getEventNo(),
        'eventName' => $result->getEvent()->getName(),
        'poster' => $result->getEvent()->getPoster(),
        'venue' => $result->getEvent()->getVenue(),
        'eventStartDate' => $result->getEvent()->getEventStartDate(),
        'eventEndDate' => $result->getEvent()->getEventEndDate(),
        'posterPath' => $result->getEvent()->posterPath() . $result->getEvent()->getPoster()
    );

    RESTfulAPI::response(200, "Data Found", $output);
}

function summary() {
    // todo: move to login process
//    $loginUser = new LoginUser();
//    $loginUser->setLoginUser("enxi");
    // ----------

    $booking = new Booking();

    if (isset($_SESSION['userId'])) {
        // todo: get session user, rm hardcode
        $booking->setUserId($_SESSION['userId']);
        $booking->setCreatedBy($_SESSION['username']);
    }

    $result = BookingRead::Read($booking);

    $output = array_map(function ($booking) {

        return array(
    'bookingId' => $booking->getBookingId(),
    'bookingNo' => $booking->getBookingNo(),
    'eventId' => $booking->getEventId(),
    'userId' => $booking->getUserId(),
    'createdBy' => $booking->getCreatedBy(),
    'createdDate' => $booking->getCreatedDate(),
    'ticketCount' => $booking->getTicketCount(),
    'price' => $booking->getPayment()->getPrice(),
    'eventNo' => $booking->getEvent()->getEventNo(),
    'eventName' => $booking->getEvent()->getName(),
    'poster' => $booking->getEvent()->getPoster(),
    'venue' => $booking->getEvent()->getVenue(),
    'eventStartDate' => $booking->getEvent()->getEventStartDate(),
    'eventEndDate' => $booking->getEvent()->getEventEndDate(),
    'posterPath' => $booking->getEvent()->posterPath() . $booking->getEvent()->getPoster()
        );
    }, $result);

    RESTfulAPI::response(200, "Data Found", $output);
}

function getRequestBody($data) {
    
}
