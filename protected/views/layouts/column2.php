<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- begin layout-->
	<div id="content" class="span-20 last">
		<?php
		if(Yii::app()->user->isManager()){
			$this->widget('bootstrap.widgets.TbBreadcrumbs',
			              array('links'=>$this->breadcrumbs,
			                    'homeLink'=>CHtml::link('Projects',$this->createUrl('/project/index'))));
		}
		?>
			<?php echo $content; ?>
		</div><!-- content -->
<!-- end layout-->
<?php $this->endContent(); ?>