<?php
	include_once('../includes/head.php');
	if (!Auth::user()->can('lectures')) {
    header("location: " . MapStructureRepositorie::error('401'));
    exit;
}

$courses = model\Course::lists('name','id');
$users_list = UserRepositorie::getUsersByRole('presence')->get();
$users = [];
foreach($users_list as $user){
    $users[$user->id] = "($user->user_number) ".$user->fullname().", ".$user->Roles()->title;
}
$groups = model\Group::lists('name','id');
$rooms = model\Room::lists('number','id');
	?>

<div class="x_panel">
	<div class="x_title">
		<h2>Les aanmaken </h2>
		<ul class="nav navbar-right panel_toolbox"></ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
	<?php

	echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'lecture/lectureController.php', 'method' => 'POST','send_type'=>'create']);
	echo FormRepositorie::text('Datum', '',['name'=>'date']);
	echo FormRepositorie::text('Begintijd', '', ['name'=>'start_time']);
	echo FormRepositorie::text('Eindtijd', '', ['name'=>'end_time']);
	echo FormRepositorie::select2('Kamernummer',$rooms, '', ['name'=>'room_id']);
	echo FormRepositorie::select2('Vak',$courses, '', ['name'=>'course_id','class'=>'select2']);
	echo FormRepositorie::select2('Docent',$users, '', ['name'=>'user_id','class'=>'select2']);
	echo FormRepositorie::select2('Groep',$groups, '', ['name'=>'groups[]','class'=>'select2','multiple'=>1]);
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
</script>