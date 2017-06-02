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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<?php

		echo FormRepositorie::openForm(['url' => MapStructureRepositorie::controller(). 'lecture/lectureController.php', 'method' => 'POST','send_type'=>'create']);
		echo FormRepositorie::text('Selecteer datum',date('Y-m-d'),['id'=>'datetimepicker','name'=>'date']);
		echo FormRepositorie::text('Begintijd', '', ['name'=>'start_time', 'placeholder' => '00:00']);
		echo FormRepositorie::text('Eindtijd', '', ['name'=>'end_time', 'placeholder' => '00:00']);
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
	function setRows(){
		var date = $('#datetimepicker').val();
		var table = '';
		$.ajax({
			url: "<?php echo MapStructureRepositorie::controller().'lecture/lectureController.php?get_by_group=1' ?>",
			method: "POST",
			data: {date: date,'group_id':'<?php echo Auth::user()->Group()->id; ?>'},
			success: function(data){
				console.log(data);

				data = JSON.parse(data);
				$('.lectures').remove();
				$.each(data,function(index){
					if(data[index].present){
						var present = "open_modal";
					}
					else{
						var present = "disabled"
					}
					$('.lecture_table').append("<tr class='lectures'><td>"+date+"</td><td>"+data[index].start_time+"</td><td>"+data[index].end_time+"</td><td>"+data[index].course+"</td><td><button class='btn btn-primary "+present+"' lecture_id='"+data[index].id+"'>Afmelden</button></td></tr>");
				});
				$('.open_modal').click(function(){
					$('#modal').modal();
					$('.lecture_id').remove();
					var form = document.getElementById('form');
					var input = document.createElement('input');
					input.type = 'hidden';
					input.name = 'lecture_id';
					input.className = 'lecture_id';
					input.setAttribute('value',$(this).attr('lecture_id'));
					form.appendChild(input);

				});
			}
		});
	}

	$('#datetimepicker').datepicker({
		dateFormat:"yy-mm-dd"
	});

	$('.save_modal').click(function(){
		var form = document.getElementById('form');
		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'reason';
		input.className = 'form_input';
		input.setAttribute('value',$('#reason').val());

		var input_user = document.createElement('input');
		input_user.type = 'hidden';
		input_user.name = 'user';
		input_user.className = 'form_input';
		input_user.setAttribute('value',user_id);

		$('.form_input').remove();

		form.appendChild(input);
		form.appendChild(input_user);

		form.submit();
	});
</script>