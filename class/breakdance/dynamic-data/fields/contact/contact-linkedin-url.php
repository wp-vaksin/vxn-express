<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Contact_linkedin_Url extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'Contact LinkedIn URL';
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
        return 'vxn-contact-linkedin-url';
    }

    public function returnTypes()
    {
        return ['url'];
    }

    public function handler($attributes): StringData
    {
        return StringData::fromString(Options::get('contact')['txt-linkedin'] ?? '');        
    }
}
