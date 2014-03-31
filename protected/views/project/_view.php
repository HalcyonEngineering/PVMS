<?php
	/**
	 * Project $data
	 */
?>

<div class="tile-view span-6">
	<?php
		echo CHtml::openTag('div',
		                    array(
			                    'class'=>'tile',
			                    'style'=>"border-color: ".$data->colour .';'
		                    )
		);
	?>
		<h3><b><?php echo CHtml::encode($data->name); ?></b></h3>

        <div class="tile-top">
	    <?php echo CHtml::encode($data->desc); ?>
	    <br />  <br />

       </div>
      <div class="tile-bottom">
<?php if (!empty($data->target)):?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('target').":"); ?></b><br />
		<?php

        $t = $data->getTargetDateInfo();
	echo CHtml::encode($t['targetString']);

	?><br />
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
                      array(
	                      'label' => TbHtml::icon(TbHtml::ICON_PENCIL),
	                      'type' => 'link',
	                      'encodeLabel' =>false,
	                      'button_id'=>'edit-project-'.$data->id,
	                      'url' => Yii::app()->createUrl("project/update", array("id"=>$data->id)),
	                      'htmlOptions'=>array(
                              'class' => 'pull-right',
		                      'title' => 'Edit',
		                      'data-toggle'=>'tooltip',
	                      ),
                      )
        );

        $this->widget('ModalOpenButton',
                      array(
	                      'label' => TbHtml::icon(TbHtml::ICON_TRASH),
	                      'type' => 'link',
	                      'encodeLabel' =>false,
	                      'button_id'=>'edit-project-'.$data->id,
	                      'url' => Yii::app()->createUrl("project/delete", array("id"=>$data->id)),
	                      'htmlOptions'=>array(
	                      		'params'=>array('returnUrl'=>Yii::app()->createUrl('project/index')),
                              'class' => 'pull-right',
		                      'title' => 'Delete',
		                      'data-toggle'=>'tooltip',
	                      ),
                      )
        );

        //this standard style won't work
		/*$csrfTokenName = Yii::app()->request->csrfTokenName;
		$csrfToken = Yii::app()->request->csrfToken;
        $this->widget('Bootstrap.widgets.TbButton',
                      array(
	                      'buttonType' => 'submit',
	                      //'type' => 'primary',
	                      'label' => TbHtml::icon(TbHtml::ICON_TRASH),
	                      'encodeLabel' =>false,
	                      'htmlOptions'=>array('submit'=>array('project/delete'),
								'params'=>array("id"=>$data->id,$csrfTokenName=>$csrfToken,'returnUrl'=>Yii::app()->createUrl('project/index'),),
								'confirm' => 'Delete project?',
								'class' => 'pull-right',
								'title' => 'Delete',
								'data-toggle'=>'tooltip',
	                      ),
                      )
        );*/
        ?>
      </div>
	<?php echo CHtml::closeTag('div')?>
</div>
