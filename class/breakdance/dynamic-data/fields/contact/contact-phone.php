<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class Contact_Phone extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'Contact Phone';
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
        return 'vxn-contact-phone';
    }

    public function returnTypes()
    {
        return ['string'];
    }

    public function handler($attributes): StringData
    {
        $phone = do_shortcode( '[vxn-contact-phone-display]' );
        return StringData::fromString($phone);        
    }
}
