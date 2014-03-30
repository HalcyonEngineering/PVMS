<?php
	$this->beginWidget('CHtmlPurifier');
	if(Yii::app()->user->isManager()) echo "<i>(Below is what your volunteers will see)</i>";?><br /><br />
<center>
	<?php //if(Yii::app()->user->isManager()) echo "<b>Welcome message:</b><br>";?>

	<?php echo nl2br($model->onboarding_welcome); ?><br /><br />
	<b>Instructions:</b><br><?php echo nl2br($model->onboarding_instructions); ?><br /><br />
	<b>Contact information:</b><br><?php echo nl2br($model->onboarding_contact); ?>
</center>

<?php $this->endWidget();?>