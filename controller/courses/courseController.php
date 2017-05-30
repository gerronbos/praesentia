<?php
include_once('../controller.php');

if (isset($_GET['create'])) {
	CourseRepositorie::create($_POST['name'], $_POST['year'], $_POST['period']);

	Services\SessionHandler::setSession('create_course', 'Vak is succesvol toegevoegd.');
	header('location:'.MapStructureRepositorie::view().'courses/allCourses.php');
	exit;
}

?>