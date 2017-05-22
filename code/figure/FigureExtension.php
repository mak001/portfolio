<?php 

class FigureExtension extends DataExtension {
    
    private static $many_many = array(
        'Photos' => 'Photo',
    );
    
    public function contentcontrollerInit() {
        if (Object::has_extension($this->owner->ClassName, 'FigureExtension')) {
            if ($this->owner->Photos()->exists()) {
                
                global $photos;
                $photos = $this->owner->Photos();
                
                ShortcodeParser::get('default')->register('img', function($args, $text, $parser, $tag) {
                    
                    global $photos;
                    $img;
                    $classes = "figure";
                    
                    
                    if (count($photos) == 0) {
                        return '';
                        
                    } else if ($args['img'] < 1 || count($photos) < $args['img']) {
                        $img = $photos[0];
                        
                    } else {
                        // normal people count from 1
                        $img = $photos[$args['img'] - 1];
                    }
                    
                    if ($args['order'] == 'first') {
                        $classes .= ' first';
                    }
                    
                    $values = new ArrayData(array(
                        'Classes' => $classes,
                        'Image' => $img,
                        'Id' => $imgId
                    ));
                    
                    return $values->renderWith('Figure');
                });
                
            }
        }
    }
    
    public function updateCMSFields(FieldList $fields) {
        $photoFields = singleton('Photo')->getCMSFields();
        
        $config = GridFieldConfig_RelationEditor::create();
        $config->getComponentByType('GridFieldDetailForm')->setFields($photoFields);
        
        $fields->addFieldToTab('Root.Photos', GridField::create('Photos', 'Photos', $this->owner->Photos(), $config));
    }
   
}

?>