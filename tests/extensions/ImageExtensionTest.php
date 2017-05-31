<?php

class ImageExtensionTest extends SapphireTest {

    protected static $fixture_file = 'portfolio/tests/data.yml';

    public function testGetCMSFields() {
        $object = $this->objFromFixture('Image', 'image');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
    }

}

?>