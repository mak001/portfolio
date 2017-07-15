<?php

namespace mak001\portfolio\model\project\categorisation;

use mak001\portfolio\model\project\Project;
use SilverStripe\ORM\DataObject;
use TractorCow\Colorpicker\Color;

class Language extends DataObject implements CategorisationObject
{
    use ProjectHolderObject;

    /**
     * {@inheritDoc}
     * @var string
     */
    private static $table_name = 'Language';

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
            'value' => 'URLSegment'
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
    protected function getListUrlSegment()
    {
        return 'languages/';
    }
}