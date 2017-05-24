<?php
function progressBar($perc,$params=array()){
	if ($perc <= 50) {
		$type = "progress-bar-danger";
	}
	elseif ($perc < 90) {
		$type = "progress-bar-warning";
	}
	else{
		$type = "progress-bar-success";
	}

	$return ='<div class="progress">
        <div class="progress-bar progress-bar '.$type.' active" role="progressbar" aria-valuenow="'.$perc.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$perc.'%"';
    if(isset($params['item_id'])){
    	$return .= "item_id='".$params['item_id']."'";
    }
        $return .= '>'.$perc.'%
        </div>
    </div>';

    return $return;
}
?>