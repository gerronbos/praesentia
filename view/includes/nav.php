<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            
            <?php
            if(Auth::user()->can('import')) {
                ?>
                <li><a href="<?php echo MapStructureRepositorie::view(); ?>import/index.php"><i class="fa fa-upload"></i>
                        Import</a></li>
            <?php
            }
            if(Auth::user()->can('presence')) {
                ?>
                <li><a><i class="fa fa-edit"></i> Absentie <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>presence/index.php">Absentie
                                invullen</a></li>
                    </ul>
                </li>
            <?php
            }
            if(Auth::user()->can('lectures')) {
                ?>
                <li><a><i class="fa fa-university"></i> Lessen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>lecture/all_lectures.php">Alle lessen</a></li>
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>lecture/createlecture.php">Les aanmaken</a></li>
                    </ul>
                </li>
            <?php
            }
            if (Auth::user()->can('courses')) {
                ?>
                <li>
                    <a><i class="fa fa-book"></i> Vakken <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>courses/allCourses.php">Alle vakken</a></li>
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>courses/presenceCourses.php">Vakken presentie</a></li>
                    </ul>
                </li>
                <?php
            }
            if(Auth::user()->can('user')) {
                ?>
                <li><a><i class="fa fa-user"></i> Gebruikers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>user/allusers.php">Overzicht</a></li>
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>user/createuser.php">Gebruiker
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
            if(Auth::user()->can('rooms')) {
                ?>
                <li><a><i class="fa fa-map-marker"></i> Lokalen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo MapStructureRepositorie::view(); ?>room/index.php">Overzicht</a></li>
                    </ul>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
        </div>