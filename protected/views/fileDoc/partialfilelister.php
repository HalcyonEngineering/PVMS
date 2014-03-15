<h1>partial file lister: project <?php echo $projectid; ?></h1>

<?php echo $this->renderPartial('_files',array('projectid'=>$projectid,
												'dataProvider'=>$dataProvider,)); ?>