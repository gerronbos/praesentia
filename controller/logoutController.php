<?php
include('controller.php');

Auth::logout();

header('location:'.MapStructureRepositorie::view().'index.php');
?>