<?php

/* 
 * Author : Ong Wi Lin
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $admin = new Admin();
        $admin->setAdminId(null);
        $result = AdminRead::Read($admin);

        if (empty($result)) {
            exit;
        }

        $output = array_map(
            function ($admin) {
                return array(
                    'admin_id' => $admin->getAdminId(),
                    'name' => $admin->getName(),
                    'username' => $admin->getUsername(),
//                    'password' => $admin->getPassword(),
                    'role' => $admin->getRole(),
                    'phone' => $admin->getPhone(),
                    'mail' => $admin->getMail(),
                    'status' => $admin->getStatus(),
                    'created_date' => $admin->getCreatedDate(),
                    'created_by' => $admin->getCreatedBy(),
                    'updated_date' => $admin->getUpdatedDate(),
                    'updated_by' => $admin->getUpdatedBy()  
                );
            },
            $result
        );

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><admins></admins>');
        foreach ($output as $admin) {
            $adminNode = $xml->addChild('admin');
                foreach ($admin as $key => $value) {
                    if ($key === 'created_date' || $key === 'updated_date') {
                        $value = $value;
//                        $value = $value->format('Y-m-d H:i:s');
                    }
                    $adminNode->addChild($key, $value);
                } 

        }

        $xmlString = $xml->asXML();

        // Load the XML file
        $xml = new DOMDocument();
        $xml->loadXML($xmlString);

        // Load the XSLT stylesheet
        $xsl = new DOMDocument();
        $xsl->load('admin.xsl');

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
        file_put_contents('AdminStaffRecord.pdf', $pdf->output());

        if (file_exists('AdminStaffRecord.pdf')) {
            echo 'The file AdminStaffRecord.pdf is downloaded.';
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e;
    }
}
