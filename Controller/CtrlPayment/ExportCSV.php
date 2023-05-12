<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayment/PaymentRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $payment = new Payment();
        $result = PaymentRead::Read($payment);

        if (empty($result)) {
            exit;
        }

        $output = array_map(
            function ($payment) {
                return array(
                    'payment_id' => $payment->getPaymentId(),
                    'payment_no' => $payment->getPaymentNo(),
                    'booking_id' => $payment->getBookingId(),
                    'payment_type' => $payment->getPaymentType(),
                    'price' => $payment->getPrice(),
                    'created_date' => $payment->getCreatedDate(),
                );
            },
            $result
        );

        // xml
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><payments></payments>');
        foreach ($output as $payment) {
            $paymentNode = $xml->addChild('payment');
            foreach ($payment as $key => $value) {
                $paymentNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        $header = [
            'Payment ID',
            'Payment No',
            'Booking ID',
            'Payment Method',
            'Price',
            'Created Date',
        ]; 

        // xpath 
        $data = [];
        foreach ($xml->xpath('//payment') as $payment) {
            $data[] = [
                (string) $payment->payment_id,
                (string) $payment->payment_no,
                (string) $payment->booking_id,
                (string) $payment->payment_type,
                (string) $payment->price,
                (string) $payment->created_date,
            ];
        }

        // Open a file handle for writing the CSV data
        $fh = fopen('PaymentRecord.csv', 'w');

        // Write the CSV header row to the file handle
        fputcsv($fh, $header);

        // Write the CSV data rows to the file handle
        foreach ($data as $row) {
            fputcsv($fh, $row);
        }

        // Close the file handle
        fclose($fh);
        
        //added
        
        // Check if the file was created successfully
        if (file_exists('PaymentRecord.csv')) {
            // Download the file
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="PaymentRecord.csv"');
//            readfile('PaymentRecord.csv');
            exit;
            echo 'The file PaymentRecord.csv is downloaded.';

        } else {
            echo 'Error: Unable to create PaymentRecord.csv file.';
        }


    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        echo $e;
                echo "Error! Please try again.";

    }
}
