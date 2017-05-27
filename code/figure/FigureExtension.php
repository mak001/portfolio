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
                
                global $lastID;
                $lastID = 0;
                
                ShortcodeParser::get('default')->register('img', function($args, $text, $parser, $tag) {
                    
                    global $photos, $lastID;
                    $img;
                    $classes = "figure";
                    
                    $defaults = array(
                        "img" => 1,
                        "order" => "last"
                    );
                    
                    $options = array_merge($defaults, $args);
                    
                    if (count($photos) == 0) {
                        return '';
                        
                    } else if ($options['img'] < 1 || count($photos) < $options['img']) {
                        $img = $photos[0];
                        
                    } else {
                        // normal people count from 1
                        $img = $photos[$options['img'] - 1];
                    }
                    
                    if ($options['order'] == 'first') {
                        $classes .= ' first';
                    }
                    
                    $values = new ArrayData(array(
                        'Classes' => $classes,
                        'Image' => $img,
                        'Id' => $lastID
                    ));
                    
                    $lastID++;
                    
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