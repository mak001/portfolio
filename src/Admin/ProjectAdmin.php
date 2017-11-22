<?php


namespace Mak001\Portfolio\Admin;


use Mak001\Portfolio\ORM\Categorization\Framework;
use Mak001\Portfolio\ORM\Categorization\Language;
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
