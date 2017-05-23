<?php 

class ProjectSourceTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    public function testTitle() {
        $obj = $this->objFromFixture('ProjectSource', 'title');
        $title = $obj->Title();
        $this->assertEquals('Source Title', $title);
        
        $obj = $this->objFromFixture('ProjectSource', 'no-title');
        $title = $obj->Title();
        $this->assertEquals('Source', $title);
    }
    
}

?>