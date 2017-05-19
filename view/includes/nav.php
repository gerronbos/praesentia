<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="<?php echo ConfigRepositorie::get('url'); ?>"><i class="fa fa-home"></i> Home</a></li>
            <?php
            if(Auth::user()->can('presence')) {
                ?>
                <li><a><i class="fa fa-edit"></i> Absentie <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>presence/index.php">Absentie
                                invullen</a></li>
                        <li><a href="form_advanced.html">Aanwezigheid</a></li>
                    </ul>
                </li>
            <?php
            }
            if(Auth::user()->can('user')) {
                ?>
                <li><a><i class="fa fa-user"></i> Gebruikers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>user/allusers.php">Overzicht</a></li>
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>user/userAddOption.php">Nieuw gebruiker
                                aanmaken</a></li>
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>roles/index.php">Rechten</a></li>
                    </ul>
                </li>
            <?php
            }
            ?>
            <?php
            if(Auth::user()->can('groups')) {
            ?>
                <li><a><i class="fa fa-users"></i> Klassen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>group/allgroups.php">Overzicht</a></li>
                    </ul>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

</div>