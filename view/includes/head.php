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

    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

    <!-- Custom Theme Style -->
    <link href="<?php echo MapStructureRepositorie::build(); ?>css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo ConfigRepositorie::get('url'); ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo ConfigRepositorie::get('title'); ?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo Auth::user()->getUserProfilePicture(); ?>" alt="..." class="img-circle profile_img"> 
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo Auth::user()->fullname(); ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/view/includes/nav.php'); ?>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small" style="padding-left: 5%;">
            <a data-toggle="tooltip" data-placement="top" title="Profiel" href="<?php echo MapStructureRepositorie::controller()."user/userController.php?show=1&user_id=".Auth::user()->id; ?>">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo MapStructureRepositorie::controller(); ?>logoutController.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo Auth::user()->getUserProfilePicture(); ?>" alt=""><?php echo Auth::user()->fullname(); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?php echo MapStructureRepositorie::controller()."user/userController.php?show=1&user_id=".Auth::user()->id; ?>"> Profiel</a></li>
                        <li>
                            <a href="<?php echo MapStructureRepositorie::view(); ?>user/changePassword.php">
                                Wachtwoord veranderen
                            </a>
                        </li>
                        <li><a href="<?php echo MapStructureRepositorie::controller(); ?>logoutController.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <?php  
                            if(count(NotificationRepository::get(Auth::user()->id,['onlyUnseen'=>1])->get())){
                                echo '<span class="badge bg-green">';
                                echo count(NotificationRepository::get(Auth::user()->id,['onlyUnseen'=>1])->get());
                                echo '</span>';
                            };
                            ?>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <?php
foreach(array_slice(NotificationRepository::get(Auth::user()->id,['onlyUnseen'=>1])->orderBy('id','DESC')->get(),0,6) as $entry){
    echo "<li><a href='";echo MapStructureRepositorie::view(); echo"notifications/onenotification.php?id=$entry->id'>";
    echo "<span class='image'><img src='".$entry->from_user()->getUserProfilePicture()."' alt='Profile Image' /></span>";
    echo "<span>";
        echo "<span>".$entry->from_user()->fullname()."</span>";
        echo "<span class='time'>".time_ago($entry->created_at)."</span>";
    echo "</span>";
    echo "<span class='message'>".$entry->message."</span>";
    echo "</a></li>";
}
?>
                        <li>
                            <div class="text-center">
                                <a href="<?php echo MapStructureRepositorie::view(); ?>notifications/allnotifications.php">
                                    <strong>Alle berichten</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
