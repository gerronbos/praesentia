<?php
    include_once('includes/head.php');
    if (!Auth::user()->can('presence')) {
        header("location: " . MapStructureRepositorie::controller().'user/userController.php?show=1&user_id='.Auth::user()->id);
        exit;
    }

    echo "<h1>Jesse is gay</h1>";

    echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller().'controller.php','file'=>1,'name'=>'henk']);
    echo FormRepositorie::textarea('Omschrijving','', ['placeholder' => 'Jesse is gay']);
    echo FormRepositorie::radio('hi',['Jesse is gay'=>'test1','Jesse is super gay'=>'test2', 'Jesse is ultra gay'=>'test3'],'Jesse is ultra gay');
    echo FormRepositorie::formSaveButton('index.php');
    echo FormRepositorie::closeForm();
?>



<?php
    include_once('includes/footer.php');
?>