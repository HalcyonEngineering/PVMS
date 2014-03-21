<div class="form">
<?php echo CHtml::beginForm(); ?>

<div class="row">
    <?php echo CHtml::activeLabel($model,'username'); ?>
    <?php echo CHtml::activeTextField($model,'username') ?>
</div>

<div class="skillset-dropdown">
    <?php 
    $skill = new Skill('search');
    $list = CHtml::listData($skill->search()->getData(), 'id', 'name');
    Yii::trace("SKILL SEARCH: ".serialize($skill->search()->getData()));

    echo CHtml::activeLabel($model,'Skill');
    echo CHtml::dropDownList('skill_list', 'empty', $list, array('empty' => 'Any'));
    ?>
</div>

<div class="project-dropdown">
    <?php 
    $project = new Project('search');
    $list = CHtml::listData($project->search()->getData(), 'id', 'name');
    Yii::trace("PROJECt SEARCH: ".serialize($project->search()->getData()));

    echo CHtml::activeLabel($model, 'Project');
    echo CHtml::dropDownList('project_list', 'empty', $list, array('empty' => 'Any'));
    ?>
</div>

<?php echo CHtml::activeLabel($model,'Availability'); ?>
<div class="row checkbox">
    <?php echo CHtml::checkBox('Morning', true);  echo ' Morning<br>'; ?>
    <?php echo CHtml::checkBox('Evening', true);  echo ' Evening<br>'; ?>
    <?php echo CHtml::checkBox('Weekdays', true); echo ' Weekdays<br>'; ?>
    <?php echo CHtml::checkBox('Weekends', true); echo ' Weekends<br>'; ?>
</div>

<div class="row submit">
    <?php echo CHtml::submitButton('David', array('submit'=>'search')); ?>
</div>
 
<?php echo CHtml::endForm(); ?>