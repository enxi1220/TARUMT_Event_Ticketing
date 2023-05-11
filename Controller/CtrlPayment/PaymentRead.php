<?php

/* 
 * Author : Ong Wi Lin
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayment/PaymentRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/PaymentDetail.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['payment_id'])) {
            throw new Exception("Payment is not set.");
        }

        $payment_id = json_decode($_GET['payment_id']);
        $payment = new Payment();
        $payment->setPaymentId($payment_id);

        $result = PaymentRead::Read($payment);

        if (empty($result)) {
            exit;
        }
        

//        foreach ($result->getPaymentDetails() as $paymentDetail) {
//           
//            $paymentArray[] = array(
//                'ticketNo' => $paymentDetail->getTicketNo(),
//                'ticketPrice' => $paymentDetail->getTicketPrice()
//
//            );
//        }
//        
        $paymentArray = array();

        foreach ($result as $payment) {
            
            foreach ($payment->getPaymentDetails() as $paymentDetail) {
        
                $paymentArray[] = array(
                    'ticketNo' => $paymentDetail->getTicketNo(),
                    'ticketPrice' => $paymentDetail->getTicketPrice()

                );
            }
             
            $output[] = array(
                'payment_id' => $payment->getPaymentId(),
                'payment_no' => $payment->getPaymentNo(),
                'payment_type' => $payment->getPaymentType(),
                'price' => $payment->getPrice(),
                'created_date' => $payment->getCreatedDate(),
                'userId' => $payment->getUser()->getUserId(),
                'name' => $payment->getUser()->getName(),
                'mail' => $payment->getUser()->getMail(),
                'eventId' => $payment->getEvent()->getEventId(),
                'eventNo' => $payment->getEvent()->getEventNo(),
                'eventName' => $payment->getEvent()->getName(),
                'paymentDetail'=>$paymentArray
            );
    }


        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        echo $e;
                echo "Error! Please try again.";

    }
}
