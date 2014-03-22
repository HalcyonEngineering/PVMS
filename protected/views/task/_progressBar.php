<?php

$taskcount = count($data->tasks);
if($taskcount > 0){

	$this->widget('bootstrap.widgets.TbProgress',
	              array(
		              'stacked'=>array(
			              array(
				              'type'=>'success',
				              'percent'=>($data->taskComplete/$taskcount)*100,
				              'htmlOptions'=>array(
					              'data-toggle'=>'tooltip',
					              'title'=>"Tasks Complete: $data->taskComplete",
				              ),
			              ),
			              array(
				              'type'=>'info',
				              'percent'=>($data->taskPending/$taskcount)*100,
				              'htmlOptions'=>array(
					              'data-toggle'=>'tooltip',
					              'title'=>"Tasks Pending: $data->taskPending",
				              ),
			              ),
			              array(
				              'type'=>'warning',
				              'percent'=>($data->taskInProgress/$taskcount)*100,
				              'htmlOptions'=>array(
					              'data-toggle'=>'tooltip',
					              'title'=>"Tasks In Progress: $data->taskInProgress",
				              ),
			              ),
		              )
	              )
	);
}

?>