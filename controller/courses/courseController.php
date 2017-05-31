<?php
include_once('../controller.php');

if (isset($_GET['create'])) {
	CourseRepositorie::create($_POST['name'], $_POST['year'], $_POST['period']);

	Services\SessionHandler::setSession('create_course', 'Vak is succesvol toegevoegd.');
	header('location:'.MapStructureRepositorie::view().'courses/allCourses.php');
	exit;
}

if(isset($_GET['update'])){
	$course = model\Course::find($_GET['id']);
	CourseRepositorie::update($course, $_POST['name'], $_POST['year'], $_POST['period']);

	Services\SessionHandler::setSession('course_edit', 'Vak succesvol gewijzigd.');
	header('location:'.MapStructureRepositorie::view().'courses/allCourses.php');
	exit;
}

if(isset($_GET['delete_course'])){
	$course = model\Course::find($_GET['course_id']);
	CourseRepositorie::delete($course);
	Services\SessionHandler::setSession('course_delete', 'Vak succesvol verwijderd.');

	header("location:".MapStructureRepositorie::view()."courses/allCourses.php");
	exit;
}

?>