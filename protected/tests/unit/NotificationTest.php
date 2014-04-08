<?php

class NotificationTest extends CDbTestCase
{
	public $fixtures=array(
            'notifications'=>'Notification',
        );
	
        public function testCreateNotification()
        {
            $model = new Notification();
            $model->setAttributes(array(
                'user_id'=>'2',
                'timestamp'=>time(),
                'link'=>'sampleLink',
				'description'=>'sampleDescription',
            ));
        
			$this->assertTrue($model->save());
        }

        public function testCreateNullNotification()
        {
            $model = new Notification();
            $this->assertFalse($model->save());
        }

        public function testReadNotification()
        {
            $notification = $this->notifications('sampleNotification');
            $this->assertEquals($notification->id, '1');
            $this->assertEquals($notification->user_id, '10');
            $this->assertEquals($notification->link, 'sampleNotificationLink');
        }

        public function testUpdateNotification()
        {
            $notification = $this->notifications('sampleNotification');
            $notification->setAttributes(array(
                'user_id'=>'1',
                'link'=>'sampleNotificationLinkUpdated',
            ));
            $this->assertTrue($notification->save());
            $this->assertEquals($notification->id, '1');
            $this->assertEquals($notification->user_id, '1');
            $this->assertEquals($notification->link, 'sampleNotificationLinkUpdated');
        }

        public function testDeleteNotification()
        {
            $notification = $this->notifications('sampleNotification');
            $this->assertTrue($notification->delete());
            $this->assertEquals(empty(Notification::model()->findAll()), true);
        }
            
}
