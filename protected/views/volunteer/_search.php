<div class="form">
<?php echo CHtml::beginForm();
    $c = new CDbCriteria;
    $c->order = 'name';
?>

<div class="row">
    <?php echo CHtml::activeLabel($model,'Name'); ?>
    <?php echo CHtml::activeTextField($model,'username') ?>
    <p class="hint">Leave blank to search all volunteers.</p>
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
        echo CHtml::activeLabel($model,'Skill');
        echo CHtml::activeDropDownList(
            $skill,
            'id',
            CHtml::listData( Skill::model()->findAll($c), 'id', 'name' ),
            array('prompt'=>'Any')
            );
    ?>
</div>

<div class="row submit">
    <?php echo CHtml::submitButton('Refine Volunteer List', array('submit'=>'search')); ?>
</div>
 
<?php echo CHtml::endForm(); ?>
