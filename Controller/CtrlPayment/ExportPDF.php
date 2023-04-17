<?php

/* 
 * Author : Ong Wi Lin
 */

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllPayment/PaymentRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $payment = new Payment();
        $result = PaymentRead::Read($payment);

        if (empty($result)) {
            console.log("Line 25 : empty");
            exit;
        }

        foreach ($result as $payment) {
//            $event->setTickets(ReadSoldQuantity::Read($event, new TicketVIP(), new TicketStandard(), new TicketBudget()));
//            
//            $sold = 0;
//            if (!empty($event->getTickets())) {
//                foreach ($event->getTickets() as $ticket) {
//                    $sold += $ticket->getCount();
//                }
//            }
//            $event->setTicketQtySold($sold);
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

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><payments></payments>');
        foreach ($output as $payment) {
            $paymentNode = $xml->addChild('payment');
            foreach ($payment as $key => $value) {
                $paymentNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        // Load the XML file
        $xml = new DOMDocument();
        $xml->loadXML($xmlString);

        // Load the XSLT stylesheet
        $xsl = new DOMDocument();
        $xsl->load('payment.xsl');
//        error_log("Line 72 : load payment.xsl");


        // Create an XSLTProcessor object
        $proc = new XSLTProcessor();

        // Attach the XSLT stylesheet
        $proc->importStylesheet($xsl);

        // Transform the XML document
        $html = $proc->transformToXML($xml);

        // Create a new PDF document 
        $pdf = new Dompdf();

        // $pdf = new Dompdf();

        // Load the HTML into the PDF document
        $pdf->loadHtml($html);

        // Render the PDF document
        $pdf->render();

        // Output the PDF file
        // $pdf->stream('events.pdf');

        // Output the PDF file
        // file_put_contents('events.pdf', $dompdf->output());
        file_put_contents('payment.pdf', $pdf->output());

        if (file_exists('payment.pdf')) {
//            error_log("The file payment.pdf is downloaded ");
            echo 'The file payment.pdf is downloaded to your folder.';
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
//        error_log("500");
//        error_log(phpinfo());
        echo $e;
    }
}
