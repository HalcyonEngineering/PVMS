<div class="form">
<?php echo CHtml::beginForm();
    $c = new CDbCriteria;
    $c->order = 'name';
?>

<?php 
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm', 
        array(
            'id'=>'add-volunteer-manual-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array('validateOnSubmit'=>true,),
            'enableAjaxValidation'=>false,
        )
    ); 
?>
<table style="width:100%; padding:0px;">
<tr>
<td style="padding:0px; width:300px; vertical-align:top;">
<div class="row" style="margin:0px;">
<?php echo CHtml::activeTextField($model,'username', array('placeholder'=>'Name')); ?>
</div>
<div class="row radiogroup">
<?php
    $status = array('Weekdays'=>'Weekdays', 'Weekends'=>'Weekends');
    echo $form->checkBoxListRow(
        $model,
        'availability',
        $status,
        array(
            'labelOptions'=>array('style'=>'font: normal 11pt Calibri;')
        )
    );
?>
</div>
<p class="hint">Leave fields blank to search all volunteers.</p>
<div class="row submit">
<?php echo CHtml::submitButton('Search', array('submit'=>'search')); ?>
</div>
</td>
<td style="padding:0px; width:300px; vertical-align:top;">
<div class="project-dropdown">
<?php
    $project = new Project('search');
    echo CHtml::activeDropDownList(
                                   $project,
                                   'id',
                                   CHtml::listData( Project::model()->findAll($c), 'id', 'name' ),
                                   array('prompt'=>'All Projects')
                                   );
    ?>
</div>
<div class="skillset-dropdown">
    <?php 
        $skill = new Skill('search');
        echo CHtml::activeDropDownList(
            $skill,
            'id',
            CHtml::listData( Skill::model()->findAll($c), 'id', 'name' ),
            array('prompt'=>'All Skills')
            );
    ?>
</div>
<div class="location-dropdown">
<?php
    $location = new Location('search');
    echo CHtml::activeDropDownList(
                                   $location,
                                   'id',
                                   CHtml::listData( Location::model()->findAll($c), 'id', 'name' ),
                                   array('prompt'=>'Any Location')
                                   );
    ?>
</div>

</td>
</tr>
</table>
<?php echo CHtml::endForm(); ?>

<?php $this->endWidget(); ?>
</div>
