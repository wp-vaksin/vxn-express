<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class Contact_URL extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return __('Contact URL', 'vxn-express');
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
        return 'vxn-contact-address-map';
    }

    public function returnTypes()
    {
        return ['url'];
    }

    /**
     * @inheritDoc
     */        
    public function controls()
    {
        return [
            \Breakdance\Elements\control('vxn_contact_url', 'URL Field', [
                'type' => 'dropdown',
                'layout' => 'vertical',
                'items' => [
                    ['text' => __('Email URL', 'vxn-express'), 'value' => '[vxn-contact-email-url]'], 
                    ['text' => __('Phone URL', 'vxn-express'), 'value' => '[vxn-contact-phone-url]'],
                    ['text' => __('Google Map URL', 'vxn-express'), 'value' => '[vxn-google-map-url]'],                    
                    ['text' => __('Facebook URL', 'vxn-express'), 'value' => '[vxn-facebook-url]'],
                    ['text' => __('Instagram URL', 'vxn-express'), 'value' => '[vxn-instagram-url]'],
                    ['text' => __('Twitter URL', 'vxn-express'), 'value' => '[vxn-twitter-url]'],
                    ['text' => __('LinkedIn URL', 'vxn-express'), 'value' => '[vxn-linkedin-url]'],
                    ['text' => __('Youtube URL', 'vxn-express'), 'value' => '[vxn-youtube-url]'],
                ]
            ]),
        ];        
    }

    public function handler($attributes): StringData
    {
        $url = $attributes['vxn_contact_url'] ?? '';
        return StringData::fromString(do_shortcode($url)); 
    }
}
