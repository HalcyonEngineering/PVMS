<?php

class TaskTest extends CDbTestCase
{
	public $fixtures=array(
            'tasks'=>'Task',
			'users'=>'User',
        );
	
        public function testCreateTask()
        {
            $model = new Task();
            $model->setAttributes(array(
                'role_id'=>'1',
                'name'=>'sampleTaskName',
                'status'=>Task::STATUS_IN_PROGRESS,
                'desc'=>'sampleTaskDesc',
            ));
        
            $this->assertTrue($model->save());
        }

        public function testCreateNullTask()
        {
            $model = new Task();
            $this->assertFalse($model->save());
        }

        public function testReadTask()
        {
            $task = $this->tasks('sampleTask');
            $this->assertEquals($task->id, '1');
            $this->assertEquals($task->name, 'Sample Task Name');
            $this->assertEquals($task->role_id, '10');
            $this->assertEquals($task->desc, 'sampleTaskDesc');
            $this->assertEquals($task->status, Task::STATUS_IN_PROGRESS);
        }

        public function testUpdateTask()
        {
			$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
			Yii::app()->setComponent('session', $mockSession);
			// This portion of this code logs a manager to satisfy the
			// authentication of 
			$user = $this->users('sampleUser2');
			$identity = new UserIdentity($user->email, 'admin');
			$this->assertTrue($identity->authenticate());
			$this->assertTrue(Yii::app()->user->login($identity));
			
            $task = $this->tasks('sampleTask');

            $task->setAttributes(array(
                'role_id'=>'10',
                'name'=>'sampleTaskNameUpdated',
                'desc'=>'sampleTaskDescUpdated',
                'status'=>Task::STATUS_COMPLETE_PENDING,
            ));

            $this->assertTrue($task->save());
            $this->assertEquals($task->id, '1');
            $this->assertEquals($task->role_id, '10');
            $this->assertEquals($task->name, 'sampleTaskNameUpdated');
            $this->assertEquals($task->desc, 'sampleTaskDescUpdated');
            $this->assertEquals($task->status, Task::STATUS_COMPLETE_PENDING);
			Yii::app()->session->destroy();
        }

        public function testDeleteTask()
        {
            $task = $this->tasks('sampleTask');
            $this->assertTrue($task->delete());
            $task2 = $this->tasks('sampleTask2');
            $this->assertTrue($task2->delete());
            $this->assertEquals(empty(Task::model()->findAll()), true);
        }
            
}