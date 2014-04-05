<?php

class OrganizationTest extends CDbTestCase
{
	public $fixtures=array(
            'organizations'=>'Organzations',
        );
	
        public function testCreateOrg()
        {
            $model = new Organzation();
            $model->setAttributes(array(
                'name'=>'Created organization',
                'desc'=>'Created organization description',
            ));
        
            $this->assertTrue($model->save());
        }

        public function testCreateNullOrg()
        {
            $model = new Organzation();
            $this->assertFalse($model->save());
        }

        public function testReadOrg()
        {
            $org = $this->organizations('sampleOrg');
            $this->assertEquals($org->id, '1');
            $this->assertEquals($org->name, 'sampleOrgName');
            $this->assertEquals($org->desc, 'sampleOrgDesc');
        }

        public function testUpdateOrg()
        {
            $org = $this->organizations('sampleOrg');
            $org->setAttributes(array(
                'name'=>'sampleOrgNameUpdated',
                'desc'=>'sampleOrgDescUpdated',
            ));
            $this->assertTrue($org->save());
            $this->assertEquals($org->id, '1');
            $this->assertEquals($org->name, 'sampleOrgNameUpdated');
            $this->assertEquals($org->desc, 'sampleOrgDescUpdated');
        }

        public function testDeleteOrg()
        {
            $org = $this->organizations('sampleOrg');
            $this->assertTrue($org->delete);
            $this->assertEquals(empty(Organization::models()->findAll()), true);
        }
            
}
