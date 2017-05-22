<?php

class ProjectUses extends DataObject {

    private static $db = array(
        'Title' => 'Varchar',
        'BGColor' => 'Color',
        'URLSegment' => 'Varchar',
        'Description' => 'Text'
    );

    //Add an SQL index for the URLSegment
    static $indexes = array(
        "URLSegment" => array(
            'type' => 'unique',
            'value' => 'URLSegment'
        )
    );

    private static $has_one = array(
        'ProjectHolder' => 'ProjectHolder'
    );

    private static $belongs_many_many = array(
        'Projects' => 'ProjectPage'
    );

    public function getCMSFields()
    {
        $urlsegment = new SiteTreeURLSegmentField("URLSegment", $this->fieldLabel('URLSegment'));
        
        $prefix = $this->getAbsURL();
        $urlsegment->setURLPrefix($prefix);
        
        $helpText = _t('SiteTreeURLSegmentField.HelpChars', ' Special characters are automatically converted or removed.');
        $urlsegment->setHelpText($helpText);
        
        return FieldList::create(array(
            TextField::create('Title'),
            $urlsegment,
            new ColorField('BGColor', 'Background Color'),
            TextareaField::create('Description')
        ));
    }

    public function Link(){}
    
    public function CssClass(){}

    public function onAfterWrite(){
        parent::onAfterWrite();

        $content = '';
        foreach (ProjectUses::get() as $uses) {
            $field = DBField::create_field('Color', $uses->BGColor);

            $color = $uses->BGColor;
            $textColor = $this->getTextColorStyle($color);

            $hover = $field->Blend(0.8, '#000000');
            $border = $field->Blend(0.7, '#000000');
            $hoverColor = $this->getTextColorStyle($hover);

            $content .= "." . $uses->CssClass() . '{ background-color:#' . $color . '; border-color:#' . $color . '; ' . $textColor . '}';
            $content .= "." . $uses->CssClass() . ':hover{ background-color:#' . $hover . '; border-color:#' . $border . '; ' . $hoverColor. '}';
        }

        if (!file_exists(ASSETS_PATH . '/css/')) {
            mkdir(ASSETS_PATH . '/css/');
        }
        
        $fh = fopen(ASSETS_PATH . '/css/uses.css', 'w');
        fwrite($fh, $content);
        fclose($fh);
    }

    // originally from ColorField
    public function getTextColorStyle($color) {
        // change alpha component depending on disabled state
        if($color) {
            list($R, $G, $B) = Color::HEX_TO_RGB($color);
            $luminance = Color::RGB_TO_LUMINANCE($R, $G, $B);
            // return color as hex and as rgba values (hex is fallback for IE-8)
            return ($luminance > 0.5) ?
            'color: #000; color: rgba(0, 0, 0, 1);' :
            'color: #fff; color: rgba(255, 255, 255, 1);';
        } else {
            return 'color: #000; color: rgba(0, 0, 0, 1);';
        }
    }

}

?>