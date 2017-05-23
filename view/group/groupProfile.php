<?php include_once('../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
/*if(Auth::user()->id != $user->id) {
	if (!Auth::user()->can('user')) {
		header("location: " . MapStructureRepositorie::error('401'));
		exit;
	}
}*/
$group = model\Group::find($_GET['group_id']);
$data2 = PresenceRepository::getByCourse(model\Course::find(1),['group_id'=>48]);

?>

<div class="">
	<div class="x_panel">
		<div class="x_title">
			<h3><?php echo $group->name ?></h3>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
		<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
  aria-valuemin="0" aria-valuemax="100" style="width:40%">
    40% Complete (success)
  </div>
</div>
			<div class="" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
					<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Overzicht</a>
					</li>
					<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Aanwezigheid per student</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
						<canvas id="myChart" style="height: 300px; width: 300px"></canvas>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
						<table class="table table-bordered">
							<tr>
								<th>Naam</th>
								<th>Gebruikersnaam</th>
								<th>Email</th>
								<th>Opties</th>
							</tr>
							<?php
							foreach ($group->Users() as $user) {
								$data = PresenceRepository::calcPresenceByUser($user,['grouped' => 1]);
								echo "<tr><td>".$user->fullnameReturned(['url'=>1])."</td><td>$user->user_number</td><td>$user->email</td><td>";
								echo progressBar($data['amount_present_prec'])."</tr>";
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

</div>


<?php include_once('../includes/footer.php');
$data = PresenceRepository::calcPresenceByGroup($group);
?>
<script>
    var onClickUrl = '<?php echo MapStructureRepositorie::view()."lecture/presence/presence.php?group_id=$group->id&course_name=:name";?>';
	var labels = [];
	var data = [];
	<?php foreach($data as $d){
		echo "labels.push('".$d['title']."');";
		echo "data.push('".$d['amount_present_prec']."');";
	}
	?>
    var canvas = document.getElementById("myChart");
	var ctx = canvas.getContext("2d");
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: labels,
			datasets: [{
				backgroundColor: [
				"#2ecc71",
				"#3498db",
				"#95a5a6",
				"#9b59b6",
				"#f1c40f",
				"#e74c3c",
				"#34495e"
				],
				data: data
			}]
		},
		options: {
			tooltips: {
				enabled: true,
				mode: 'single',
				callbacks: {
					label: function(tooltipItems, data) {
						return tooltipItems.xLabel + ' : ' + tooltipItems.yLabel + "%";
					}
				}
			}
		}


	});

    canvas.onclick = function (evt) {
        var activePoints = myChart.getElementsAtEvent(evt);
        var chartData = activePoints[0]['_chart'].config.data;
        var idx = activePoints[0]['_index'];

        var label = chartData.labels[idx];
        var url = onClickUrl.replace(':name',label);
        window.location.href = url;

    };

</script>