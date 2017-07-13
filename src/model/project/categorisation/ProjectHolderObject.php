<?php


namespace mak001\portfolio\model\project\categorisation;


use SilverStripe\Control\Controller;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextField;

trait ProjectHolderObject
{

    /**
     * {@inheritdoc}
     */
    public function getCMSFields()
    {
        $shortClass = ClassInfo::shortName(self::class);
        $fields = TabSet::create(
            'Root',
            Tab::create(
                'Main',
                TextField::create('Title', _t($shortClass . '.Title', 'Title'))
            )
        );
        $fields = FieldList::create($fields);
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    /**
     * Returns a relative link to this category.
     *
     * @param $holder
     * @return string
     */
    public function getLink($holder)
    {
        return Controller::join_links(
            $holder()->Link(),
            $this->getListUrlSegment(),
            $this->URLSegment
        );
    }

    /**
     * @return string
     */
    public function getUrlPrefix()
    {
        return $this->getListUrlSegment();
    }

    /**
     * This returns the url segment for the listing page.
     * eg. 'categories' in /my-blog/categories/category-url
     *
     * This is not editable at the moment, but a method is being used incase we want
     * to make it editable in the future. We can use this method to provide logic
     * without replacing multiple areas of the code base. We're also not being opinionated
     * about how the segment should be obtained at the moment and allowing for the
     * implementation to decide.
     *
     * @return string
     */
    abstract protected function getListUrlSegment();

}