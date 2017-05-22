<?php include_once('../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
/*if(Auth::user()->id != $user->id) {
	if (!Auth::user()->can('user')) {
		header("location: " . MapStructureRepositorie::error('401'));
		exit;
	}
}*/
$group = model\Group::find($_GET['group_id']);
?>

<div class="">
	<div class="x_panel">
		<div class="x_title">
			<h3><?php echo $group->name ?></h3>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
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
							foreach (model\Users::orderBy('lastname','asc')->get() as $user) {
								echo "<tr><td>".$user->fullnameReturned()."</td><td>$user->user_number</td><td>$user->email</td><td>
								<canvas id='bar' width='300px' height='100px'></canvas>
							</td></tr>";
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
	var labels = [];
	var data = [];
	<?php foreach($data as $d){
		echo "labels.push('".$d['title']."');";
		echo "data.push('".$d['amount_present_prec']."');";
	}
	?>
	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
		type: 'doughnut',
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
						return tooltipItems.yLabel + ' : ' + tooltipItems.xLabel + "%"; 
					}
				}
			}
		}
	});

	var ctx = document.getElementById("bar");
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
						return tooltipItems.yLabel + ' : ' + tooltipItems.xLabel + "%"; 
					}
				}
			}
		}
	});
</script>