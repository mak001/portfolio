<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/9/2017
 * Time: 8:31 AM
 */

namespace mak001\poerfolio\objects\link;


use SilverStripe\ORM\DataExtension;

class LinkDataExtension extends DataExtension
{
    private static $db = array(
        'Link' => 'Text',
        'Title' => 'Varchar'
    );

    private static $has_one = array(
        'ProjectPage' => 'ProjectPage'
    );

    public function Title()
    {
        if ($this->owner->Title && $this->owner->Title != '') {
            return $this->owner->Title;
        }
        return $this->owner->DefaultTitle ? $this->owner->DefaultTitle : "Link";
    }
}