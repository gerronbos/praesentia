<?php
    include_once('includes/head.php');
    if (!Auth::user()->can('presence')) {
        header("location: " . MapStructureRepositorie::controller().'user/userController.php?show=1&user_id='.Auth::user()->id);
        exit;
    }

    echo "<h1>index</h1>";

    echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller().'controller.php','file'=>1,'name'=>'henk']);
    echo FormRepositorie::textarea('Omschrijving','', ['placeholder' => '']);
    echo FormRepositorie::radio('index',['1'=>'test1','2'=>'test2', '3'=>'test3'],'sf');
    echo FormRepositorie::formSaveButton('index.php');
    echo FormRepositorie::closeForm();
?>



<?php
    include_once('includes/footer.php');
?>