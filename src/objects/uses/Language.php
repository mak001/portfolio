<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/9/2017
 * Time: 8:27 AM
 */

namespace mak001\portfolio\objects\uses;


class Language extends Uses
{

    public function Link()
    {
        return $this->ProjectHolder()->LanguageLink($this->URLSegment);
    }

    public function CssClass()
    {
        return 'lang-' . $this->URLSegment;
    }

    public function getAbsURL()
    {
        return $this->ProjectHolder()->LanguageLink() . '/';
    }
}