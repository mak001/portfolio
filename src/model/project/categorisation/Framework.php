<?php


namespace mak001\portfolio\model\project\categorisation;

use mak001\portfolio\model\project\Project;
use mak001\portfolio\model\project\ProjectHolder;
use SilverStripe\ORM\DataObject;

class Framework extends DataObject implements CategorisationObject
{

    use ProjectHolderObject;

    /**
     * @var array
     */
    private static $has_one = array(
        'Holder' => ProjectHolder::class
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
        return 'frameworks';
    }

}