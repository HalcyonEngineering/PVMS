<h1>Notifications</h1>
<p>List of all notifications in order of recency.</p>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><b>Warning</b></h4>
</div>

<div id="read_allConfirm" class="modal-body">
    <p>Are you sure you want to mark all notifications as "read"?</p>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'success',
        'label'=>'Yes',
        'url'=>$this->createURL('notification/readAll'),
        //'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancel',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>

<?php $this->endWidget(); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Mark all Notifications as "Read"',
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ),
));?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'emptyText' => '<center><i>You currently have no notifications.</i></center>'
)); ?>
