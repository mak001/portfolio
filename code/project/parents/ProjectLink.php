<?php 

class ProjectLink extends DataObject {
    
    private static $db = array(
        'Link' => 'Text',
        'Title' => 'Varchar'
    );
    
    private static $has_one = array(
        'ProjectPage' => 'ProjectPage'
    );
    
}

?>