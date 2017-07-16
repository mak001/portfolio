<?php


namespace mak001\portfolio\tests\model\project\categorisation;


use mak001\portfolio\model\project\categorisation\Framework;
use SilverStripe\Dev\SapphireTest;

class FrameworkTest extends SapphireTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'portfolio/tests/fixture.yml';

    /**
     * Tests getListUrlSegment()
     */
    public function testGetListUrlSegment() {
        $object = $this->objFromFixture(Framework::class, 'wordpress');

        $this->assertEquals('frameworks/', $object->getUrlPrefix());
    }

}