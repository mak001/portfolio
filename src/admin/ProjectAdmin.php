<?php


namespace mak001\portfolio\admin;


use mak001\portfolio\model\project\categorisation\Framework;
use mak001\portfolio\model\project\categorisation\Language;
use mak001\portfolio\model\project\Project;
use SilverStripe\Admin\ModelAdmin;

class ProjectAdmin extends ModelAdmin
{

    /**
     * @var array
     */
    private static $managed_models = array(
        Framework::class,
        Language::class
    );

    /**
     * @var string
     */
    private static $url_segment = 'projects';

    /**
     * @var string
     */
    private static $menu_title = 'Projects';

}