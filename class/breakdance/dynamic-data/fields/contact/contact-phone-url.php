<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Contact_Phone_Url extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return __('Phone URL', 'vxn-express');
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
        return 'vxn-contact-phone-url';
    }

    public function returnTypes()
    {
        return ['url'];
    }

    public function handler($attributes): StringData
    {
        return StringData::fromString(do_shortcode('[vxn-contact-phone-url]'));        
    }
}
