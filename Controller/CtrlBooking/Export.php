<?php

#  Author: Vinnie Chin Loh Xin 
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/BookingRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $booking = new Booking();
        $result = BookingRead::Read($booking);

        if (empty($result)) {
            exit;
        }

        $output = array_map(function ($booking) {
            $bookingDetails = array();
            foreach ($booking->getPayment()->getPaymentDetails() as $paymentDetail) {
                $bookingDetails[] = array(
                    'ticketNo' => $paymentDetail->getTicketNo(),
                    'ticketPrice' => $paymentDetail->getTicketPrice()
                );
            }

            return array(
        'bookingId' => $booking->getBookingId(),
        'bookingNo' => $booking->getBookingNo(),
        'bookingDetails' => $bookingDetails,
        'price' => $booking->getPayment()->getPrice(),
        'eventId' => $booking->getEventId(),
        'userId' => $booking->getUserId(),
        'customerMail' => $booking->getUser()->getMail(),
        'customerPhone' => $booking->getUser()->getPhone(),
        'createdBy' => $booking->getCreatedBy(),
        'createdDate' => $booking->getCreatedDate(),
        'ticketCount' => $booking->getTicketCount(),
        'eventNo' => $booking->getEvent()->getEventNo(),
        'eventName' => $booking->getEvent()->getName(),
        'venue' => $booking->getEvent()->getVenue(),
        'eventStartDate' => $booking->getEvent()->getEventStartDate(),
        'eventEndDate' => $booking->getEvent()->getEventEndDate()
            );
        }, $result);

        // create the XML object
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><bookings></bookings>');

        foreach ($output as $booking) {
            $bookingElement = $xml->addChild('booking');
            foreach ($booking as $key => $value) {
                // to store the booking details (ticket number & ticket price)
                if (is_array($value)) {
                    $bookingDetailsElement = $bookingElement->addChild('bookingDetails');
                    foreach ($value as $bookingDetail) {
                        $bookingDetailElement = $bookingDetailsElement->addChild('bookingDetail');
                        foreach ($bookingDetail as $detailKey => $detailValue) {
                            $bookingDetailElement->addChild($detailKey, $detailValue);
                        }
                    }
                } else {
                    // to store booking data like booking ID, booking number, customer info, event info etc
                    $bookingElement->addChild($key, $value);
                }
            }
        }

        if ($_GET['action'] == "exportCSV") { // user choose to export as CSV
            $data = [];
            $header = ['Booking ID',
                'Booking No',
                'Ticket Count',
                'Ticket Numbers',
                'Ticket Prices',
                'Total Price',
                'Customer Mail',
                'Customer Phone',
                'Booked By',
                'Booked Date',
                'Event No',
                'Event Name',
                'Venue',
                'Event Start Date',
                'Event End Date'];

            foreach ($xml->xpath('//booking') as $booking) {
                $ticketNumStr = '';
                $ticketPriceStr = '';

                foreach ($booking->bookingDetails->bookingDetail as $bookingDetail) {
                    $ticketNumStr .= (string) $bookingDetail->ticketNo . ",";
                    $ticketPriceStr .= (string) $bookingDetail->ticketPrice . ",";
                }

                $row = [
                    (string) $booking->bookingId,
                    (string) $booking->bookingNo,
                    (string) $booking->ticketCount,
                    (string) rtrim($ticketNumStr, ","),
                    (string) rtrim($ticketPriceStr, ","),
                    (string) $booking->price,
                    (string) $booking->customerMail,
                    (string) $booking->customerPhone,
                    (string) $booking->createdBy,
                    (string) $booking->createdDate,
                    (string) $booking->eventNo,
                    (string) $booking->eventName,
                    (string) $booking->venue,
                    (string) $booking->eventStartDate,
                    (string) $booking->eventEndDate,
                ];

                $data[] = $row;
            }

            $fh = fopen('bookings.csv', 'w');

            fputcsv($fh, $header);

            foreach ($data as $row) {
                fputcsv($fh, $row);
            }

            fclose($fh);

            if (file_exists('bookings.csv')) {
                echo 'The file bookings.csv is downloaded.';
            }
            
        } else {// user choose to export as PDF
            
            $xmlString = $xml->asXML();

            $xml = new DOMDocument();
            $xml->loadXML($xmlString);

            $xsl = new DOMDocument();
            $xsl->load('bookings.xsl');

            $proc = new XSLTProcessor();
            $proc->importStylesheet($xsl);

            $html = $proc->transformToXML($xml);

            $pdf = new Dompdf();
            $pdf->loadHtml($html);
            $pdf->render();

            file_put_contents('bookings.pdf', $pdf->output());

            if (file_exists('bookings.pdf')) {
                echo 'The file bookings.pdf is downloaded.';
            }
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
    }
}
