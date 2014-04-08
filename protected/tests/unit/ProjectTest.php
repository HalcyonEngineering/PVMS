<?php


class ProjectTest extends CDbTestCase
{
	public $fixtures=array(
            'projects'=>'Project',
			'users'=>'User',
        );
	
        public function testCreateProject()
        {
			// This portion of this code logs a manager to satisfy the
			// authentication of 
			$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
			Yii::app()->setComponent('session', $mockSession);
			
			$user = $this->users('sampleUser2');
			$identity = new UserIdentity($user->email, 'admin');
			$this->assertTrue($identity->authenticate());
			$this->assertTrue(Yii::app()->user->login($identity));
			
            $model = new Project();
            $model->setAttributes(array(
                'org_id'=>'1',
                'name'=>'Sample Project Name',
                'desc'=>'Sample Project Description',
                'colour'=>'#FF0000',
            ));
            $this->assertTrue($model->save());
			Yii::app()->session->destroy();
        }

        public function testCreateNullProject()
        {
			$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
			Yii::app()->setComponent('session', $mockSession);
			
			$user = $this->users('sampleUser2');
			$identity = new UserIdentity($user->email, 'admin');
			$this->assertTrue($identity->authenticate());
			$this->assertTrue(Yii::app()->user->login($identity));
			
            $model = new Project();
            $this->assertFalse($model->save());
			Yii::app()->session->destroy();
        }

        public function testReadProject()
        {
            $project = $this->projects('sampleProject');
            $this->assertEquals($project->id, '1');
            $this->assertEquals($project->org_id, '1');
            $this->assertEquals($project->name, 'Sample Project Name');
            $this->assertEquals($project->desc, 'Sample Project Description');
            $this->assertEquals($project->colour, '#FF0000');
        }

        public function testUpdateProject()
        {
			$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
			Yii::app()->setComponent('session', $mockSession);
			// This portion of this code logs a manager to satisfy the
			// authentication of 
			$user = $this->users('sampleUser2');
			$identity = new UserIdentity($user->email, 'admin');
			$this->assertTrue($identity->authenticate());
			$this->assertTrue(Yii::app()->user->login($identity));
			
            $project = $this->projects('sampleProject');
            $project->setAttributes(array(
                'org_id'=>'1',
                'name'=>'Sample Project Name Edit',
                'desc'=>'Sample Project Description Edit',
                'colour'=>'#FF00FF',
            ));
            $this->assertTrue($project->save());
            $this->assertEquals($project->id, '1');
            $this->assertEquals($project->org_id, '1');
            $this->assertEquals($project->name, 'Sample Project Name Edit');
            $this->assertEquals($project->desc, 'Sample Project Description Edit');
            $this->assertEquals($project->colour, '#FF00FF');
			
			Yii::app()->session->destroy();
        }

        public function testDeleteProject()
        {
            $project = $this->projects('sampleProject');
            $this->assertTrue($project->delete());
            $project2 = $this->projects('sampleProject2');
            $this->assertTrue($project2->delete());
            $this->assertEquals(empty(Project::model()->findAll()), true);
        }
            
}
