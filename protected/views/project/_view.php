<div class="tile-view span-6">
	<div class="tile" style=<?php echo "border-color:" . CHtml::encode($data->colour).";";?>>
		<h3><b><?php echo CHtml::encode($data->name); ?></b>

</h3>

        <div class="tile-top">
	    <?php echo CHtml::encode($data->desc); ?>
	    <br />  <br />

       </div>
      <div class="tile-bottom">
<?php if (!empty($data->target)):?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('target').":"); ?></b><br />
	<!-- eeee MMMM d yyyy -->
		<?php
	echo Yii::app()->dateFormatter->format('eeee, MMMM d yyyy', $data->target);



	?></br>
<?php endif; ?>
		<?php

		$this->renderPartial('/task/_progressBar',array('data'=>$data));
		?>
<?php
$this->widget(
              'bootstrap.widgets.TbButton',
              array(
                    'label' => 'View',
                    'type' => 'primary',
                    'url' => array('/project/view','id'=>$data->id),
                    )
              );
    ?>

<?php
        Yii::import('bootstrap.helpers.TbHtml');
        $this->widget('ModalOpenButton',
                      array('label' => TbHtml::icon(TbHtml::ICON_PENCIL),
                            'type' => 'link',
                            'encodeLabel' =>false,
                            'button_id'=>'edit-project-'.$data->id,
                            'url' => Yii::app()->createUrl("project/update", array("id"=>$data->id))
                            )
                      );
        ?>



      </div>

	</div>
</div>
