<?php

namespace Derralf\Elements\TextImages\Element;


use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use Sheadawson\Linkable\Forms\LinkField;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\Requirements;
use SilverStripe\View\SSViewer;

class ElementTextImages extends BaseElement
{

//    protected function init()
//    {
//        parent::init();
//        die('ElementTextImages >  init()');
//        Requirements::javascript('derralf/elemental-textimages: client/dist/js/lightgallery.init.js');
//    }

    public function getType()
    {
        return self::$singular_name;
    }

    private static $icon = 'font-icon-block-content';

    private static $table_name = 'ElementTextImages';

    private static $singular_name = 'Text-Bilder-Element';
    private static $plural_name = 'Text-Bilder-Elemente';
    private static $description = '';

    private static $db = [
        'HTML'              => 'HTMLText',
        'ShowImageCaptions' => 'Boolean',
        'ImageViewMode'     => 'Varchar'
    ];

    private static $has_one = [
        'ReadMoreLink' => Link::Class
    ];

    private static $has_many = [
    ];

    private static $many_many = [
        'Images' => Image::class
    ];

    // this adds the SortOrder field to the relation table.
    // Please note that the key (in this case 'Images') has to be the same key as in the $many_many definition!
    private static $many_many_extraFields = [
        'Images' => ['SortOrder' => 'Int']
    ];

    private static $belongs_many_many = [];

    private static $owns = [
        'Images'
    ];

    private static $defaults = [
    ];

    private static $colors = [];


    private static $field_labels = [
        'Title' => 'Titel',
        'Sort' 	=>	'Sortierung'
    ];

    public function updateFieldLabels(&$labels)
    {
        parent::updateFieldLabels($labels);
        $labels['HTML'] = _t(__CLASS__ . '.ContentLabel', 'Inhalt');
        $labels['Image'] = _t(__CLASS__ . '.ImageLabel', 'Bild');
        $labels['Images'] = _t(__CLASS__ . '.ImagesLabel', 'Bild');
        $labels['ShowImageCaptions'] = _t(__CLASS__ . '.ShowImageCaptionssLabel', 'Bildunterschriften anzeigen');
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {


            // Style: Description for default style (describes Layout thats used, when no special style is selected)
            $Style = $fields->dataFieldByName('Style');
            $StyleDefaultDescription = $this->owner->config()->get('styles_default_description', Config::UNINHERITED);
            if ($Style && $StyleDefaultDescription) {
                $Style->setDescription($StyleDefaultDescription);
            }

            // ReadMoreLink: use Linkfield
            $ReadMoreLink = LinkField::create('ReadMoreLinkID', 'Link');
            $fields->replaceField('ReadMoreLinkID', $ReadMoreLink);

            // Images Tab
            $fields->insertAfter(new Tab('ImagesTab', _t(__CLASS__ . '.ImagesTab','Images') ), 'Main');

            //  Images
            $fields->removeByName('Images');
            $Images = new SortableUploadField('Images', 'Images');
            $Images -> getValidator() -> setAllowedExtensions(array('jpg', 'gif', 'png'));
            $Images -> setFolderName('content-images');
            $fields -> addFieldToTab('Root.ImagesTab', $Images);


            // ImageViewMode
            $image_view_modes = $this->config()->get('image_view_modes');
            if (is_array($image_view_modes) && !empty($image_view_modes)) {
                $ImageViewModeDropdown = new DropdownField('ImageViewMode', _t(__CLASS__.'.ImageViewMode', 'Image View Mode'), $image_view_modes);
                $ImageViewModeDropdown->setDescription(_t(__CLASS__.'.ImageViewModeDescription', 'Options for displaying additional images'));
                $ImageViewModeDropdown->setEmptyString(_t(__CLASS__.'.ImageViewModeEmptyString', 'Choose View Mode...'));
                $fields -> addFieldToTab('Root.ImagesTab', $ImageViewModeDropdown);

                if ($this->getOtherImagesTemplate() && !$this->getOtherImagesTemplateExists()) {
                    $ImageViewModeTemplateErrorMessage = '<p class="message error">Error: Chosen Template "' . $this->getOtherImagesTemplate() . '" does not exist.</p>';
                    $ImageViewModeTemplateError = new LiteralField('ImageViewModeTemplateError',  $ImageViewModeTemplateErrorMessage);
                    $fields -> addFieldToTab('Root.ImagesTab', $ImageViewModeTemplateError);
                }
            }




        });
        $fields = parent::getCMSFields();
        return $fields;
    }


    public function ReadmoreLinkClass() {
        return $this->config()->get('readmore_link_class');
    }

    public function SortedImages()
    {
        return $this->Images()->Sort('SortOrder');
    }



    public function OtherImages($offset=1)
    {
        $result = $this->Images()->Sort('SortOrder')->limit(null, $offset);
        //var_dump($offset);

        if ($result && $result->count()) {
            $images = new ArrayList();
            foreach($result as $image){
                if($this->ShowImageCaptions) {
                    $image->ShowImageCaptions = true;
                }
                $images->push($image);
            }
            return $images;
        }
    }

    public function getOtherImagesTemplate()
    {
        if (!$this->ImageViewMode) {
            return false;
        }
        $template = $this->ClassName . '__OtherImages_' . $this->ImageViewMode;
        return $template;
    }

    public function getOtherImagesTemplateExists() {
        if(!$this->getOtherImagesTemplate()) {
            return false;
        }
        $template = $this->getOtherImagesTemplate();
        $template_exists = SSViewer::hasTemplate($template);
        if($template_exists){
            return $template;
        }
    }



    public function OtherImagesLayout($offset=1){
        $offset = intval($offset);
        if(!$this->ImageViewMode) return false;                            // keine weiteren Bilder anzeigen: abbrechen
        if(!$this->Images()->exists()) return false;                       // keine Bilder gefunden: abbrechen
        if(!$this->Style) $offset = 0;                                     // Layout, bei dem kein Bild "oben" verwendet wird: Offset auf 0 setzen

        if($this->OtherImages($offset) && $this->getOtherImagesTemplateExists()) {
            return $this->OtherImages($offset)->renderWith($this->getOtherImagesTemplate());
        }
    }





}
