<?php

namespace Mak001\Portfolio\ORM\Categorization;

use Mak001\Portfolio\Page\ProjectHolder;
use SilverStripe\ORM\DataObject;

/**
 * Class Language
 * @package Mak001\Portfolio\ORM
 */
class Language extends DataObject implements CategorisationObject
{
    use CategorisationTrait;

    /**
     * @var string
     */
    private static $table_name = 'ProjectLanguage';

    /**
     * @var string
     */
    private static $singular_name = 'Language';

    /**
     * @var string
     */
    private static $plural_name = 'Languages';

    /**
     * {@inheritdoc}
     */
    protected function getListUrlSegment()
    {
        return ProjectHolder::LANGUAGE_ROUTE;
    }
}
