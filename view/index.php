<?php
    include_once('includes/head.php');
    if (!Auth::user()->can('presence')) {
        header("location: " . MapStructureRepositorie::controller().'user/userController.php?show=1&user_id='.Auth::user()->id);
        exit;
    }

    include_once('includes/footer.php');
?>