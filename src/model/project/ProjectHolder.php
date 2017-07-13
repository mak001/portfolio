<?php

namespace mak001\portfolio\model\project;

use Page;
use SilverStripe\ORM\ManyManyList;

class ProjectHolder extends Page
{

    /**
     * @var array
     */
    private static $allowed_children = array(
        Project::class
    );

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