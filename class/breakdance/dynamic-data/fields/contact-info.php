<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class Contact_Info extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return __('Contact Information', 'vxn-express');
    }

    /**
     * @inheritDoc
     */
    public function category()
    {
        return __('Express Options', 'vxn-express');
    }

    /**
     * @inheritDoc
     */
    public function slug()
    {
        return 'vxn-contact-info';
    }

    public function returnTypes()
    {
        return ['string'];
    }

    /**
     * @inheritDoc
     */        
    public function controls()
    {
        return [
            \Breakdance\Elements\control('vxn_contact_info', 'Field', [
                'type' => 'dropdown',
                'layout' => 'vertical',
                'items' => [
                    ['text' => __('Email', 'vxn-express'), 'value' => '[vxn-contact-email]'], 
                    ['text' => __('Phone', 'vxn-express'), 'value' => '[vxn-contact-phone]'],
                    ['text' => __('Phone Formatted', 'vxn-express'), 'value' => '[vxn-contact-phone-formatted]'],
                    ['text' => __('Address', 'vxn-express'), 'value' => '[vxn-contact-address]'],                                    ]
            ]),
        ];        
    }

    public function handler($attributes): StringData
    {
        $result = $attributes['vxn_contact_info'] ?? '';
        return StringData::fromString(do_shortcode( $result ));        
    }
}
