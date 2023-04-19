<?php

/* 
 * Author : Ong Wi Lin
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayment/PaymentRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";

//
//if ($_SERVER["REQUEST_METHOD"] == "GET") {
//    try {
//        if (!isset($_GET['payment_id'])) {
//            throw new Exception("Payment is not set.");
//        }
//
//        $payment_id = json_decode($_GET['payment_id']);
//        $payment = new Payment();
//        $payment->setPaymentId($payment_id);
//        
//        $paymentDetail = new PaymentDetail();
//        // set properties on $paymentDetail object
//        $payment->addPaymentDetail($paymentDetail);
//
//        
////        $paymentDetails = new PaymentDetail();
////        $paymentDetails->setPaymentId($payment_id);
//
//        $result = PaymentRead::Read($payment);
//
//        if (empty($result)) {
//            exit;
//        }
//        
//        //payment Details
//        $booking_id = null;
//        $ticket_no = null;
//        $event_name = null;
//        $ticket_price = null;
//        
//        foreach ($result as $payment) {
//    // payment details
//    $paymentDetails = $payment->getPaymentDetails();
//    if (!empty($paymentDetails)) {
//        foreach ($paymentDetails as $paymentDetail) {
//            $booking_id = $paymentDetail->getBookingId();
//            $ticket_no = $paymentDetail->getTicketNo();
//            $event_name = $paymentDetail->getEventName();
//            $ticket_price = $paymentDetail->getTicketPrice();
//
//            // build output array for each payment
//            $output = array(
//                'payment_id' => $payment->getPaymentId(),
//                'payment_no' => $payment->getPaymentNo(),
//                'payment_type' => $payment->getPaymentType(),
//                'price' => $payment->getPrice(),
//                'created_date' => $payment->getCreatedDate(),
//
//                'booking_id' => $booking_id,
//                'ticket_no' => $ticket_no,
//                'event_name' => $event_name,
//                'ticket_price' => $ticket_price,
//            );
//
//            echo json_encode($output); // or push the output into an array to return all payments at once
//        }
//    }
//}
//
////
////        $paymentDetails = $result->getPaymentDetails();
////        if (!empty($paymentDetails)) {
////            $paymentDetail = $paymentDetails[0]; // get the first PaymentDetail object
////            $booking_id = $paymentDetail->getBookingId();
////            $ticket_no = $paymentDetail->getTicketNo();
////            $event_name = $paymentDetail->getEventName();
////            $ticket_price = $paymentDetail->getTicketPrice();
////        }
//
////        $result = $result[0];
////        $output = array(
////            'payment_id' => $result->getPaymentId(),
////            'payment_no' => $result->getPaymentNo(),
////            'payment_type' => $result->getPaymentType(),
////            'price' => $result->getPrice(),
////            'created_date' => $result->getCreatedDate(),
//
//            //payment Details
////            'booking_id' => $result->getBookingId(),
////            'ticket_no' => $result->getPaymentDetails()->getTicketNo() ?? '',
////            'event_name' => $result->getPaymentDetails()->getEventName(),
////            'ticket_price' => $result->getPaymentDetails()->getTicketPrice(),
//
//        //payment Details
////            'booking_id' => $booking_id,
////            'ticket_no' => $ticket_no,
////            'event_name' => $event_name,
////            'ticket_price' => $ticket_price,
////                       
////        );
//
////        echo json_encode($output);
//    } catch (\Throwable $e) {
//        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        // echo $e->getMessage();
//        echo $e;
//    }
//}

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

        // Construct output array for each payment
        $output = array();
        foreach ($result as $payment) {
            // Payment details
            $paymentDetails = $payment->getPaymentDetails();
//            if (!empty($paymentDetails)) {
//            $output[] = array(
//                        'payment_id' => $payment->getPaymentId(),
//                        'payment_no' => $payment->getPaymentNo(),
//                        'payment_type' => $payment->getPaymentType(),
//                        'price' => $payment->getPrice(),
//                        'created_date' => $payment->getCreatedDate(),
//                        'booking_id' => $payment->getBookingId(),
//                );
            
                foreach ($paymentDetails as $paymentDetail) {
                    $output[] = array(
//                        'payment_id' => $payment->getPaymentId(),
//                        'payment_no' => $payment->getPaymentNo(),
//                        'payment_type' => $payment->getPaymentType(),
//                        'price' => $payment->getPrice(),
//                        'created_date' => $payment->getCreatedDate(),
//                        'booking_id' => $payment->getBookingId(),
                        'ticket_no' => $paymentDetail->getTicketNo(),
                        'event_name' => $paymentDetail->getEventName(),
                        'ticket_price' => $paymentDetail->getTicketPrice(),
                    );
                }
//            } else {
                // If there are no payment details, still return payment information
                $output[] = array(
                    'payment_id' => $payment->getPaymentId(),
                    'payment_no' => $payment->getPaymentNo(),
                    'payment_type' => $payment->getPaymentType(),
                    'price' => $payment->getPrice(),
                    'created_date' => $payment->getCreatedDate(),
                    
                );
//            }
        }

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e;
    }
}
