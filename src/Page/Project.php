<?php

namespace Mak001\Portfolio\Page;

use Mak001\Portfolio\ORM\Categorization\Framework;
use Mak001\Portfolio\ORM\Categorization\Language;
use \Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\TextareaField;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;

/**
 * Class Project
 * @package Mak001\Projects\Page
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
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            // Teaser
            $fields->addFieldsToTab("Root.Main", array(
                TextareaField::create('Teaser', 'Teaser')
            ), 'Content');
            // Images
            $fields->addFieldsToTab('Root.Photos', array(
                $mainImage = UploadField::create('MainPhoto'),
                CheckboxField::create('MainImageHasLogo'),
                CheckboxField::create('MainImageCropMiddle', 'Crop main image from the middle')
            ));
            $mainImage->getValidator()->setAllowedExtensions(array(
                'png',
                'gif',
                'jpg',
                'jpeg'
            ));
            $mainImage->setFolderName('project-photos/main');

            $frameworks = GridField::create('Frameworks', 'Frameworks', $this->Frameworks(), $this->getGridFieldConfig());
            $languages = GridField::create('Languages', 'Languages', $this->Languages(), $this->getGridFieldConfig());
            $fields->addFieldsToTab("Root.Categorisation", array(
                $frameworks,
                $languages
            ));
        });
        return parent::getCMSFields();
    }

    /**
     * This is needed so the 'Add XXX' button is different each time the config is used
     *
     * @return GridFieldConfig
     */
    private function getGridFieldConfig() {
        $config = GridFieldConfig_RelationEditor::create();
        if (class_exists(GridFieldAddExistingSearchButton::class)) {
            $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
            $config->addComponent(new GridFieldAddExistingSearchButton());
        }
        return $config;
    }
}
