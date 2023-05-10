<?php

/* 
 * Author : Tan Lin Yi
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllParticipant/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/participant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $participant = new Participant();
        $result = ParticipantRead::Read($participant);

        if (empty($result)) {
            exit;
        }

        foreach ($result as $participant) {
//            $admin->setTickets(ReadSoldQuantity::Read($event, new TicketVIP(), new TicketStandard(), new TicketBudget()));
            
//            $sold = 0;
//            if (!empty($event->getTickets())) {
//                foreach ($event->getTickets() as $ticket) {
//                    $sold += $ticket->getCount();
//                }
//            }
//            $event->setTicketQtySold($sold);
        } 

        $output = array_map(
            function ($participant) {
                return array(
                    'username' => $participant->getUsername(),
                'name' => $participant->getName(),
                'phone' => $participant->getPhone(),
                'mail' => $participant->getMail()
                );
            },
            $result
        );

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><participants></participants>');
        foreach ($output as $participant) {
            $participantNode = $xml->addChild('participant');
            foreach ($participant as $key => $value) {
                $participantNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        // Load the XML file
        $xml = new DOMDocument();
        $xml->loadXML($xmlString);

        // Load the XSLT stylesheet
        $xsl = new DOMDocument();
        $xsl->load('participant.xsl');

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
        file_put_contents('participant.pdf', $pdf->output());

        if (file_exists('participant.pdf')) {
            echo 'The file particiants.pdf is downloaded to your folder.';
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
