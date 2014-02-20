<?php
$this->pageTitle=Yii::app()->name . ' - Calendar';
$this->breadcrumbs=array(
	'Calendar',
);
        $this->widget('ext.EFullCalendar.EFullCalendar', array(
                                                               
                                                               // Set your themes
                                                               'themeCssFile'=>'cupertino/theme.css',
                                                               
                                                               // raw html tags
                                                               'htmlOptions'=>array(
                                                                                    // you can scale it down as well, try 80%
                                                                                    'style'=>'width:100%'
                                                                                    ),
                                                               // FullCalendar's options.
                                                               // Documentation available at
                                                               // http://arshaw.com/fullcalendar/docs/
                                                               'options'=>array(
                                                                                'header'=>array(
                                                                                                'left'=>'prev,next',
                                                                                                'center'=>'title',
                                                                                                'right'=>'today'
                                                                                                ),
                                                                                'lazyFetching'=>true,
                                                                                // 'events'=>$calendarEventsUrl, // action URL for dynamic events, or
                                                                                'events'=>array() // pass array of events directly
                                                                                
                                                                                // event handling
                                                                                // mouseover for example
                                                                                //  'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
                                                                                )
                                                               ));
    
    
?>
<