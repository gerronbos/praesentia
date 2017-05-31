<?php
use model\Course as Course;

class CourseRepositorie extends Repository
{
	public function create($name, $year, $period){
		$course = new Course();
		$course->name = $name;
		$course->year = $year;
		$course->period = $period;
		$course->save();

		return $course;
	}

	public function update($course, $name, $year, $period){

		$course->name = $_POST['name'];
		$course->year = $_POST['year'];
		$course->period = $_POST['period'];
		$course->save();

		return $course;
	}

}
