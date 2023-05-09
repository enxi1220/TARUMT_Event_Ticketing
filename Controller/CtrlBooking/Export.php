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

// Create the XML object
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><bookings></bookings>');

        foreach ($output as $booking) {
            $bookingElement = $xml->addChild('booking'); // Create a new <booking> element
            // Loop through the key-value pairs in the associative array and create child elements under the <booking> element
            foreach ($booking as $key => $value) {
                if (is_array($value)) {
                    $bookingDetailsElement = $bookingElement->addChild('bookingDetails'); // Create a new <bookingDetails> element
                    foreach ($value as $bookingDetail) {
                        $bookingDetailElement = $bookingDetailsElement->addChild('bookingDetail'); // Create a new <bookingDetail> element
                        foreach ($bookingDetail as $detailKey => $detailValue) {
                            $bookingDetailElement->addChild($detailKey, $detailValue); // Create child elements with key-value pairs in the booking detail
                        }
                    }
                } else {
                    $bookingElement->addChild($key, $value); // Create child elements with key-value pairs in the booking
                }
            }
        }

// Convert each booking object to an associative array and add it to the XML object
//        foreach ($output as $booking) {
//            $bookingNode = $xml->addChild('booking');
//            foreach ($booking as $key => $value) {
//                if ($key === 'bookingDetails') {
//                    // If the value is an array of booking details, add each booking detail as a child element
//                    foreach ($value as $bookingDetail) {
//                        $bookingDetailNode = $bookingNode->addChild('bookingDetail');
//                        foreach ($bookingDetail as $detailKey => $detailValue) {
//                            $bookingDetailNode->addChild($detailKey, $detailValue);
//                        }
//                    }
//                } else {
//                    // Otherwise, add the value as a child element with the key as the element name
//                    $bookingNode->addChild($key, $value);
//                }
//            }
//        }
//        
//        
//        foreach ($output as $booking) {
//    $bookingNode = $xml->addChild('booking');
//    foreach ($booking as $key => $value) {
//        if ($key === 'bookingDetails') {
//            // If the value is an array of booking details, add each booking detail as a child element
//            foreach ($value as $bookingDetail) {
//                $bookingDetailNode = $bookingNode->addChild('bookingDetail');
//                foreach ($bookingDetail as $detailKey => $detailValue) {
//                    $bookingDetailNode->addChild($detailKey, $detailValue);
//                }
//            }
//        } elseif ($key === 'user') {
//            // If the key is "user", add a "user" element and its child elements
//            $userNode = $bookingNode->addChild('user');
//            foreach ($value as $userKey => $userValue) {
//                $userNode->addChild($userKey, $userValue);
//            }
//        } elseif ($key === 'ticket') {
//            // If the key is "ticket", add a "ticket" element and its child elements
//            $ticketNode = $bookingNode->addChild('ticket');
//            foreach ($value as $ticketKey => $ticketValue) {
//                $ticketNode->addChild($ticketKey, $ticketValue);
//            }
//        } else {
//            // Otherwise, add the value as a child element with the key as the element name
//            $bookingNode->addChild($key, $value);
//        }
//    }
//}
//// Define the CSV header
//        $header = [
//            'Booking Id',
//            'Booking No',
//            'Ticket No',
//            'Ticket Price',
//            'Event Id',
//            'User Id',
//            'Customer Mail',
//            'Customer Phone',
//            'Created By',
//            'Created Date',
//            'Ticket Count',
//            'Event No',
//            'Event Name',
//            'Poster',
//            'Venue',
//            'Event Start Date',
//            'Event End Date',
//            'Poster Path',
//        ];
//
//        $data = [];
//
//
//        $ticketNumStr = '';
//        $ticketPriceStr = '';
//
//        foreach ($xml->xpath('//booking') as $booking) {
//
//            foreach ($booking->bookingDetails->bookingDetail as $bookingDetail) {
//
//                $ticketNumStr .= (string) $bookingDetail->ticketNo . ",";
//                $ticketPriceStr .= (string) $bookingDetail->ticketPrice . ",";
//            }
//
//            $data = [
//                (string) $booking->bookingId,
//                (string) $booking->bookingNo,
//                (string) $ticketNumStr,
//                (string) $ticketPriceStr,
//                (string) $booking->eventId,
//                (string) $booking->userId,
//                (string) $booking->customerMail,
//                (string) $booking->customerPhone,
//                (string) $booking->createdBy,
//                (string) $booking->createdDate,
//                (string) $booking->ticketCount,
//                (string) $booking->eventNo,
//                (string) $booking->eventName,
//                (string) $booking->poster,
//                (string) $booking->venue,
//                (string) $booking->eventStartDate,
//                (string) $booking->eventEndDate,
//                (string) $booking->posterPath,
//            ];
//        }
//
//
//
//
//
//
//
//
//
//// Open a file handle for writing the CSV data
//        $fh = fopen('bookings.csv', 'w');
//
//// Write the CSV header row to the file handle
//        fputcsv($fh, $header);
//
//// Write the CSV data rows to the file handle
//        foreach ($data as $row) {
//            fputcsv($fh, $row);
//        }
//
//// Close the file handle
//        fclose($fh);
        if ($_GET['action'] == "exportCSV") {

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



// Open a file handle for writing the CSV data
            $fh = fopen('bookings.csv', 'w');

// Write the CSV header row to the file handle
            fputcsv($fh, $header);

// Write the CSV data rows to the file handle
            foreach ($data as $row) {
                fputcsv($fh, $row);
            }

// Close the file handle
            fclose($fh);

//        foreach ($result as $booking) {
//            $bookingNode = $xml->addChild('booking');
//            $bookingNode->addChild('bookingId', $booking->getBookingId());
//            $bookingNode->addChild('bookingNo', $booking->getBookingNo());
//            $bookingDetailsNode = $bookingNode->addChild('bookingDetails');
//            foreach ($booking->getPayment()->getPaymentDetails() as $paymentDetail) {
//                $bookingDetailNode = $bookingDetailsNode->addChild('bookingDetail');
//                $bookingDetailNode->addChild('ticketNo', $paymentDetail->getTicketNo());
//                $bookingDetailNode->addChild('ticketPrice', $paymentDetail->getTicketPrice());
//            }
//            $bookingNode->addChild('eventId', $booking->getEventId());
//            $bookingNode->addChild('userId', $booking->getUserId());
//            $bookingNode->addChild('createdBy', $booking->getCreatedBy());
//            $bookingNode->addChild('createdDate', $booking->getCreatedDate());
//            $bookingNode->addChild('ticketCount', $booking->getTicketCount());
//            $eventNode = $bookingNode->addChild('event');
//            $eventNode->addChild('eventNo', $booking->getEvent()->getEventNo());
//            $eventNode->addChild('eventName', $booking->getEvent()->getName());
//            $eventNode->addChild('poster', $booking->getEvent()->getPoster());
//            $eventNode->addChild('venue', $booking->getEvent()->getVenue());
//            $eventNode->addChild('eventStartDate', $booking->getEvent()->getEventStartDate());
//            $eventNode->addChild('eventEndDate', $booking->getEvent()->getEventEndDate());
//            $eventNode->addChild('posterPath', $booking->getEvent()->posterPath() . $booking->getEvent()->getPoster());
//        }
// Save the XML document to a file
//        $xml->asXML('bookings.xml');
// Extract specific information from the XML data using XPath
//        $xml = simplexml_load_file('bookings.xml');
// Total number of tickets sold
//        $totalTickets = $xml->xpath('sum(//bookingDetails/bookingDetail/ticketNo)');
// Export the data to CSV file
//        $csvFile = fopen('bookings.csv', 'w');
//        $header = array('bookingId', 'bookingNo', 'ticketNo', 'ticketPrice', 'eventId', 'userId', 'createdBy', 'createdDate', 'ticketCount', 'eventNo', 'eventName', 'poster', 'venue', 'eventStartDate', 'eventEndDate', 'posterPath');
//        fputcsv($csvFile, $header);
//        
//        $xml = simplexml_load_file('bookings.xml');
//
//foreach ($xml->xpath('//bookingDetails/bookingDetail') as $bookingDetail) {
//    $booking = $bookingDetail->xpath('../..')[0];
//    $event = $booking->event;
//    $row = array(
//        (string) $booking->bookingId,
//        (string) $booking->bookingNo,
//        (string) $bookingDetail->ticketNo,
//        (string) $bookingDetail->ticketPrice,
//        (string) $booking->eventId,
//        (string) $booking->userId,
//        (string) $booking->createdBy,
//        (string) $booking->createdDate,
//        (string) $booking->ticketCount,
//        (string) $event->eventNo,
//        (string) $event->eventName,
//        (string) $event->poster,
//        (string) $event->venue,
//        (string) $event->eventStartDate,
//        (string) $event->eventEndDate,
//        (string) $event->posterPath
//    );
//}
            // Open the CSV file and write the header row
//        $file = fopen('bookings.csv', 'w');
//        fputcsv($file, array(
//            'Booking ID',
//            'Booking No',
//            'Ticket No',
//            'Ticket Price',
//            'Event ID',
//            'User ID',
//            'Created By',
//            'Created Date',
//            'Ticket Count',
//            'Event No',
//            'Event Name',
//            'Poster',
//            'Venue',
//            'Event Start Date',
//            'Event End Date',
//            'Poster Path'
//        ));
//
//// Write each row of data to the CSV file
//        
//        foreach ($xml->xpath('//bookingDetails/bookingDetail') as $bookingDetail) {
//    $booking = $bookingDetail->xpath('../..')[0];
//    $event = $booking->event;
//    $row = array(
//        (string) $booking->bookingId,
//        (string) $booking->bookingNo,
//        (string) $bookingDetail->ticketNo,
//        (string) $bookingDetail->ticketPrice,
//        (string) $booking->eventId,
//        (string) $booking->userId,
//        (string) $booking->createdBy,
//        (string) $booking->createdDate,
//        (string) $booking->ticketCount,
//        (string) $event->eventNo,
//        (string) $event->eventName,
//        (string) $event->poster,
//        (string) $event->venue,
//        (string) $event->eventStartDate,
//        (string) $event->eventEndDate,
//        (string) $event->posterPath
//    );
//    fputcsv($file, $row);
//}
//
//// Close the CSV file
//        fclose($file);
//        foreach ($result as $booking) {
//            foreach ($booking->getPayment()->getPaymentDetails() as $bookingDetail) {
//                $row = array(
//                    (string) $booking->bookingId,
//                    (string) $booking->bookingNo,
//                    (string) $bookingDetail->ticketNo,
//                    (string) $bookingDetail->ticketPrice,
//                    (string) $booking->eventId,
//                    (string) $booking->userId,
//                    (string) $booking->createdBy,
//                    (string) $booking->createdDate,
//                    (string) $booking->ticketCount,
//                    (string) $booking->event->eventNo,
//                    (string) $booking->event->eventName,
//                    (string) $booking->event->poster,
//                    (string) $booking->event->venue,
//                    (string) $booking->event->eventStartDate,
//                    (string) $booking->event->eventEndDate,
//                    (string) $booking->event->posterPath
//                );
//                fputcsv($file, $row);
//            }
//        }
// Total number of tickets sold
//        $totalTickets = $xml->xpath('sum(//bookingDetails/bookingDetail/ticketNo)');
//// Booking history for a specific user
//        $userBookings = $xml->xpath('//booking[userId="1"]');
            if (file_exists('bookings.csv')) {
                echo 'The file bookings.csv is downloaded to your folder.';
            }
        } else {
            $xmlString = $xml->asXML();

            // Load the XML file
            $xml = new DOMDocument();
            $xml->loadXML($xmlString);

            // Load the XSLT stylesheet
            $xsl = new DOMDocument();
            $xsl->load('bookings.xsl');

            // Create an XSLTProcessor object
            $proc = new XSLTProcessor();

            // Attach the XSLT stylesheet
            $proc->importStylesheet($xsl);

            // Transform the XML document
            $html = $proc->transformToXML($xml);

            // Create a new PDF document 
            $pdf = new Dompdf();

            // Load the HTML into the PDF document
            $pdf->loadHtml($html);

            // Render the PDF document
            $pdf->render();

            // Output the PDF file
            file_put_contents('bookings.pdf', $pdf->output());

            if (file_exists('bookings.pdf')) {
                echo 'The file bookings.pdf is downloaded to your folder.';
            }
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
