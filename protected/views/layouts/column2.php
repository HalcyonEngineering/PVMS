<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-6 last">
<div id="sidebar">
<?php
    
    $this->widget('bootstrap.widgets.TbMenu', array(
                                              'type'=>'pills',
                                            'stacked'=>true,
                                             'items'=>$this->menu,
                                             
                                             ));
 
    ?>
</div><!-- sidebar -->
</div>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	</div>
<?php $this->endContent(); ?>
