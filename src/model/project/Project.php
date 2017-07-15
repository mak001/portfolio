<?php

namespace mak001\portfolio\model\project;

use mak001\portfolio\model\project\categorisation\Framework;
use mak001\portfolio\model\project\categorisation\Language;

use \Page;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use SilverStripe\View\Requirements;

/**
 * Class Project
 * @package mak001\portfolio\model\project
 */
class Project extends Page
{

    /**
     * @var string
     */
    private static $singular_name = 'Project';

    /**
     * @var string
     */
    private static $plural_name = 'Projects';

    /**
     * {@inheritDoc}
     * @var string
     */
    private static $table_name = 'Project';

    /**
     * @var array
     */
    private static $db = array(
        'Teaser' => 'Text',
        'MainImageHasLogo' => 'Boolean',
        'MainImageCropMiddle' => 'Boolean'
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'MainPhoto' => Image::class,
    );

    /**
     * @var array
     */
    private static $many_many = array(
        'Frameworks' => Framework::class,
        'Languages' => Language::class
    );

    /**
     * @var array
     */
    private static $allowed_children = array();

    /**
     * @var bool
     */
    private static $can_be_root = false;

    /**
     * This will display or hide the current class from the SiteTree. This variable can be
     * configured using YAML.
     *
     * @var bool
     */
    private static $show_in_sitetree = false;

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        Requirements::css(PORTFOLIO_DIR . '/css/cms.css');

        $fields = parent::getCMSFields();

        $config = GridFieldConfig_RelationEditor::create();

        if (class_exists(GridFieldAddExistingSearchButton::class)) {
            $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);

            $config->addComponent(new GridFieldAddExistingSearchButton());
        }
        $config->removeComponentsByType(GridFieldAddNewButton::class);

        $frameworks = GridField::create('Frameworks', 'Frameworks', $this->Frameworks(), $config);
        $languages = GridField::create('Languages', 'Languages', $this->Languages(), $config);

        $fields->addFieldsToTab("Root.Categorisation", array(
            $frameworks,
            $languages
        ));
        return $fields;
    }


}