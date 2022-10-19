<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;
use VXN\Express\Core\Options;

class Contact_Email extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'Contact Email';
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
        return 'vxn-contact-email';
    }

    public function returnTypes()
    {
        return ['string'];
    }

    public function handler($attributes): StringData
    {
        return StringData::fromString(Options::get('contact')['txt-email']);        
    }
}
