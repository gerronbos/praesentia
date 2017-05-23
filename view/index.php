<?php
    include_once('includes/head.php');
    if (!Auth::user()->can('presence')) {
        header("location: " . MapStructureRepositorie::controller().'user/userController.php?show=1&user_id='.Auth::user()->id);
        exit;
    }

    echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller().'controller.php','file'=>1,'name'=>'henk']);
    echo FormRepositorie::textarea('Omschrijving','', ['placeholder' => 'Jesse is gay']);
    echo FormRepositorie::radio('hi',['test1'=>'test1','test2'=>'test2', 'test3'=>'test3'],'test2');
    echo FormRepositorie::formSaveButton('index.php');
    echo FormRepositorie::closeForm();
?>



<?php
    include_once('includes/footer.php');
?>