<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Whatsapp;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Show_Whatsapp_Form extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'Is Show WhatsApp Form';
    }

    /**
     * @inheritDoc
     */
    public function category()
    {
        return 'Express WhatsApp';
    }

    /**
     * @inheritDoc
     */
    public function slug()
    {
        return 'vxn-show-whatsapp-form';
    }

    public function returnTypes()
    {
        return ['string'];
    }

    public function handler($attributes): StringData
    {
        return StringData::fromString(Options::get('whatsapp')['chk-show-form']);        
    }
}
