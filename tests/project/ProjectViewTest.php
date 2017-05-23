<?php 

class ProjectViewTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    public function testTitle() {
        $obj = $this->objFromFixture('ProjectView', 'title');
        $title = $obj->Title();
        $this->assertEquals('View Title', $title);
        
        $obj = $this->objFromFixture('ProjectView', 'no-title');
        $title = $obj->Title();
        $this->assertEquals('View', $title);
    }
    
    public function testShowLink() {
        $obj = $this->objFromFixture('ProjectView', 'title');
        $link = $obj->ShowLink(1);
        $this->assertStringEndsWith('show/1', $link);
        
        $link = $obj->ShowLink(3);
        $this->assertStringEndsWith('show/3', $link);
    }
    
}

?>