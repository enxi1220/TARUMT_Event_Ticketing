<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/Library/dompdf_2-0-3/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
//$dompdf->loadHtmlFile('/TARUMT_Event_Ticketing/Web/View/BackOffice/Dashboard/report.html');
$dompdf->loadHtml('<html><body><h1>Hello, world!</h1></body></html>');

$dompdf->render();
// Output to browser
$dompdf->stream('chart.pdf');

// Save to file
file_put_contents('chart.pdf', $dompdf->output());
