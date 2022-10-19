<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Contact_Address_Map extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'Contact Address Map';
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
        return 'vxn-contact-address-map';
    }

    public function returnTypes()
    {
        return ['url'];
    }

    public function handler($attributes): StringData
    {
        $url = 'https://www.google.com/maps/search/?api=1&query='. urlencode(Options::get('contact')['txt-address']);
        return StringData::fromString($url); 
    }
}
