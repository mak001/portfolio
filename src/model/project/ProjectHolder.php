<?php

namespace mak001\portfolio\model\project;

use Page;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\ManyManyList;
use SilverStripe\Lumberjack\Model\Lumberjack;

/**
 * Class ProjectHolder
 * @package mak001\portfolio\model\project
 */
class ProjectHolder extends Page
{

    /**
     * {@inheritDoc}
     * @var string
     */
    private static $table_name = 'ProjectHolder';

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
     * @return DataList
     */
    public function getProjects()
    {
        return Project::get()->filter('ParentID', $this->ID);
    }

    /**
     * @return ManyManyList|false
     */
    public function getFrameworks()
    {
        if (0 < $this->getProjects()->count()) {
            return $this->getProjects()->relation("Frameworks");
        }
        return false;
    }

    /**
     * @return ManyManyList|false
     */
    public function getLanguages()
    {
        if (0 < $this->getProjects()->count()) {
            return $this->getProjects()->relation("Languages");
        }
        return false;
    }

}