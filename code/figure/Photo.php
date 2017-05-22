<?php 

class Photo extends DataObject {
    
    private static $db = array(
        'Title' => 'Varchar',
        'Caption' => 'Text'
    );
    
    private static $has_one = array(
        'Image' => 'Image'
    );
    
    private static $belongs_many_many = array(
        'Page' => 'Page'
    );
    
    private static $summary_fields = array (
        'GridThumbnail' => '',
        'Title' => 'Title'
    );
    
    public function getCMSFields() {
        $fields = FieldList::create(array(
            TextField::create('Title'),
            $upload = UploadField::create('Image'),
            TextareaField::create('Caption')
        )); 
        
        $upload->getValidator()->setAllowedExtensions(array(
            'png',
            'gif',
            'jpg',
            'jpeg'
        ));
        
        $upload->setFolderName('figure-photos');
        
        return $fields;
    }
    
    public function getGridThumbnail() {
        if($this->Image()->exists()) {
            return $this->Image()->SetWidth(100);
        }
        return "(no image)";
    }
    
}

?>