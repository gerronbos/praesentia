<?php
    include_once('includes/head.php');
    if(Auth::user()->can('presence')){
        header("location: " . MapStructureRepositorie::view().'presence/index.php');
        exit;
    }
    elseif(Auth::user()->can('lectures')){
        header("location: " . MapStructureRepositorie::view().'lecture/all_lectures.php');
        exit;
    }
    elseif(Auth::user()->can('courses')){
        header("location: " . MapStructureRepositorie::view().'courses/allCourses.php');
        exit;
    }
    elseif(Auth::user()->can('user')){
        header("location: " . MapStructureRepositorie::view().'user/allusers.php');
        exit;
    }
    elseif(Auth::user()->can('groups')){
        header("location: " . MapStructureRepositorie::view().'group/allgroups.php');
        exit;
    }
    elseif(Auth::user()->can('rooms')){
        header("location: " . MapStructureRepositorie::view().'room/index.php');
        exit;
    }
    elseif(Auth::user()->can('import')){
        header("location: " . MapStructureRepositorie::view().'import/index.php');
        exit;
    }
        header("location: " . MapStructureRepositorie::controller().'user/userController.php?show=1&user_id='.Auth::user()->id);
        exit;