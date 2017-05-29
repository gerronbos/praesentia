<?php
include_once('../../build/app.php');
?>

<?php
$return = '
<link href="'.MapStructureRepositorie::vendors().'bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="'.MapStructureRepositorie::build().'css/custom.min.css" rel="stylesheet">


<style>
    /***
    User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    ***/

    body {
        padding: 0;
        margin: 0;
    }

    html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
    @media only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
        *[class="table_width_100"] {
            width: 96% !important;
        }
        *[class="border-right_mob"] {
            border-right: 1px solid #dddddd;
        }
        *[class="mob_100"] {
            width: 100% !important;
        }
        *[class="mob_center"] {
            text-align: center !important;
        }
        *[class="mob_center_bl"] {
            float: none !important;
            display: block !important;
            margin: 0px auto;
        }
        .iage_footer a {
            text-decoration: none;
            color: #929ca8;
        }
        img.mob_display_none {
            width: 0px !important;
            height: 0px !important;
            display: none !important;
        }
        img.mob_width_50 {
            width: 40% !important;
            height: auto !important;
        }
    }
    .table_width_100 {
        width: 680px;
    }
</style>

<!--
Responsive Email Template by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->

<div id="mailsub" class="notification" align="center">
    <!--<div align="center">
       <img src="http://talmanagency.com/wp-content/uploads/2014/12/cropped-logo-new.png" width="250" alt="Metronic" border="0"  />
    </div> -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">


                <!--[if gte mso 10]>
                <table width="680" border="0" cellspacing="0" cellpadding="0">
                    <tr><td>
                <![endif]-->

                <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
                    <tr><td>
                            <!-- padding -->
                        </td></tr>
                    <!--header -->
                    <tr><td align="center" bgcolor="#ffffff">
                            <!-- padding -->
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td align="right">
                                        <img src="'.MapStructureRepositorie::view().'images/wf-logo-sm.png" alt="Windesheim Flevoland">

                                    </td>
                                    <td align="right">
                                        <!--[endif]--><!--

			</td>
			</tr>
		</table>
		<!-- padding -->
                                    </td></tr>
                                <!--header END-->

                                <!--content 1 -->
                                <tr><td align="center" bgcolor="#fbfcfd">
                                        <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
                                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                <tr><td>
                                                        Beste ::fullname::<br/>
                                                        Uw wachtwoord is gereset.<br/>
                                                        Hierbij sturen wij opnieuw uw gegevens.<br/>
                                                        Email: ::email::<br/>
                                                        Wachtwoord: ::password::<br/>
                                                    </td></tr>
                                                <tr><td align="center">
                                                        <div style="line-height: 24px;">
                                                            <a href="#" target="_blank" class="btn btn-primary block-center">
                                                                Naar praesentia gaan
                                                            </a>
                                                        </div>
                                                        <!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;"></div>
                                                    </td></tr>

                                            </table>
                                        </font>
                                    </td></tr>
                                <!--content 1 END-->


                                <!--footer -->
                                <tr><td class="iage_footer" align="center" bgcolor="#ffffff">


                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr><td align="center" style="padding:20px;flaot:left;width:100%; text-align:center;">
                                                    <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
					2015 © CTM. ALL Rights Reserved.
				</span></font>
                                                </td></tr>
                                        </table>
                                    </td></tr>
                                <!--footer END-->
                                <tr><td>

                                    </td></tr>
                            </table>
                            <!--[if gte mso 10]>
                            </td></tr>
                            </table>
                            <![endif]-->

                        </td></tr>
                </table>';

return $return;
