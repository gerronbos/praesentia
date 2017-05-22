<?php
function progressBar($perc){
	if ($perc <= 50) {
		$type = "progress-bar-danger";
	}
	elseif ($perc < 90) {
		$type = "progress-bar-warning";
	}
	else{
		$type = "progress-bar-success";
	}

	return '<div class="progress">
  <div class="progress-bar '.$type.'" role="progressbar" aria-valuenow="'.$perc.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$perc.'%">
    '.$perc.'
  </div>
</div>';
}
?>