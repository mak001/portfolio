<?php 

class ProjectPage_ControllerTest extends FunctionalTest {

    protected static $fixture_file = 'portfolio/tests/data.yml';
    // So pages don't need to be published to be accessed
    protected static $use_draft_site = true;
    
    public function testShow() {
        Config::inst()->update('SSViewer', 'theme', "portfolio");
        
        $object = $this->objFromFixture('ProjectPage', 'portfolio');
        
        $page = $this->get($object->ShowLink('xxx'));
        $this->assertEquals(200, $page->getStatusCode());
        
        $page = $this->get($object->ShowLink(1));
        $this->assertEquals(200, $page->getStatusCode());
        
        
        $object = $this->objFromFixture('ProjectPage', 'core');
        $page = $this->get($object->ShowLink(null));
        $this->assertEquals(404, $page->getStatusCode());
    }
    
}

?>