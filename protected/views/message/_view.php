<?php
	$this->beginWidget('CHtmlPurifier');
	echo '<div class="message-subject">';
    echo '<div class="span-4">';
	echo "<b>Subject : </b>" . nl2br($data->subject);
    echo '</div>';
    echo '<div class="span-4">';
	$ts = $data->getTimestampInfo();
    echo "<b>Sent:</b>".$ts['timeString'];
    echo '</div>';
    echo '<br\>';
	echo '</div>';
	echo '<div class="message-body span-18">';
	echo nl2br($data->body);
	echo '</div>';
	$this->endWidget();