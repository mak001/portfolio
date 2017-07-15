<?php

namespace mak001\portfolio\tests\model\project;

use mak001\portfolio\model\project\ProjectHolder;
use SilverStripe\Dev\SapphireTest;

class ProjectHolderTest extends SapphireTest
{

    protected static $fixture_file = 'portfolio/tests/fixture.yml';

    public function testGetFrameworks() {
        $object = $this->objFromFixture(ProjectHolder::class, 'holder');
        $frames = $object->getFrameworks();

        $this->assertEquals(1, $frames->count());
        $this->assertEquals('WordPress', $frames->first()->Title);


        $object = $this->objFromFixture(ProjectHolder::class, 'empty');
        $frames = $object->getFrameworks();

        echo $frames;
        $this->assertFalse($frames);
    }

    public function testGetLanguages() {
        $object = $this->objFromFixture(ProjectHolder::class, 'holder');
        $langs = $object->getLanguages();

        $this->assertEquals(2, $langs->count());
        $this->assertEquals('Java', $langs->first()->Title);


        $object = $this->objFromFixture(ProjectHolder::class, 'empty');
        $langs = $object->getLanguages();

        echo $langs;
        $this->assertFalse($langs);
    }

}