<?php

class TaskTest extends CDbTestCase
{
	public $fixtures=array(
            'tasks'=>'Tasks',
        );
	
        public function testCreateTask()
        {
            $model = new Task();
            $model->setAttributes(array(
                'role_id'=>'70',
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
            $this->assertEquals($task->role_id, '10');
            $this->assertEquals($task->name, 'sampleTaskName');
            $this->assertEquals($task->desc, 'sampleTaskDesc');
            $this->assertEquals($task->status, Task::STATUS_IN_PROGRESS);
        }

        public function testUpdateTask()
        {
            $task = $this->tasks('sampleTask');
            $task->setAttributes(array(
                'role_id'=>'50',
                'name'=>'sampleTaskNameUpdated',
                'desc'=>'sampleTaskDescUpdated',
                'status'=>Task::STATUS_COMPLETE_PENDING,
            ));
            $this->assertTrue($task->save());
            $this->assertEquals($task->id, '1');
            $this->assertEquals($task->role_id, '50');
            $this->assertEquals($task->name, 'sampleTaskNameUpdated');
            $this->assertEquals($task->desc, 'sampleTaskDescUpdated');
            $this->assertEquals($task->status, Task::STATUS_COMPLETE_PENDING);
        }

        public function testDeleteTask()
        {
            $task = $this->tasks('sampleTask');
            $this->assertTrue($task->delete);
            $this->assertEquals(empty(Task::models()->findAll()), true);
        }
            
}
