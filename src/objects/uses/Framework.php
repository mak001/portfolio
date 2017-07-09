<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/9/2017
 * Time: 8:29 AM
 */

namespace mak001\portfolio\objects\uses;


class Framework extends Uses
{

    public function Link()
    {
        return $this->ProjectHolder()->FrameworkLink($this->URLSegment);
    }

    public function CssClass()
    {
        return 'frame-' . $this->URLSegment;
    }

    public function getAbsURL()
    {
        return $this->ProjectHolder()->FrameworkLink() . '/';
    }
}