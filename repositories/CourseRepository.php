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

	public function update($course ,$data = array()){
        if (isset($data['name'])) {
            $course->name = $data['name'];
        }
        if (isset($data['year'])) {
            $course->year = $data['year'];
        }
        if (isset($data['period'])) {
            $course->period = $data['period'];
        }
        $course->save();

        return $course;
    }

}
