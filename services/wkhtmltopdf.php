<?php
use mikehaertl\wkhtmlto\Pdf;

function createPDF($group_id){
	// You can pass a filename, a HTML string, an URL or an options array to the constructor
	$pdf = new Pdf;
	$pdf->addPage('/presence/createpdf.php?group_id='.$group_id);
	$pdf->saveAs('/tmp/Overzicht.php');
	$pdf->send();

	// On some systems you may have to set the path to the wkhtmltopdf executable
	// $pdf->binary = 'C:\...';

	if (!$pdf->saveAs('/tmp/Overzicht.php')) {
	    echo $pdf->getError();
	}
}