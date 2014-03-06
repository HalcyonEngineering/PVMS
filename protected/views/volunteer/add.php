<?php
    $this->pageTitle=Yii::app()->name . ' - Add Volunteers';
    $this->breadcrumbs=array('Add Volunteers');
?>

<h1>Add Volunteers</h1>
<p>You can add a volunteer manually by filling out a form, or add many volunteers at a time by using uploading a CSV file. Any volunteers which you add will be sent an email, confirming an account creation.</p>

<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<div class="form">

<?php 
    echo $formView;
    echo $csvView; 
?>

</div><!-- form -->
