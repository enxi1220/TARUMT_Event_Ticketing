<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayment/PaymentSummary.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $payment = new Payment();
        $result = PaymentRead::Read($payment);
        $output = array_map(
            function ($payment) {
                return array(
                    'payment_id' => $payment->getPaymentId(),
                    'payment_no' => $payment->getPaymentNo(),
                    'booking_id' => $payment->getBookingId(),
                    'payment_type' => $payment->getPaymentType(),
                    'price' => $payment->getPrice(),
                    'created_date' => date('Y-m-d H:i:s', strtotime($payment->getCreatedDate()))
                        );
            },
            $result
        );

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e;
    }
}
