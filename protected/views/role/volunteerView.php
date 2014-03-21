<h1> <?php echo $model->name; ?></h1>

<p><?php echo $model->desc; ?></p>

<?php
if ($onboardingModel != null){
echo "<p>".$onboardingModel->onboarding_welcome."</p>";

echo "<p>Instructions: ".$onboardingModel->onboarding_instructions." </p>";

echo "<p>Contact information: ".$onboardingModel->onboarding_contact."</p>";
}
?>

<div class="span-9 pull-right" ><!--Buttons-->
<div class="span-3" style="padding:5px;" >
<?php $this->widget('bootstrap.widgets.TbButton',
                    array(
                          'url' => Yii::app()->createUrl("role/index"),
                          'label' => 'Back to Roles',
                          ));
    ?>
</div>
<div class="span-3" style="padding:5px;" >
<?php $this->widget('ModalOpenButton',
                    array(
                      'button_id'=>'list-project-files-btn',
                      'url' => Yii::app()->createUrl("fileDoc/listParentFiles",array("role_id"=>$model->id)),
                      'label' => 'View files in project',
                      'type' => 'common',
                    ));
?>
</div>
<div class="span-3" style="padding:5px;" >
<?php $this->widget('ModalOpenButton',
                    array(
                      'button_id'=>'list-tasks-btn',
                      'url' => Yii::app()->createUrl("task/listTasks",array("role_id"=>$model->id)),
                      'label' => 'View tasks for role',
                      'type' => 'common',
                    ));
?>
</div>
</div><!--End of Buttons-->