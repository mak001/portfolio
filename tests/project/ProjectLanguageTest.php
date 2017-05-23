<?php 

class ProjectLanguageTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    // tests the link
    public function testLink() {
        $obj = $this->objFromFixture('ProjectLanguage', 'java');
        $link = $obj->Link();
        $this->assertStringEndsWith('languages/java', $link);
    }
    
    // tests css class
    public function testCssClass() {
        $obj = $this->objFromFixture('ProjectLanguage', 'java');
        $seg = $obj->CssClass();
        $this->assertEquals('lang-java', $seg);
    }
    
}

?>