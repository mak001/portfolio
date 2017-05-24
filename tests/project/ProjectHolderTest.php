<?php 

class ProjectHolderTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';
    
    public function testGetCMSFields() {
        $object = $this->objFromFixture('ProjectHolder', 'holder');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
    }
    
}

?>