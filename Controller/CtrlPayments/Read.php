<?php

/* 
 * Author : Ong Yi Chween
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayments/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['bookingId'])) {
            throw new Exception("Payment is not set.");
        }

        $bookingId = json_decode($_GET['bookingId']);
        $payment = new Payment();
        $payment->setBookingId($bookingId);

        $result = PaymentsRead::Read($payment);
        
        if (empty($result)) {
            throw new Exception("Data Not Found");
        }
        
        $result = $result[0];
            
        $output = array(
            'payment_id' => $result->getPaymentId(),
            'payment_no' => $result->getPaymentNo(),
            'payment_type' => $result->getPaymentType(),
            'price' => $result->getPrice(),
            'created_date' => $result->getCreatedDate()
        );
    
        echo json_encode($output);
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        //echo $e->getCode(). " " . $e->getMessage();
    }
}
