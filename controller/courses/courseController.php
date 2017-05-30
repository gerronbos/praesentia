<?php
include_once('../controller.php');

if (isset($_GET['create'])) {
	CourseRepositorie::create($_POST['name'], $_POST['year'], $_POST['period']);

	Services\SessionHandler::setSession('create_course', 'Vak is succesvol toegevoegd.');
	header('location:'.MapStructureRepositorie::view().'courses/allCourses.php');
	exit;
}

if(isset($_GET['update'])){
  CourseRepository::update($course, $_POST);

  Services\SessionHandler::setSession('course_edit', 'Vak succesvol gewijzigd.');
  header('location:'.MapStructureRepositorie::view().'courses/allCourses.php');
  exit;
}

?>