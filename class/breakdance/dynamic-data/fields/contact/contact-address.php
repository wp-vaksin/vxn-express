<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Contact_Address extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return __('Address', 'vxn-express');
    }

    /**
     * @inheritDoc
     */
    public function category()
    {
        return __('Express Contact', 'vxn-express');
    }

    /**
     * @inheritDoc
     */
    public function slug()
    {
        return 'vxn-contact-address';
    }

    public function returnTypes()
    {
        return ['string'];
    }

    public function handler($attributes): StringData
    {
        return StringData::fromString(do_shortcode('[vxn-contact-address]'));        
    }
}
