<?php


namespace mak001\portfolio\tests\model\project;


use mak001\portfolio\model\project\Project;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProjectTest extends SapphireTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'portfolio/tests/fixture.yml';

    /**
     * Tests getCMSFields()
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(Project::class, 'portfolio');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

}