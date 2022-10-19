<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Contact_Email_Url extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'Contact Email URL';
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
        return 'vxn-contact-email-url';
    }

    public function returnTypes()
    {
        return ['url'];
    }

    public function handler($attributes): StringData
    {
        $email_url = 'mailto:' . Options::get('contact')['txt-email'];
        return StringData::fromString($email_url);        
    }
}
