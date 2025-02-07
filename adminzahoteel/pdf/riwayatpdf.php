<?php
require_once("tcpdf/tcpdf.php") ;


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Zahoteel');
$pdf->setTitle('Riwayat booking');
$pdf->setSubject('Riwayat booking');
$pdf->setKeywords('Riwayat booking');

$pdf->setFont('times', '', 11, '', true);

$pdf->AddPage();

$html = file_get_contents("http://localhost/zahoteel/adminzahoteel/tabledata/pemesanan.php") ;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Riwayat booking.pdf', 'D');

?>