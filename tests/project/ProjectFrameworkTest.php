<?php 

class ProjectFrameworkTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    // tests the link
    public function testLink() {
        $obj = $this->objFromFixture('ProjectFramework', 'wordpress');
        $link = $obj->Link();
        $this->assertStringEndsWith('frameworks/wordpress', $link);
    }
    
    // tests css class
    public function testCssClass() {
        $obj = $this->objFromFixture('ProjectFramework', 'wordpress');
        $seg = $obj->CssClass();
        $this->assertEquals('frame-wordpress', $seg);
    }
    
    // tests path to list of frameworks
    public function testGetAbsURL() {
        $obj = $this->objFromFixture('ProjectFramework', 'wordpress');
        $absURL = $obj->getAbsURL();
        $this->assertStringEndsWith('frameworks/', $absURL);
    }
    
}

?>