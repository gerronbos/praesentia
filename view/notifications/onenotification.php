<?php
    include_once('../includes/head.php');
    use model\Notifications;

    $notification = Notifications::find($_GET['id']);
    echo '<b>'.$notification->from_user()->fullname().'</b>';
    echo '<p>'.$notification->message.'</p>';
    NotificationRepository::setSeen($notification); 

?>

<?php
    include_once('../includes/footer.php');
?>