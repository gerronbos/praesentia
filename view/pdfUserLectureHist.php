<?php
include_once('../build/app.php');
$user = model\Users::find($_GET['user_id']);
$course = model\Course::find($_GET['course_id']);
$presence = PresenceRepository::getPresenceByCourse(model\Course::find($_GET['course_id']), ['user_id'=>$user->id])->groupBy('lecture_id')->get();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ConfigRepositorie::get('title'); ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Select2 CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="<?php echo MapStructureRepositorie::build(); ?>css/custom.min.css" rel="stylesheet">
</head>
<body style="background-color:#FFF;">
<div class="x_panel">
	<div class="x_title">
		<h2 style="height:20px;">Overzicht Aanwezigheid van: <?php echo $user->Fullname();?></h2>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<section class="content invoice">
			<div class="row">
				<div class="col-xs-12 invoice-header">
					<h1>
					<img src="<?php echo MapStructureRepositorie::view();?>images/wf-logo-sm.png" alt="Windesheim Flevoland">
					<small class="pull-right"><?php echo date('d M Y'); ?></small>
					</h1>
					<hr />
					<h2>Vak: <?php echo $course->name;?></h2>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 table">
					<table class="table taple-striped">
						<tr>
					<th>Datum</th>
					<th>Starttijd</th>
					<th>Eindtijd</th>
					<th>Aanwezig</th>
				</tr>
				<?php
					foreach ($presence as $p) {
						echo "<tr><td>$p->date</td><td>$p->start_time</td><td>$p->end_time</td><td style='text-align: center;'>".presenttrueorfalse($p->present)."</td></tr>";
					}
				?>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 footer">
					<p class="pull-right">Praesentia Aanwezigheids administratie</p>
				</div>
			</div>
		</section>
	</div>
</div>
</body>

<!-- jQuery -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.pie.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.time.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.stack.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>moment/min/moment.min.js"></script>
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Password Validator -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/validator.js"></script>

<!-- Dropzone Script -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/dropzone.js"></script>

<!-- Select2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/custom.min.js"></script>

</body>
</html>


