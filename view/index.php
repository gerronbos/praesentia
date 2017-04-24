<?php
    include_once('includes/head.php');

    echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller().'controller.php','file'=>1,'name'=>'henk']);
    echo FormRepositorie::textarea('Omschrijving','');
    echo FormRepositorie::radio('hi',['test1'=>'test1','test2'=>'test2', 'test3'=>'test3'],'test2');
    echo FormRepositorie::formSaveButton('index.php');
    echo FormRepositorie::closeForm();
?>



<?php
    include_once('includes/footer.php');
?>