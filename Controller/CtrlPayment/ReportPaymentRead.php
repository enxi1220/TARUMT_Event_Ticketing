<?php

/* 
 * Author : Ong Wi Lin 
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayment/PaymentRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/CtrlPayment/PaymentRead.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
//        if (!isset($_GET['payment_id'])) {
//            throw new Exception("Payment is not set.");
//        }
        
        $payment = new Payment();

        $result = PaymentRead::ReportRead($payment);

        if (empty($result)) {
            exit;
        }

        // Construct output array for each payment
        $output = array();
        foreach ($result as $payment) {

                    $output[] = array(
                        'price' => $payment->getPrice(),
                        'created_date' => $payment->getCreatedDate(),
                    );
                }
        

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e;
    }
}

