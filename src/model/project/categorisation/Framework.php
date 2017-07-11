<?php


namespace mak001\portfolio\model\project\categorisation;

use mak001\portfolio\model\project\Project;
use mak001\portfolio\model\project\ProjectHolder;
use SilverStripe\CMS\Forms\SiteTreeURLSegmentField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use TractorCow\Colorpicker\Color;
use TractorCow\Colorpicker\Forms\ColorField;

class Framework extends DataObject implements CategorisationObject
{

    use ProjectHolderObject;

    private static $db = array(
        'Title' => 'Varchar',
        'BGColor' => Color::class,
        'URLSegment' => 'Varchar',
        'Description' => 'Text'
    );

    //Add an SQL index for the URLSegment
    static $indexes = array(
        "URLSegment" => array(
            'type' => 'unique',
            'value' => 'URLSegment'
        )
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'Holder' => ProjectHolder::class
    );

    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Projects' => Project::class
    );

    /**
     * {@inheritdoc}
     */
    protected function getListUrlSegment()
    {
        return 'frameworks/';
    }

    public function getCMSFields()
    {
        $urlsegment = new SiteTreeURLSegmentField("URLSegment", $this->fieldLabel('URLSegment'));

        $prefix = $this->getUrlPrefix();
        $urlsegment->setURLPrefix($prefix);

        $helpText = _t('SiteTreeURLSegmentField.HelpChars', ' Special characters are automatically converted or removed.');
        $urlsegment->setHelpText($helpText);

        return FieldList::create(array(
            TextField::create('Title'),
            $urlsegment,
            new ColorField('BGColor', 'Background Color'),
            TextareaField::create('Description')
        ));
    }

}