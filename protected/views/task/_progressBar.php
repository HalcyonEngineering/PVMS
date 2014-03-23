<?php
//CVarDumper::dump($data->tasks);
$taskcount = count($data->tasks);
$statusCount = array(1 => 0, 2 => 0, 3=>0);
//$statusCount[1] number of in progress
//$statusCount[2] number of complete (pending)
//$statusCount[3] number of complete (verified)
foreach ($data->tasks as $task){
	$statusCount[$task->attributes['status']]++;
}

if($taskcount > 0){
	echo CHtml::encode("Progress:");
	$this->widget('bootstrap.widgets.TbProgress',
	              array(
		              'stacked'=>array(
			              array(
				              'type'=>'success',
				              'percent'=>($statusCount[3]/$taskcount)*100,
				              'htmlOptions'=>array(
					              'data-toggle'=>'tooltip',
					              'title'=>"Tasks Complete: $statusCount[3]",
				              ),
			              ),
			              array(
				              'type'=>'warning',
				              'percent'=>($statusCount[2]/$taskcount)*100,
				              'htmlOptions'=>array(
					              'data-toggle'=>'tooltip',
					              'title'=>"Tasks Pending: $statusCount[2]",
				              ),
			              ),
			              array(
				              'type'=>'info',
				              'percent'=>($statusCount[1]/$taskcount)*100,
				              'htmlOptions'=>array(
					              'data-toggle'=>'tooltip',
					              'title'=>"Tasks In Progress: $statusCount[1]",
				              ),
			              ),
		              )
	              )
	);
}

?>