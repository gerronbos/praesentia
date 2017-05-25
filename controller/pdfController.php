<?php
include_once('controller.php');

if(isset($_GET['GroupSummary'])){
	$url = MapStructureRepositorie::view().'pdfGroupSummary.php?group_id='.$_GET['gid'];
	$pdf = new \mikehaertl\wkhtmlto\Pdf();
	$pdf->setOptions(array(
		'orientation' => 'landscape'));
	$pdf->addPage($url);
    $pdf->binary = ConfigRepositorie::get('wkhtml_bin');
    $pdf->tmpDir = '/tmp/';

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
	$pdf->binary = ConfigRepositorie::get('wkhtml_bin');
	$pdf->addPage($url);
    $pdf->tmpDir = '/tmp/';

    $user = model\Users::find($_GET['user_id'])->first();
	$pdf->send('OverzichtAanwezigheid_'.str_replace(' ','',$user->fullname()).'_'.date('d-m-Y').'.pdf');
	if(!$pdf->send()){
		echo $pdf->getError();
	}
};

?>
