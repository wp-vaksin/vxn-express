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
        return 'Contact Phone URL';
    }

    /**
     * @inheritDoc
     */
    public function category()
    {
        return 'Express Contact';
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
        $phone = 'tel:' . Options::get('contact')['txt-phone'];
        return StringData::fromString($phone);        
    }
}
