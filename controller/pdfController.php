<?php
include_once('controller.php');

if(isset($_GET['GroupSummary'])){
	$url = MapStructureRepositorie::view().'pdfGroupSummary.php?group_id='.$_GET['gid'];
	$pdf = new \mikehaertl\wkhtmlto\Pdf();
	$pdf->setOptions(array(
		'orientation' => 'landscape'));
	$pdf->binary = "D:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe";
	$pdf->addPage($url);
	$groupname = model\Group::find($_GET['gid'])->first()->name;
	$pdf->send('OverzichtAanwezigheid_'.$groupname.'_'.date('d-m-Y').'.pdf');
	if(!$pdf->send()){
		echo $pdf->getError();
	}
};

if(isset($_GET['UserLectureHist'])){
	$url = MapStructureRepositorie::view().'pdfUserLectureHist.php?user_id='.$_GET['user_id'].'&course_id='.$_GET['course_id'];
	$pdf = new \mikehaertl\wkhtmlto\Pdf();
	$pdf->setOptions(array(
		'orientation' => 'landscape'));
	$pdf->binary = "D:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe";
	$pdf->addPage($url);
	$user = model\Users::find($_GET['user_id'])->first();
	$pdf->send('OverzichtAanwezigheid_'.str_replace(' ','',$user->fullname()).'_'.date('d-m-Y').'.pdf');
	if(!$pdf->send()){
		echo $pdf->getError();
	}
};

?>
