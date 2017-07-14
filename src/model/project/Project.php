<?php


namespace mak001\portfolio\model\project;

use mak001\portfolio\model\project\categorisation\Framework;
use mak001\portfolio\model\project\categorisation\Language;
use Page;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

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
     * @var array
     */
    private static $db = array(
        'Teaser' => 'Text',
        'MainImageHasLogo' => 'Boolean',
        'MainImageCropMiddle' => 'Boolean'
    );

    private static $has_one = array(
        'MainPhoto' => 'Image'
    );

    /**
     * @var array
     */
    private static $many_many = array(
        'Frameworks' => Framework::class,
        'Languages' => Language::class,
        "Holders" => ProjectHolder::class
    );

    /**
     * @var array
     */
    private static $many_many_extraFields = [
        'Holders' => [
            'Sort' => 'Int',
        ],
    ];

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

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $config = GridFieldConfig_RelationEditor::create();

        if (class_exists('GridFieldOrderableRows')) {
            $config->addComponent(new GridFieldOrderableRows());
        }

        if (class_exists('GridFieldAddExistingSearchButton')) {
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
        }
        $config->removeComponentsByType('GridFieldAddNewButton');

        $holderField = GridField::create('Holders', 'Holders', $this->Holders()->sort('Sort'), $config);

        $fields->addFieldsToTab("Root.Holders", array(
            $holderField
        ));

        return $fields;
    }

}