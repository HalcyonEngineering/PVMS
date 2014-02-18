<?php $this->beginContent('/layouts/main'); ?>
    <div class="container">
        <div class="span-6 first">
            <div id="sidebar">
                <?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>

                <?php $this->widget('TagCloud', array(
                    'maxTags'=>Yii::app()->params['tagCloudCount'],
                )); ?>

                <?php $this->widget('RecentComments', array(
                    'maxComments'=>Yii::app()->params['recentCommentCount'],
                )); ?>
            </div><!-- sidebar -->
        </div>
        <div class="span-18 last">
            <div id="content">
                <?php echo $content; ?>
            </div><!-- content -->
        </div>

    </div>
<?php $this->endContent(); ?>