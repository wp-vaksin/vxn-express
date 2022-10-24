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
        return __('Phone', 'vxn-express');
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
        return 'vxn-contact-phone';
    }

    public function returnTypes()
    {
        return ['string'];
    }

    public function handler($attributes): StringData
    {
        return StringData::fromString(do_shortcode( '[vxn-contact-phone-display]' ));        
    }
}
