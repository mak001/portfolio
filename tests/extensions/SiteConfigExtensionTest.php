<?php 

class SiteConfigExtensionTest extends SapphireTest {
    
    protected static $fixture_file = 'portfolio/tests/data.yml';

    public function testGetCMSFields() {
        $object = SiteConfig::current_site_config();
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
    }
    
}

?>