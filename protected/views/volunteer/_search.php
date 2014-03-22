<div class="form">
<?php echo CHtml::beginForm(); ?>

<div class="row">
    <?php echo CHtml::activeLabel($model,'Name'); ?>
    <?php echo CHtml::activeTextField($model,'username') ?>
    <p class="hint">Leave blank to search all volunteers.</p>
</div>

<div class="location-dropdown">
    <?php 
    $location = new Location('search');
    $list = CHtml::listData($location->search()->getData(), 'id', 'name');

    echo CHtml::activeLabel($model, 'Location');
    echo CHtml::dropDownList('location_list', 'empty', $list, array('empty' => 'Any'));
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
    <?php echo CHtml::checkBox('Morning', false);  echo ' Morning<br>'; ?>
    <?php echo CHtml::checkBox('Evening', false);  echo ' Evening<br>'; ?>
    <?php echo CHtml::checkBox('Weekdays', false); echo ' Weekdays<br>'; ?>
    <?php echo CHtml::checkBox('Weekends', false); echo ' Weekends<br>'; ?>
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

<div class="row submit">
    <?php echo CHtml::submitButton('Refine Volunteer List', array('submit'=>'search')); ?>
</div>
 
<?php echo CHtml::endForm(); ?>