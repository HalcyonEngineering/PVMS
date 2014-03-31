<?php
$this->pageTitle=Yii::app()->name . ' - Error';
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php
	if(isset($message)){
		echo CHtml::encode($message);
	} else {
		echo CHtml::encode('You do not have permission to perform this action.');
	}

?>
</div>