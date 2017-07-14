<?php

namespace mak001\portfolio\model\project;

use Page;
use SilverStripe\ORM\ManyManyList;

class ProjectHolder extends Page
{

    private static $belongs_many_many = array(
        'Projects' => Project::class
    );

    /**
     * @var array
     */
    private static $allowed_children =  array(
        Project::class
    );

    /**
     * @return ManyManyList|false
     */
    public function getFrameworks()
    {
        if (0 < $this->Projects()->count()) {
            return $this->Projects()->relation("Frameworks");
        }
        return false;
    }

    /**
     * @return ManyManyList|false
     */
    public function getLanguages()
    {
        if (0 < $this->Projects()->count()) {
            return $this->Projects()->relation("Languages");
        }
        return false;
    }

}