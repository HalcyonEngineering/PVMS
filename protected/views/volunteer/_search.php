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
    <?php echo CHtml::activeLabel($model,'Name'); ?>
    <?php echo CHtml::activeTextField($model,'username') ?>
    <p class="hint">Leave blank to search all volunteers.</p>
</div>
<div class="row submit">
<?php echo CHtml::submitButton('Refine Volunteer List', array('submit'=>'search')); ?>
</div>
</td>
<td style="padding:0px; width:300px; vertical-align:top;">
<div class="project-dropdown">
<?php
    $project = new Project('search');
    echo CHtml::activeLabel($model,'Project');
    echo CHtml::activeDropDownList(
                                   $project,
                                   'id',
                                   CHtml::listData( Project::model()->findAll($c), 'id', 'name' ),
                                   array('prompt'=>'Any')
                                   );
    ?>
</div>
<div class="skillset-dropdown">
    <?php 
        $skill = new Skill('search');
        echo CHtml::activeLabel($model,'Skill');
        echo CHtml::activeDropDownList(
            $skill,
            'id',
            CHtml::listData( Skill::model()->findAll($c), 'id', 'name' ),
            array('prompt'=>'Any')
            );
    ?>
</div>
<div class="location-dropdown">
<?php
    $location = new Location('search');
    echo CHtml::activeLabel($model,'Location');
    echo CHtml::activeDropDownList(
                                   $location,
                                   'id',
                                   CHtml::listData( Location::model()->findAll($c), 'id', 'name' ),
                                   array('prompt'=>'Any')
                                   );
    ?>
</div>

</td>
<td style="padding:0px; width:300px; vertical-align:top;">
<div class="row radiogroup">
<?php
    $status = array(
                    0=>'Not available',
                    1=>'Weekdays',
                    2=>'Weekends',
                    3=>'Weekdays & Weekends',
                    );
    echo $form->radioButtonListRow($model, 'availability', $status,
                                   array('labelOptions'=>array('style'=>'font: normal 11pt Calibri;'))
                                   );
    ?>
</div>
</td>
</tr>
</table>
<?php echo CHtml::endForm(); ?>

<?php $this->endWidget(); ?>
</div>
