<?php


namespace mak001\portfolio\model\project;

use mak001\portfolio\model\project\categorisation\Framework;
use mak001\portfolio\model\project\categorisation\Language;
use Page;

class Project extends Page
{

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

}