<?php 

class SiteConfigExtension extends DataExtension {
    
    private static $db = array(
        'FacebookLink' => 'Varchar',
        'TwitterLink' => 'Varchar',
        'GoogleLink' => 'Varchar',
        'YouTubeLink' => 'Varchar',
        'GitHubLink' => 'Varchar',
        'MainEmail' => 'Varchar'
    );
    
    public function updateCMSFields(FieldList $fields) {
        
        $fields->addFieldToTab('Root.Main', EmailField::create('MainEmail'));
        
        $fields->addFieldsToTab('Root.Social', array(
            TextField::create('FacebookLink', 'Facebook'),
            TextField::create('TwitterLink', 'Twitter'),
            TextField::create('GoogleLink', 'Google'),
            TextField::create('YouTubeLink', 'YouTube'),
            TextField::create('GitHubLink', 'GitHub'),
        ));
    }
    
}

?>