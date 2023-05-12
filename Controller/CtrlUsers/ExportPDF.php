<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUsers/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $user = new User();
        $result = UsersRead::Read($user);

        if (empty($result)) {
            exit;
        }
        

        $output = array_map(
            function ($user) {
                return array(
                    'userId' => $user->getUserId(),
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'name' => $user->getName(),
                    'phone' => $user->getPhone(),
                    'mail' => $user->getMail(),
                    'status' => $user->getStatus(),
                    'createdDate' => $user->getCreatedDate(),
                    'createdBy' => $user->getCreatedBy(),
                    'updatedDate' => $user->getUpdatedDate(),
                    'updatedBy' => $user->getUpdatedBy()
                );
            },
            $result
        );

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><users></users>');
        foreach ($output as $user) {
            $userNode = $xml->addChild('user');
            foreach ($user as $key => $value) {
                $userNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        // Load the XML file
        $xml = new DOMDocument();
        $xml->loadXML($xmlString);

        // Load the XSLT stylesheet
        $xsl = new DOMDocument();
        $xsl->load('users.xsl');

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
        file_put_contents('users.pdf', $pdf->output());

        if (file_exists('users.pdf')) {
            echo 'The file users.pdf is downloaded to your folder.';
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
