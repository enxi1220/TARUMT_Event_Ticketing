<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllTicket/ReadSoldQuantity.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $event = new Event();
        $result = EventRead::Read($event);

        if (empty($result)) {
            exit;
        }

        foreach ($result as $event) {
            $event->setTickets(ReadSoldQuantity::Read($event, new TicketVIP(), new TicketStandard(), new TicketBudget()));
            
            $sold = 0;
            if (!empty($event->getTickets())) {
                foreach ($event->getTickets() as $ticket) {
                    $sold += $ticket->getCount();
                }
            }
            $event->setTicketQtySold($sold);
        } 

        $output = array_map(
            function ($event) {
                return array(
                    'eventId' => $event->getEventId(),
                    'categoryId' => $event->getCategoryId(),
                    'eventNo' => $event->getEventNo(),
                    'name' => $event->getName(),
                    'poster' => $event->getPoster(),
                    'posterPath' => $event->posterPath() . $event->getPoster(),
                    'img' => base64_encode($event->posterPath() . $event->getPoster()),
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
                    'categoryName' => $event->getCategory()->getName(),
                    'totalQty' => ($event->getVipTicketQty() + $event->getStandardTicketQty() + $event->getBudgetTicketQty()),
                    'soldQty' => $event->getTicketQtySold()
                );
            },
            $result
        );

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><events></events>');
        foreach ($output as $event) {
            $eventNode = $xml->addChild('event');
            foreach ($event as $key => $value) {
                $eventNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        // Load the XML file
        $xml = new DOMDocument();
        $xml->loadXML($xmlString);

        // Load the XSLT stylesheet
        $xsl = new DOMDocument();
        $xsl->load('events.xsl');

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
        file_put_contents('events.pdf', $pdf->output());

        if (file_exists('events.pdf')) {
            echo 'The file events.pdf is downloaded to your folder.';
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        // echo $e;
    }
}
