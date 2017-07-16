<?php


namespace mak001\portfolio\tests\model\project;

use mak001\portfolio\model\project\ProjectHolder;
use SilverStripe\Dev\FunctionalTest;

class ProjectHolderControllerTest extends FunctionalTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'portfolio/tests/fixture.yml';

    /**
     * @var bool
     */
    protected static $use_draft_site = true;

    /**
     * Tests PaginatedProjects()
     */
    public function testPaginatedProjects()
    {
        $holder = $this->objFromFixture(ProjectHolder::class, 'holder');
        $page = $this->get($holder->Link());

        $this->assertEquals(200, $page->getStatusCode());

        $projects = $this->cssParser()->getBySelector('.card.project .card-block');
        $this->assertEquals(2, count($projects));
    }

    /**
     * Tests PaginatedLanguages()
     */
    /*
    public function testPaginatedLanguages()
    {
        $holder = $this->objFromFixture(ProjectHolder::class, 'holder');
        $page = $this->get($holder->Link());

        $this->assertEquals(200, $page->getStatusCode());

        $projects = $this->cssParser()->getBySelector('.card.project .card-block');
        $this->assertEquals(2, count($projects));
    }
    */
}