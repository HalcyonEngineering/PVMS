<?php

class RoleTest extends CDbTestCase
{
	public $fixtures=array(
            'roles'=>'Role',
			'users'=>'User',
        );
	
        public function testCreateRole()
        {
			$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
			Yii::app()->setComponent('session', $mockSession);
			
			// This portion of this code logs a manager to satisfy the
			// authentication of 
			$user = $this->users('sampleUser2');
			$identity = new UserIdentity($user->email, 'admin');
			$this->assertTrue($identity->authenticate());
			$this->assertTrue(Yii::app()->user->login($identity));
			
            $model = new Role();
            $model->setAttributes(array(
                'project_id'=>'1',
                'name'=>'Sample Role 1 Name',
                'desc'=>'Sample Role 1 Description',
                'colour'=>'#FF0000',
            ));
            $this->assertTrue($model->save());
			Yii::app()->session->destroy();
        }

        public function testCreateNullRole()
        {
            $model = new Role();
            $this->assertFalse($model->save());
        }

        public function testReadRole()
        {
            $role = $this->roles('sampleRole');
            $this->assertEquals($role->id, '1');
            $this->assertEquals($role->project_id, '1');
            $this->assertEquals($role->name, 'Sample Role 1 Name');
            $this->assertEquals($role->desc, 'Sample Role 1 Description');
            $this->assertEquals($role->colour, '#FF0000');
        }

        public function testUpdateRole()
        {
            $role = $this->roles('sampleRole');
            $role->setAttributes(array(
                'project_id'=>'2',
                'name'=>'Sample Role Name Edit',
                'desc'=>'Sample Role Description Edit',
                'colour'=>'#FF00FF',
            ));
            $this->assertTrue($role->save());
            $this->assertEquals($role->id, '1');
            $this->assertEquals($role->project_id, '2');
            $this->assertEquals($role->name, 'Sample Role Name Edit');
            $this->assertEquals($role->desc, 'Sample Role Description Edit');
            $this->assertEquals($role->colour, '#FF00FF');
        }

        public function testDeleteRole()
        {
            $role = $this->roles('sampleRole');
            $this->assertTrue($role->delete());
            $role2 = $this->roles('sampleRole2');
            $this->assertTrue($role2->delete());
			$role3 = $this->roles('sampleRole3');
            $this->assertTrue($role3->delete());
            $this->assertEquals(empty(Role::model()->findAll()), true);
        }
            
}
