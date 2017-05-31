<?php 

class ShortcodesTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    public function testParseLanguageLink() {
        $object = $this->objFromFixture('Page', 'langlink');
        $html = ShortcodeParser::get('default')->parse($object->Content);
        
        $this->assertContains('<a href="/projects/languages">lang</a>', $html);
    }
    
    public function testParseFrameworkLink() {
        $object = $this->objFromFixture('Page', 'framelink');
        $html = ShortcodeParser::get('default')->parse($object->Content);
        
        $this->assertContains('<a href="/projects/frameworks">frame</a>', $html);
    }
    
}

?>