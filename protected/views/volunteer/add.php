<?php
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array(), // success, info, warning, error or danger
            'error'=>array(), // success, info, warning, error or danger
        ),
    ));
?>

<?php
    $this->pageTitle=Yii::app()->name . ' - Add Volunteers';
?>
<h1>Add Your Volunteers</h1>
<p style="width: 75%;">You can add a volunteer manually by filling out a form, or add multiple volunteers at a time by uploading a CSV file. All volunteers which you add will receive an email for confirming an account creation.</p>
<div class="form">
    <table style="width:600px; padding:0px;"><tr>
        <td style="padding:0px"><?php echo $formView; ?></td>
        <td style="padding:0px; width:300px; vertical-align:top;"><?php echo $csvView; ?></td>
    </tr></table>
</div><!-- form -->
