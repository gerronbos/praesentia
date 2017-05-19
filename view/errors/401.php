<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/build/app.php');
Auth::isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo MapStructureRepositorie::build(); ?>css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
            <div class="col-middle">
                <div class="text-center text-center">
                    <h1 class="error-number">401</h1>
                    <h2>Geen toegang</h2>
                    <p>U heeft geen rechten om deze pagina te bezoeken.
                    </p>
                    <div class="mid_center">
                        <button onclick="goBack()" class="btn btn-primary btn-block">Ga terug</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo MapStructureRepositorie::build(); ?>js/custom.min.js"></script>

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>