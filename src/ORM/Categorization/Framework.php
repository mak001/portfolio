<?php

namespace Mak001\Portfolio\ORM\Categorization;

use Mak001\Portfolio\Page\ProjectHolder;
use SilverStripe\ORM\DataObject;

/**
 * Class Framework
 * @package Mak001\Portfolio\ORM
 */
class Framework extends DataObject implements CategorisationObject
{
    use CategorisationTrait;

    /**
     * @var string
     */
    private static $table_name = 'ProjectFramework';

    /**
     * @var string
     */
    private static $singular_name = 'Framework';

    /**
     * @var string
     */
    private static $plural_name = 'Frameworks';

    /**
     * {@inheritdoc}
     */
    protected function getListUrlSegment()
    {
        return ProjectHolder::FRAMEWORK_ROUTE;
    }
}
