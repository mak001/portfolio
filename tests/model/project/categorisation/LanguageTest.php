<?php


namespace mak001\portfolio\tests\model\project\categorisation;


use mak001\portfolio\model\project\categorisation\Language;
use mak001\portfolio\model\project\ProjectHolder;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class LanguageTest extends SapphireTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'portfolio/tests/fixture.yml';

    /**
     * Tests getUrlPrefix()
     */
    public function testGetUrlPrefix()
    {
        $object = $this->objFromFixture(Language::class, 'java');

        $this->assertEquals('languages/', $object->getUrlPrefix());
    }


    /**
     * Tests getCMSFields()
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(Language::class, 'java');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     * tests getLink()
     */
    public function testGetLink()
    {
        $lang1 = $this->objFromFixture(Language::class, 'java');
        $lang2 = $this->objFromFixture(Language::class, 'php');
        $holder = $this->objFromFixture(ProjectHolder::class, 'holder');

        $link1 = $lang1->getLink($holder);
        $link2 = $lang2->getLink($holder);

        $this->assertEquals('/projects/languages/java', $link1);
        $this->assertEquals('/projects/languages/php', $link2);
    }
}