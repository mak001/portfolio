<?php 

class ProjectUsesTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    // test with both a framework and a langauge
    public function testGetCMSFields() {
        $object = $this->objFromFixture('ProjectLanguage', 'java');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
        
        
        $object = $this->objFromFixture('ProjectFramework', 'wordpress');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
    }
    
    // Tests both white and black
    public function testGetTextColorStyle() {
        $obj = $this->objFromFixture('ProjectLanguage', 'java');
        $color = $obj->getTextColorStyle($obj->BGColor);
        $this->assertEquals('color: #000; color: rgba(0, 0, 0, 1);', $color);
        
        $obj = $this->objFromFixture('ProjectLanguage', 'php');
        $color = $obj->getTextColorStyle($obj->BGColor);
        $this->assertEquals('color: #fff; color: rgba(255, 255, 255, 1);', $color);
        
        $obj = $this->objFromFixture('ProjectLanguage', 'no-color');
        $color = $obj->getTextColorStyle($obj->BGColor);
        $this->assertEquals('color: #000; color: rgba(0, 0, 0, 1);', $color);
    }
    
}

?> 