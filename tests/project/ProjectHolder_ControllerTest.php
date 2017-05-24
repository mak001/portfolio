<?php 

class ProjectHolder_ControllerTest extends FunctionalTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    // So pages don't need to be published to be accessed
    protected static $use_draft_site = true;
    
    public function testLanguages() {
        $object = $this->objFromFixture('ProjectHolder', 'holder');
        $link = $object->LanguageLink();
       
        $page = $this->get($link);
        
        $this->assertEquals(200, $page->getStatusCode());
        $this->assertExactMatchBySelector('span.breadcrumb-item.active', array(
            "Languages"
        ));
        
        $items = $this->cssParser()->getBySelector('.card-deck .card.uses .card-title');
        $this->assertEquals(2, count($items));
        
        
        $object = $this->objFromFixture('ProjectLanguage', 'java');
        $link = $object->Link();
        $page = $this->get($link);
        
        $this->assertEquals(200, $page->getStatusCode());
        $this->assertExactMatchBySelector('span.breadcrumb-item.active', array(
            "Java"
        ));
        
        $items = $this->cssParser()->getBySelector('.card-deck .card.project .card-title');
        $this->assertEquals(1, count($items));
    }
    
    public function testFrameworks() {
        $object = $this->objFromFixture('ProjectHolder', 'holder');
        $link = $object->FrameworkLink();
         
        $page = $this->get($link);
    
        $this->assertEquals(200, $page->getStatusCode());
        $this->assertExactMatchBySelector('span.breadcrumb-item.active', array(
            "Frameworks"
        ));
    
        $items = $this->cssParser()->getBySelector('.card-deck .card.uses .card-title');
        $this->assertEquals(1, count($items));
    
    
        $object = $this->objFromFixture('ProjectFramework', 'wordpress');
        $link = $object->Link();
        $page = $this->get($link);
    
        $this->assertEquals(200, $page->getStatusCode());
        $this->assertExactMatchBySelector('span.breadcrumb-item.active', array(
            "WordPress"
        ));
        
        $items = $this->cssParser()->getBySelector('.card-deck .card.project .card-title');
        $this->assertEquals(2, count($items));
    }
    
}

?>