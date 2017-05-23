<?php 

class ProjectPage extends Page {
    
    const SHOW_ROUTE = "show";
    
    private static $can_be_root = false;
    private static $allowed_children = 'none';
    
    private static $has_one = array(
        'ProjectHolder' => 'ProjectHolder',
        'MainPhoto' => 'Image'
    );
    
    private static $db = array(
        'Teaser' => 'Text',
        'MainImageHasLogo' => 'Boolean',
        'MainImageCropMiddle' => 'Boolean'
    );
    
    private static $has_many = array(
        'Sources' => 'ProjectSource',
        'ViewLinks' => 'ProjectView'
    );
    
    private static $many_many = array(
        'Languages' => 'ProjectLanguage',
        'Frameworks' => 'ProjectFramework'
    );
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab('Root.Main', TextareaField::create('Teaser'), 'Content');
        
        $photoFields = array();
        $fields->addFieldsToTab('Root.Photos', array(
            $photoFields['main'] = UploadField::create('MainPhoto'),
            CheckBoxField::create('MainImageHasLogo'),
            CheckBoxField::create('MainImageCropMiddle', 'Crop main image from the middle')
        ));
        
        foreach($photoFields as $key => $field) {
            $field->getValidator()->setAllowedExtensions(array(
                'png',
                'gif',
                'jpg',
                'jpeg'
            ));
            if ($key == 'main') {
                $field->setFolderName('project-photos/main');
            } else {
                $field->setFolderName('project-photos');
            }
        }

        $fields->addFieldsToTab('Root.Used', array(
            $langs = ListboxField::create('Languages', 'Selected languages', $this->Parent()
                ->ProjectLanguages()
                ->map('ID', 'Title')
                ->toArray(),
                $value = ""),
            
            $frames = ListboxField::create('Frameworks', 'Selected frameworks', $this->Parent()
                ->ProjectFrameworks()
                ->map('ID', 'Title')
                ->toArray(),
                $value = "")
        ));
        
        $langs->setMultiple(true);
        $frames->setMultiple(true);
        
        $fields->addFieldsToTab('Root.Links', array(
            GridField::create('View Links', 'View Links', $this->ViewLinks(), GridFieldConfig_RecordEditor::create()),
            GridField::create('Sources', 'Sources', $this->Sources(), GridFieldConfig_RecordEditor::create())
        ));
        
        return $fields;
    }
    
    public function MainPhotoResizeLink($w, $h) {
        $image = $this->MainPhoto();
        
        if ($image == null && !$image->exists()) {
            return "http://placehold.it/{$w}x{$h}";
        }
        
        if (abs($image->getWidth() - $w) > abs($image->getHeight() - $h)) {
            $image->setWidth($w);
        } else {
            $image->setHeight($h);
        }
        
        $v = $this->MainImageCropMiddle ? 'center' : 'top';

        $return = $image->SetCroppedSize($w, $h, 'left', $v);
        if ($return != null) {
            return $return->Link();
        } else {
            return "http://placehold.it/{$w}x{$h}";
        }
    }
    
    public function ShowLink($id)
    {
        if ($id == null || $id == '') {
            return $this->Link($this::SHOW_ROUTE);
        }
        return $this->Link($this::SHOW_ROUTE) . '/' . $id;
    }
    
    public function ExtraClasses() {
        $classes = "";
        
        if ($this->MainImageCropMiddle) {
            $classes .= "img-center";
        }
        
        return $classes;
    }
    
}

class ProjectPage_Controller extends Page_Controller {
    
    private static $allowed_actions = array(
        'show'
    );
    
    private $imgId = 0;
    private $viewId = 1;
    
    public function init() {
        parent::init();
        
        Requirements::css(ASSETS_DIR . '/css/uses.css');
    }
    
    public function show(SS_HTTPRequest $request) {
        if ($request->param('ID')) {
            $viewId = $request->param('ID');
        } else {
            $viewId = 1;
        }
        
        $links = $this->ViewLinks()->toArray();
        
        if (count($links) == 0) {
            return $this->httpError(404, 'That view page was not found');
        }
        
        if ($viewId < 1 || count($links) < $viewId) {
            $viewId = 1;
        }
        
        // TODO - Flesh out more?
        $values = new ArrayData(array(
            'Title' => $this->Title,
            'Link' => $this->Link(),
            'ViewLink' => $links[$viewId - 1]->Link
        ));
        // TODO
        return $values->renderWith(array('ShowProject', 'Page'));
    }
    
}

?>