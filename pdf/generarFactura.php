
<?php
require_once '../vendor/autoload.php'; // usar DomPDF o TCPDF según se instale

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<h1>Factura</h1><p>Contenido de la factura</p>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("factura.pdf");
?>
