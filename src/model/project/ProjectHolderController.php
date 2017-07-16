<?php

namespace mak001\portfolio\model\project;

use PageController;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\View\Requirements;

class ProjectHolderController extends PageController
{
    /**
     * @var
     */
    protected $projectList;

    /**
     * @var
     */
    protected $languageList;

    /**
     * @var
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
        'languages',
        'frameworks'
    );

    public function init()
    {
        parent::init();

        // TODO
        // Requirements::css(ASSETS_DIR . '/css/uses.css');

        Requirements::javascript("/portfolio/js/jquery-3.2.1.slim.min.js");
        Requirements::javascript("/portfolio/js/jquery.matchHeight-min.js");

        Requirements::customScript(<<<JS
            (function($) {
                $('.card-block').matchHeight({
                    byRow: false
                });
            })(jQuery)
JS
        );

        $holder = $this->dataRecord;
        $this->projectList = $holder->getProjects();
        $this->languageList = $holder->getLanguages();
        $this->frameworkList = $holder->getFrameworks();

        $this->limit = $this->getRequest()->getVar('limit');
    }


    /**
     * Gets a paginated list of projects
     *
     * @param int $num - The number to show per page
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
     * @return PaginatedList - Paged list of languages
     */
    public function PaginatedLanguages($num = 12)
    {
        if ($this->languageList) {
            $limit = $this->limit ?: $num;
            return PaginatedList::create($this->languageList, $this->getRequest())->setPageLength($limit);
        }
    }

    /**
     * Gets a paginated list of frameworks
     *
     * @param int $num - The number to show per page
     * @return PaginatedList - Paged list of frameworks
     */
    public function PaginatedFrameworks($num = 12)
    {
        if ($this->frameworkList) {
            $limit = $this->limit ?: $num;
            return PaginatedList::create($this->frameworkList, $this->getRequest())->setPageLength($limit);
        }
    }
}