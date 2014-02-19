<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<link rel="shortcut icon" href="/PVMS/images/favicon2.ico" type="image/x-icon" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
	<img src="/PVMS/images/Pitchnlogo.JPG" />
		<div id="logo"><?php $image_url='/PVMS/images/Pitchnlogo.JPG';?>
		<?php echo CHtml::encode(Yii::app()->name);
           $this->widget('zii.widgets.CMenu',array(
                                                   'items'=>array(array('label'=>'Advanced Search', 'url'=>array('site/page', 'view'=>'advancedSearch')),
                                                                  array('label'=>'User Name', 'url'=>array('site/page', 'view'=>'userName')),
                                                                  array('label'=>'Login', 'url'=>array('account/login'), 'visible'=>Yii::app()->user->isGuest),
                                                                  array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('account/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                                                  ),
                                                   ));
            ?></div>


	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Notifications', 'url'=>array('post/index')),
                array('label'=>'Projects', 'url'=>array('site/page', 'view'=>'projects')),
				array('label'=>'Calendar', 'url'=>array('site/page', 'view'=>'calendar')),
                array('label'=>'Add Volunteers', 'url'=>array('site/page', 'view'=>'import')),
                array('label'=>'Email', 'url'=>array('mail/contact')),
				array('label'=>'Settings', 'url'=>array('account/settings')),
				array('label'=>'About', 'url'=>array('site/page', 'view'=>'about')),
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>
<!--
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>