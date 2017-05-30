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

}
