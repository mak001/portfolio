<?php

namespace Mak001\Portfolio\Page;

use \Page;
use \PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\PaginatedList;

/**
 * Class ProjectHolderController
 * @package Mak001\Portfolio\Page
 */
class ProjectHolderController extends PageController
{
    /**
     * @var DataList
     */
    protected $projectList;

    /**
     * @var DataList
     */
    protected $languageList;

    /**
     * @var DataList
     */
    protected $frameworkList;

    /**
     * @var int
     */
    protected $limit = 0;

    /**
     * @var array
     */
    private static $allowed_actions = array(
        ProjectHolder::FRAMEWORK_ROUTE,
        ProjectHolder::LANGUAGE_ROUTE,
    );

    public function init()
    {
        parent::init();
        $holder = $this->dataRecord;
        $this->projectList = $holder->getProjects();
        $this->limit = $this->getRequest()->getVar('limit');
    }

    public function languages(HTTPRequest $request)
    {
        if ($request->param('ID')) {

            $language = Project::get()
                ->filter(array(
                    'ParentID' => $this->ID
                ))
                ->relation("Languages")
                ->filter(array(
                    'URLSegment' => $request->param('ID')
                ))
                ->First();

            if (!$language) {
                return $this->httpError(404, 'That language was not found');
            }

            $this->projectList = $this->projectList->filter(array(
                'Languages.ID' => $language->ID
            ));

            $this->addToBreadCrumb($this->LanguageLink(), "Languages");
            $this->addToBreadCrumb($this->LanguageLink($language->Title), $language->Title);

            return array(
                'Title' => $this->Title . ' :: ' . $language->Title,
                'SelectedLanguage' => $language
            );
        } else {

            $this->languageList = Project::get()
                ->filter(array(
                    'ParentID' => $this->ID
                ))
                ->relation("Languages");

            $this->addToBreadCrumb($this->LanguageLink(), "Languages");

            return array(
                'Title' => $this->Title . ' :: Languages',
                'SelectedLanguage' => ''
            );
        }
    }

    public function frameworks(HTTPRequest $request)
    {
        if ($request->param('ID')) {

            $framework = Project::get()
                ->filter(array(
                    'ParentID' => $this->ID
                ))
                ->relation("Frameworks")
                ->filter(array(
                    'URLSegment' => $request->param('ID')
                ))
                ->First();

            if (!$framework) {
                return $this->httpError(404, 'That framework was not found');
            }

            $this->projectList = $this->projectList->filter(array(
                'Frameworks.ID' => $framework->ID
            ));

            $this->addToBreadCrumb($this->FrameworkLink(), "Frameworks");
            $this->addToBreadCrumb($this->FrameworkLink($framework->Title), $framework->Title);

            return array(
                'Title' => $this->Title . ' :: ' . $framework->Title,
                'SelectedFramework' => $framework
            );
        } else {

            $this->frameworkList = Project::get()
                ->filter(array(
                    'ParentID' => $this->ID
                ))
                ->relation("Frameworks");
            $this->addToBreadCrumb($this->FrameworkLink(), "Frameworks");

            return array(
                'Title' => $this->Title . ' :: Frameworks',
                'SelectedFramework' => ''
            );
        }
    }

    /**
     * @param $link
     * @param $title
     */
    public function addToBreadCrumb($link, $title)
    {
        $obj = new Page();
        $obj->URLSegment = $link;
        $obj->MenuTitle = $title;
        $obj->Title = $title;
        $this->extraCrumbs->add($obj);
    }


    /**
     * Gets a paginated list of projects
     *
     * @param int $num - The number to show per page
     *
     * @return PaginatedList - Paged list of projects
     */
    public function PaginatedProjects($num = 6)
    {
        $limit = $this->limit ?: $num;

        return PaginatedList::create($this->projectList, $this->getRequest())
            ->setPageLength($limit);
    }

    /**
     * Gets a paginated list of languages
     *
     * @param int $num - The number to show per page
     *
     * @return PaginatedList|bool - Paged list of languages, or false if there isn't a list
     */
    public function PaginatedLanguages($num = 12)
    {
        if ($this->languageList) {
            $limit = $this->limit ?: $num;

            return PaginatedList::create($this->languageList, $this->getRequest())->setPageLength($limit);
        }

        return false;
    }

    /**
     * Gets a paginated list of frameworks
     *
     * @param int $num - The number to show per page
     *
     * @return PaginatedList|bool - Paged list of frameworks, or false if there isn't a list
     */
    public function PaginatedFrameworks($num = 12)
    {
        if ($this->frameworkList) {
            $limit = $this->limit ?: $num;

            return PaginatedList::create($this->frameworkList, $this->getRequest())->setPageLength($limit);
        }

        return false;
    }
}
