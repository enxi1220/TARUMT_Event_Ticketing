<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $event = new Event();
        $result = EventRead::Read($event);

        if (empty($result)) {
            exit;
        }

        $output = array_map(
            function ($event) {
                return array(
                    'eventId' => $event->getEventId(),
                    'categoryId' => $event->getCategoryId(),
                    'eventNo' => $event->getEventNo(),
                    'name' => $event->getName(),
                    'poster' => $event->getPoster(),
                    'venue' => $event->getVenue(),
                    'registerStartDate' => $event->getRegisterStartDate(),
                    'registerEndDate' => $event->getRegisterEndDate(),
                    'eventStartDate' => $event->getEventStartDate(),
                    'eventEndDate' => $event->getEventEndDate(),
                    'description' => $event->getDescription(),
                    'vipTicketQty' => $event->getVipTicketQty(),
                    'standardTicketQty' => $event->getStandardTicketQty(),
                    'budgetTicketQty' => $event->getBudgetTicketQty(),
                    'vipTicketPrice' => $event->getVipTicketPrice(),
                    'standardTicketPrice' => $event->getStandardTicketPrice(),
                    'budgetTicketPrice' => $event->getBudgetTicketPrice(),
                    'organizerName' => $event->getOrganizerName(),
                    'organizerPhone' => $event->getOrganizerPhone(),
                    'organizerMail' => $event->getOrganizerMail(),
                    'status' => $event->getStatus(),
                    'createdDate' => $event->getCreatedDate(),
                    'createdBy' => $event->getCreatedBy(),
                    'updatedDate' => $event->getUpdatedDate(),
                    'updatedBy' => $event->getUpdatedBy(),
                    'categoryName' => $event->getCategory()->getName(), //change to val
                    // 'tickets' => $event->getTickets()
                );
            },
            $result
        );

        // xml
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><events></events>');
        foreach ($output as $event) {
            $eventNode = $xml->addChild('event');
            foreach ($event as $key => $value) {
                $eventNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        $header = [
            'Event No',
            'Category Name',
            'Event Name',
            'Status',
            'Event Start Date',
            'Event End Date',
            'Venue',
            'VIP Ticket Quantity',
            'Standard Ticket Quantity',
            'Budget Ticket Quantity',
            'VIP Ticket Price',
            'Standard Ticket Price',
            'Budget Ticket Price',
            'Organizer Name',
            'Organizer Phone',
            'Organizer Mail',
        ]; 

        // xpath 
        $data = [];
        foreach ($xml->xpath('//event') as $event) {
            $data[] = [
                (string) $event->eventNo,
                (string) $event->categoryName,
                (string) $event->name,
                (string) $event->status,
                (string) $event->eventStartDate,
                (string) $event->eventEndDate,
                (string) $event->venue,
                (string) $event->vipTicketQty,
                (string) $event->standardTicketQty,
                (string) $event->budgetTicketQty,
                (string) $event->vipTicketPrice,
                (string) $event->standardTicketPrice,
                (string) $event->budgetTicketPrice,
                (string) $event->organizerName,
                (string) $event->organizerPhone,
                (string) $event->organizerMail,
            ];
        }

        // Open a file handle for writing the CSV data
        $fh = fopen('events.csv', 'w');

        // Write the CSV header row to the file handle
        fputcsv($fh, $header);

        // Write the CSV data rows to the file handle
        foreach ($data as $row) {
            fputcsv($fh, $row);
        }

        // Close the file handle
        fclose($fh);

        if (file_exists('events.csv')) {
            echo 'The file events.csv is downloaded to your folder.';
        } 

    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
