<?php
include_once('../includes/head.php');
if (!Auth::user()->can('lectures')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
$lecture = model\Lecture::find(Services\SessionHandler::getSession('edit_lecture'));
$groups = model\Group::lists('name','id');
$rooms = model\Room::lists('number','id');
$courses = model\Course::lists('name','id');
$users_list = UserRepositorie::getUsersByRole('presence')->get();
$users = [];
foreach($users_list as $user){
	$users[$user->id] = "($user->user_number) ".$user->fullname().", ".$user->Roles()->title;
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Les wijzigen</h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php


		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'lecture/lectureController.php', 'method' => 'POST','send_type'=>'edit_lecture']);
		echo "<input type='hidden' name='lecture_id' value='$lecture->id'>";
		echo FormRepositorie::text('Selecteer datum',$lecture->date,['id'=>'datetimepicker','name'=>'date']);
		echo FormRepositorie::text('Begintijd', $lecture->start_time, ['name'=>'start_time', 'placeholder' => '00:00']);
		echo FormRepositorie::text('Eindtijd', $lecture->end_time, ['name'=>'end_time', 'placeholder' => '00:00']);
		echo FormRepositorie::select2('Kamernummer',$rooms, $lecture->room_id, ['name'=>'room_id']);
		echo FormRepositorie::select2('Vak',$courses, $lecture->course_id, ['name'=>'course_id','class'=>'select2']);
		echo FormRepositorie::select2('Docent',$users, $lecture->user_id, ['name'=>'user_id','class'=>'select2']);
		echo FormRepositorie::select2('Groep',$groups, $lecture->Groups(['no_get'=>1])->lists('id'), ['name'=>'groups[]','class'=>'select2','multiple'=>1]);
		echo FormRepositorie::formSaveButton("javascript:history.back()");
		echo FormRepositorie::closeForm();
		?>
	</div>
</div>

<?php
include_once('../includes/footer.php');
?>

<script>
	$(document).ready(function() {
		$(".select2").select2({
			placeholder: "Selecteer"
		});
	});
	


		$('#datetimepicker').datepicker({
			dateFormat:"yy-mm-dd"
		});

	</script>