<?php

class ProjectTest extends CDbTestCase
{
	public $fixtures=array(
            'projects'=>'Projects',
        );
	
        public function testCreateProject()
        {
            $model = new Project();
            $model->setAttributes(array(
                'org_id'=>'1',
                'name'=>'Sample Project Name',
                'desc'=>'Sample Project Description',
                'colour'=>'#FF0000',
            ));
            $this->assertTrue($model->save());
        }

        public function testCreateNullProject()
        {
            $model = new Project();
            $this->assertFalse($model->save());
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
            $project = $this->projects('sampleProject');
            $model->setAttributes(array(
                'org_id'=>'2',
                'name'=>'Sample Project Name Edit',
                'desc'=>'Sample Project Description Edit',
                'colour'=>'#FF00FF',
            ));
            $this->assertTrue($project->save());
            $this->assertEquals($project->id, '1');
            $this->assertEquals($project->org_id, '2');
            $this->assertEquals($project->name, 'Sample Project Name Edit');
            $this->assertEquals($project->desc, 'Sample Project Description Edit');
            $this->assertEquals($project->colour, '#FF00FF');
        }

        public function testDeleteProject()
        {
            $project = $this->projects('sampleProject');
            $this->assertTrue($project->delete());
            $this->assertEquals(empty(Project::models()->findAll()), true);
        }
            
}
