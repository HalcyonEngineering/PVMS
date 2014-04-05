<?php

class NotificationTest extends CDbTestCase
{
	public $fixtures=array(
            'notifications'=>'Notifications',
        );
	
        public function testCreateNotification()
        {
            $model = new Notification();
            $model->setAttributes(array(
                'user_id'=>'70',
                'timestamp'=>time(),
                'link'=>'sampleLink',
            ));
        
            $this->assertTrue($model->save());
        }

        public function testCreateNullNotification()
        {
            $model = new Notificationanzation();
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
                'user_id'=>'50',
                'link'=>'sampleNotificationLinkUpdated',
            ));
            $this->assertTrue($notification->save());
            $this->assertEquals($notification->id, '1');
            $this->assertEquals($notification->user_id, '50');
            $this->assertEquals($notification->link, 'sampleNotificationLinkUpdated');
        }

        public function testDeleteNotification()
        {
            $notification = $this->notifications('sampleNotification');
            $this->assertTrue($notification->delete());
            $this->assertEquals(empty(Notification::models()->findAll()), true);
        }
            
}
