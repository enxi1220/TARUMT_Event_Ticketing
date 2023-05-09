<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $category = new Category();
        $result = CategoryRead::Read($category);

        if (empty($result)) {
            exit;
        }

        $output = array_map(
            function ($category) {
                return array(
                    'categoryId' => $category->getCategoryId(),
                    'name' => $category ->getName(),
                    'description' => $category ->getDescription(),
                    'createdDate' => $category ->getCreatedDate(),
                    'createdBy' => $category ->getCreatedBy(),
                    'updatedDate' => $category ->getUpdatedDate(),
                    'updatedBy' => $category->getUpdatedBy(),
                );
            },
            $result
        );

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><categories></categories>');
        foreach ($output as $category) {
            $categoryNode = $xml->addChild('category');
            foreach ($category as $key => $value) {
                $categoryNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        // Load the XML file
        $xml = new DOMDocument();
        $xml->loadXML($xmlString);

        // Load the XSLT stylesheet
        $xsl = new DOMDocument();
        $xsl->load('categories.xsl');

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
        file_put_contents('categories.pdf', $pdf->output());

        if (file_exists('categories.pdf')) {
            echo 'The file categories.pdf is downloaded to your folder.';
        }
    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
