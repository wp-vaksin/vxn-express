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
        return __('Is Show WhatsApp Popup', 'vxn-express');
    }

    /**
     * @inheritDoc
     */
    public function category()
    {
        return __('Express WhatsApp', 'vxn-express');
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
        return StringData::fromString(do_shortcode('[vxn-wa-is-popup]'));        
    }
}
