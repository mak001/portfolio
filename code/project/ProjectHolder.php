<?php

class ProjectHolder extends Page
{

    const LANGUAGE_ROUTE = 'languages';

    const FRAMEWORK_ROUTE = 'frameworks';

    private static $allowed_children = array(
        'ProjectPage'
    );

    private static $has_many = array(
        'ProjectLanguages' => 'ProjectLanguage',
        'ProjectFrameworks' => 'ProjectFramework'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.ProjectLanguages', GridField::create('ProjectLanguages', 'Project ProjectLanguages', $this->ProjectLanguages(), GridFieldConfig_RecordEditor::create()));
        $fields->addFieldToTab('Root.ProjectFrameworks', GridField::create('ProjectFrameworks', 'Project ProjectFrameworks', $this->ProjectFrameworks(), GridFieldConfig_RecordEditor::create()));
        
        return $fields;
    }

    public function LanguageLink($lang = null)
    {
        if ($lang === null) {
            return $this->Link($this::LANGUAGE_ROUTE);
        }
        return $this->Link($this::LANGUAGE_ROUTE . '/' . $lang);
    }

    public function FrameworkLink($frame = null)
    {
        if ($frame === null) {
            return $this->Link($this::FRAMEWORK_ROUTE);
        }
        return $this->Link($this::FRAMEWORK_ROUTE . '/' . $frame);
    }
}

class ProjectHolder_Controller extends Page_Controller
{

    protected $projectList;

    protected $languageList;

    protected $frameworkList;

    private static $allowed_actions = array(
        'languages',
        'frameworks'
    );

    public function init()
    {
        parent::init();
        
        Requirements::css(ASSETS_DIR . '/css/uses.css');
        
        Requirements::customScript(<<<JS
            (function($) {
                $('.card-footer').matchHeight({
                    byRow: false
                });
            })(jQuery)
JS
);

        
        $this->projectList = ProjectPage::get()->filter(array(
            'ParentID' => $this->ID
        ));
    }

    public function languages(SS_HTTPRequest $request)
    {
        if ($request->param('ID')) {
            
            $language = ProjectLanguage::get()->filter(array(
                'ProjectHolderID' => $this->ID,
                'URLSegment' => $request->param('ID')
            ))
                ->First();
            
            if (! $language) {
                return $this->httpError(404, 'That language was not found');
            }
            
            $this->projectList = $this->projectList->filter(array(
                'Languages.ID' => $language->ID
            ));
            
            $this->addToBreadCrumb($this->LanguageLink(), "Languages");
            $this->addToBreadCrumb($language->Link(), $language->Title);
            
            return array(
                'Title' => $this->Title . ' :: ' . $language->Title,
                'SelectedLanguage' => $language
            );
        } else {
            $this->languageList = ProjectPage::get()
                ->filter(array(
                    'ParentID' => $this->ID
                ))
                ->relation("Languages");
            
            $this->addToBreadCrumb($this->LanguageLink(), "Languages");
            
            return array(
                'Title' => $this->Title . ' :: Languages',
                'SelectedLanguage' => ''
            );
        }
    }

    public function frameworks(SS_HTTPRequest $request)
    {
        if ($request->param('ID')) {
            
            $framework = ProjectFramework::get()->filter(array(
                'ProjectHolderID' => $this->ID,
                'URLSegment' => $request->param('ID')
            ))
                ->First();
            
            if (! $framework) {
                return $this->httpError(404, 'That framewok was not found');
            }
            
            $this->projectList = $this->projectList->filter(array(
                'Frameworks.ID' => $framework->ID
            ));
            
            $this->addToBreadCrumb($this->FrameworkLink(), "Frameworks");
            $this->addToBreadCrumb($framework->Link(), $framework->Title);
            
            return array(
                'Title' => $this->Title . ' :: ' . $framework->Title,
                'SelectedFramework' => $framework
            );
        } else {
            
            $this->frameworkList= ProjectPage::get()
            ->filter(array(
                'ParentID' => $this->ID
            ))
            ->relation("Frameworks");

            $this->addToBreadCrumb($this->FrameworkLink(), "Frameworks");
            
            return array(
                'Title' => $this->Title . ' :: Frameworks',
                'SelectedFramework' => ''
            );
        }
    }

    private function addToBreadCrumb($link, $title)
    {
        $obj = new DataObject();
        $obj->Link = $link;
        $obj->MenuTitle = $title;
        $obj->Title = $title;
        $this->AddBreadCrumbAfter($obj);
    }

    public function PaginatedProjects($num = 6)
    {
        return PaginatedList::create($this->projectList, $this->getRequest())->setPageLength($num);
    }

    public function PaginatedLanguages($num = 12)
    {
        if ($this->languageList) {
            return PaginatedList::create($this->languageList, $this->getRequest())->setPageLength($num);
        }
    }

    public function PaginatedFrameworks($num = 12)
    {
        if ($this->frameworkList) {
            return PaginatedList::create($this->frameworkList, $this->getRequest())->setPageLength($num);
        }
    }
}

?>