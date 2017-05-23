<?php 

class ProjectPageTest extends SapphireTest {

    protected static $fixture_file = 'portfolio/tests/data.yml';

    public function testGetCMSFields() {
        $object = $this->objFromFixture('ProjectPage', 'portfolio');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
    }
    
    public function testShowLink() {
        $object = $this->objFromFixture('ProjectPage', 'portfolio');
        
        $link = $object->ShowLink('');
        $this->assertStringEndsWith('show', $link);
        
        $link = $object->ShowLink(3);
        $this->assertStringEndsWith('show/3', $link);
    }
}

?>