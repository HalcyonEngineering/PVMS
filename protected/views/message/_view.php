<?php
	$this->beginWidget('CHtmlPurifier');
	echo '<div class="message-subject">';
	echo "Subject: " . nl2br($data->subject);
	echo '</div>';
	echo '<div class="message-body">';
	echo nl2br($data->body);
	echo '</div>';
	$this->endWidget();