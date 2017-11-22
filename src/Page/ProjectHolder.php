<?php

namespace Mak001\Portfolio\Page;

use \Page;
use SilverStripe\Control\Controller;
use SilverStripe\Lumberjack\Model\Lumberjack;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\ManyManyList;

/**
 * Class ProjectHolder
 * @package Mak001\Portfolio\Page
 */
class ProjectHolder extends Page
{

    const LANGUAGE_ROUTE = 'languages';
    const FRAMEWORK_ROUTE = 'frameworks';

    /**
     * @var ArrayList
     */
    protected $extraCrumbs;

    /**
     * {@inheritDoc}
     * @var string
     */
    private static $table_name = 'ProjectHolder';
    /**
     * @var array
     */
    private static $allowed_children = array(
        Project::class
    );
    /**
     * @var array
     */
    private static $extensions = array(
        Lumberjack::class
    );

    public function __construct($record = null, $isSingleton = false, $queryParams = array()) {
        parent::__construct($record, $isSingleton, $queryParams);
        $this->extraCrumbs = new ArrayList();
    }

    /**
     * @return DataList
     */
    public function getProjects()
    {
        return Project::get()->filter('ParentID', $this->ID);
    }

    /**
     * @return ManyManyList|false
     */
    public function getFrameworks()
    {
        if (0 < $this->getProjects()->count()) {
            return $this->getProjects()->relation("Frameworks");
        }

        return false;
    }

    /**
     * @return ManyManyList|false
     */
    public function getLanguages()
    {
        if (0 < $this->getProjects()->count()) {
            return $this->getProjects()->relation("Languages");
        }

        return false;
    }

    /**
     * Gets the link to the list of frameworks, or to an individual framework
     *
     * @param null $language
     *
     * @return string
     */
    public function LanguageLink($language = null)
    {
        if ($language === null) {
            return $this->Link($this::LANGUAGE_ROUTE);
        }

        return Controller::join_links($this->Link($this::LANGUAGE_ROUTE), $language);
    }

    /**
     * Gets the link to the list of frameworks, or to an individual framework
     *
     * @param null $framework
     *
     * @return string
     */
    public function FrameworkLink($framework = null)
    {
        if ($framework === null) {
            return $this->Link($this::FRAMEWORK_ROUTE);
        }

        return Controller::join_links($this->Link($this::FRAMEWORK_ROUTE), $framework);
    }

    /**
     * @return int
     */
    public function CurrentLevel() {
        return $this->getBreadcrumbItems()->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getBreadcrumbItems($maxDepth = 20, $stopAtPageType = false, $showHidden = false)
    {
        $pages = parent::getBreadcrumbItems($maxDepth, $stopAtPageType, $showHidden);

        $this->extraCrumbs->each(function ($crumb) use ($pages) {
            $pages->push($crumb);
        });
        return $pages;
    }
}
