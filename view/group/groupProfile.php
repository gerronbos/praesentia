<?php include_once('../includes/head.php');
$user = Services\SessionHandler::getSession('user_data');
if (!Auth::user()->can('groups') || !Auth::user()->can('presence')) {
	header("location: " . MapStructureRepositorie::error('401'));
	exit;
}
$group = model\Group::find($_GET['group_id']);
$data2 = PresenceRepository::getByCourse(model\Course::find(1),['group_id'=>48]);

?>

<div class="">
	<div class="x_panel">
		<div class="x_title">
			<h2><?php echo $group->name ?></h2>
			<?php
			echo "<a href='".MapStructureRepositorie::view()."group/allgroups.php' class='btn btn-primary' style='float: right'>Terug naar alle groepen</a>";
			?>
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
								<th></th>
								<th>Naam</th>
								<th>Gebruikersnaam</th>
								<th>Email</th>
								<th>Aanwezigheid</th>
							</tr>
							<?php
							foreach ($group->Users() as $user) {
								$data = PresenceRepository::calcPresenceByUser($user,['grouped' => 1]);
								echo "<tr><td style='text-align: center'><img width='60px' src='".$user->getUserProfilePicture()."'></td><td>".$user->fullnameReturned(['url'=>1])."</td><td>$user->user_number</td><td>$user->email</td><td>";
								echo progressBar($data['amount_present_prec'],['item_id'=>$user->id])."</tr>";
							}
							?>
						</table>
						<a target="_blank" href="<?php echo MapStructureRepositorie::Controller() ?>pdfController.php?GroupSummary=1&gid=<?php echo $group->id ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Opslaan als PDF</a>
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
                label:'Procent aanwezig',
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
			scales: {
				yAxes: [{
					display: true,
					ticks: {
						beginAtZero: true,
						steps: 10,
						stepValue: 10,
						max: 100
					}
				}]
			},
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
	$(document).ready(function(){
		var url = '<?php echo MapStructureRepositorie::controller()."user/userController.php?show=1&user_id=".$user->id ?>';
		$('.progress-bar').click(function(){
            //do something
            var courseId = $(this).attr('item_id');
            window.location.href = url.replace(':id', courseId);
        });
	});
</script>