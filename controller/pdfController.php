<?php
include_once('controller.php');

if(isset($_GET['create'])){
	$url = MapStructureRepositorie::view().'pdf.php?group_id='.$_GET['gid'];
	$pdf = new \mikehaertl\wkhtmlto\Pdf();
	$pdf->addPage($url);
    $pdf->binary = '/usr/local/bin/wkhtmltopdf';
    $pdf->tmpDir = '/tmp/';

	$groupname = model\Group::find($_GET['gid'])->first()->name;
	$pdf->send('OverzichtAanwezigheid_'.$groupname.'_'.date('d-m-Y').'.pdf');
	if(!$pdf->send()){
		echo $pdf->getError();
	}

};

?>
