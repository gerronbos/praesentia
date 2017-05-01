<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="<?php echo ConfigRepositorie::get('url'); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a><i class="fa fa-edit"></i> Absentie <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="form.html">Absentie invullen</a></li>
                    <li><a href="form_advanced.html">Aanwezigheid</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-desktop"></i> Gebruikers <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo MapStructureRepositorie::view(); ?>user/allusers.php">Overzicht</a></li>
                    <li><a href="<?php echo MapStructureRepositorie::view(); ?>user/createuser.php">Nieuw gebruiker aanmaken</a></li>
                    <li><a href="typography.html">Rechten</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>