<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/9/2017
 * Time: 8:34 AM
 */

namespace mak001\portfolio\objects\link;


use mak001\portfolio\pages\Project;
use SilverStripe\ORM\DataObject;

class View extends DataObject
{

    public static $DefaultTitle = "View";

    public function ShowLink($id)
    {
        return $this->Project()->Link(Project::SHOW_ROUTE) . '/' . $id;
    }
}