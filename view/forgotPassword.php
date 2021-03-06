<?php
include_once('../build/app.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Windesheim Flevoland</title>

    <!-- Bootstrap -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo MapStructureRepositorie::vendors(); ?>animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo MapStructureRepositorie::build(); ?>css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">

        <div class="animate form login_form">
            <?php
            if(Services\SessionHandler::has('error')){
                echo "<div class='alert alert-danger' role='alert'>".
                    Services\SessionHandler::getAndDelete('error')."
            </div>";
            }

            ?>
            <section class="login_content">
                <?php echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller().'loginController.php?forgotPassword=1','method'=>'POST']); ?>
                    <h1>Wachtwoord vergeten</h1>
                    <p>Voer uw e-mail adres in om verder te gaan met dit proces.</p>
					<p>Controleer uw spambox als u de mail niet in de inbox krijgt.</p>
                    <div>
                        <input type="text" name="email" class="form-control" placeholder="E-mail" required="" />
                    </div>
                    <div>
                        <button class="btn btn-default submit">Verstuur</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />

                        <div class="logo">
                            <!--<h1><i class="fa fa-paw"></i>Windesheim Flevoland</h1>-->
                            <img src="../view/images/wf.png" width="70%">
                            <p>©2017 All Rights Reserved by Windesheim Flevoland</p>
                        </div>
                    </div>
                <?php echo FormRepositorie::closeForm(); ?>
            </section>
        </div>
    </div>
</div>
</body>
</html>
