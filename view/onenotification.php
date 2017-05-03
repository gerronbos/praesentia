<?php
    include_once('includes/head_with_notifications.php');
    use model\Notifications;

    $notification = Notifications::find($_GET['id']);
    echo '<b>'.$notification->from_user()->fullname().'</b>';
    echo '<p>'.$notification->message.'</p>';
    $notification->setSeen(); 

?>

<?php
    include_once('includes/footer.php');
?>