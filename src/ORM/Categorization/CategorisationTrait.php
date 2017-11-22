<?php

namespace Mak001\Portfolio\ORM\Categorization;

use Mak001\Portfolio\Page\Project;
use Mak001\Portfolio\Page\ProjectHolder;
use SilverStripe\CMS\Forms\SiteTreeURLSegmentField;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use TractorCow\Colorpicker\Color;
use TractorCow\Colorpicker\Forms\ColorField;

/**
 * Trait CategorisationTrait
 */
trait CategorisationTrait
{
    /**
     * @var array
     */
    private static $db = array(
        'Title' => 'Varchar',
        'BGColor' => Color::class,
        'URLSegment' => 'Varchar',
        'Description' => 'Text'
    );

    /**
     * Add an SQL index for the URLSegment
     *
     * @var array
     */
    private static $indexes = array(
        "URLSegment" => array(
            'type' => 'unique',
            'columns' => ['URLSegment']
        )
    );

    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Projects' => Project::class
    );

    /**
     * {@inheritdoc}
     */
    public function getCMSFields()
    {
        $urlsegment = new SiteTreeURLSegmentField("URLSegment", $this->fieldLabel('URLSegment'), 'Title');
        $prefix = $this->getUrlPrefix();
        $urlsegment->setURLPrefix($prefix);
        $helpText = _t('SiteTreeURLSegmentField.HelpChars',
            ' Special characters are automatically converted or removed.');
        $urlsegment->setHelpText($helpText);
        $fields = FieldList::create(array(
            TextField::create('Title'),
            $urlsegment,
            new ColorField('BGColor', 'Background Color'),
            TextareaField::create('Description')
        ));
        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

    /**
     * Returns a relative link to this category.
     *
     * @param $holder
     *
     * @return string
     */
    public function getLink($holder = null)
    {
        if ($holder == null) {
            $holder = Director::get_current_page();
        }
        if ($holder instanceof Project) {
            $holder = $holder->Parent();
        }
        if ($holder instanceof ProjectHolder) {
            return Controller::join_links(
                $holder->Link(),
                $this->getListUrlSegment(),
                $this->URLSegment
            );
        }

        return '';
    }

    /**
     * @return string
     */
    public function getUrlPrefix()
    {
        return $this->getListUrlSegment();
    }

    /**
     * This returns the url segment for the listing page.
     * eg. 'categories' in /my-blog/categories/category-url
     *
     * This is not editable at the moment, but a method is being used incase we want
     * to make it editable in the future. We can use this method to provide logic
     * without replacing multiple areas of the code base. We're also not being opinionated
     * about how the segment should be obtained at the moment and allowing for the
     * implementation to decide.
     *
     * @return string
     */
    abstract protected function getListUrlSegment();
}
