<?php 

class ImageExtension extends DataExtension {
    
    private static $db = array(
        'ALT' => 'Varchar'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Main", TextField::create('ALT', 'Alternative Text'));
    }
    
}

?>