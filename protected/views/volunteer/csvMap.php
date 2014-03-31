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
    $this->pageTitle=Yii::app()->name . ' - CSV Mapping';
?>
<h1>Csv Mapping</h1>
<p style="width: 75%;">Choose your CSV mapping here:</p>

<?php
    echo CVarDumper::dumpAsString($fields);
?>
