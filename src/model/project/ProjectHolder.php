<?php

namespace mak001\portfolio\model\project;

use mak001\portfolio\model\project\categorisation\Framework;
use mak001\portfolio\model\project\categorisation\Language;
use Page;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Lumberjack\Forms\GridFieldConfig_Lumberjack;
use SilverStripe\Lumberjack\Model\Lumberjack;
use SilverStripe\View\Requirements;

class ProjectHolder extends Page
{

    /**
     * @var array
     */
    private static $has_many = array(
        'Frameworks' => Framework::class,
        'Languages' => Language::class
    );

    /**
     * @var array
     */
    private static $allowed_children = array(
        Project::class
    );

    /**
     * @var array
     */
    private static $extensions = array(
        Lumberjack::class
    );

    /**
     * {@inheritdoc}
     */
    public function getCMSFields()
    {
        Requirements::css(PORTFOLIO_DIR . '/css/cms.css');
        $fields = parent::getCMSFields();

        $frameworks = GridField::create(
            'Frameworks',
            'Frameworks',
            $this->Frameworks(),
            GridFieldConfig_RecordEditor::create(
                15,
                $this->Frameworks()->sort('Title'),
                Framework::class,
                'Frameworks',
                'Projects'
            )
        );

        $languages = GridField::create(
            'Languages',
            'Languages',
            $this->Languages(),
            GridFieldConfig_RecordEditor::create(
                15,
                $this->Languages()->sort('Title'),
                Languages::class,
                'Languages',
                'Projects'
            )
        );

        $fields->addFieldsToTab(
            'Root.Categorisation',
            array(
                $frameworks,
                $languages
            )
        );

        return $fields;
    }

}