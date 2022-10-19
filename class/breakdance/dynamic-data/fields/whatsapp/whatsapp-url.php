<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Whatsapp;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class Whatsapp_Url extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return 'WhatsApp URL';
    }

    /**
     * @inheritDoc
     */
    public function category()
    {
        return 'Express WhatsApp';
    }

    /**
     * @inheritDoc
     */
    public function slug()
    {
        return 'vxn-whatsapp-url';
    }

    /**
     * @inheritDoc
     */    
    public function returnTypes()
    {
        return ['url', 'string'];
    }

    /**
     * @inheritDoc
     */        
    public function controls()
    {
        return [
            \Breakdance\Elements\control('whatsapp_text', 'Template', [
                'type' => 'dropdown',
                'layout' => 'vertical',
                'items' => [
                    ['text' => 'Default', 'value' => '[vxn-wa-text]'], 
                    // ['text' => 'Template Order', 'value' => '[vxn-wa-text-order]'],
                    ['text' => 'Order', 'value' => 'Order'],
                    ['text' => 'Konsultasi Umum', 'value' => '[vxn-wa-text-consult]'],
                    ['text' => 'Konsultasi Produk', 'value' => '[vxn-wa-text-consult-product]'],
                    ['text' => 'Custom Text', 'value' => 'Custom'],
                ]
            ]),
            \Breakdance\Elements\control('custom_text', 'Custom text', [
                'type' => 'text',
                'layout' => 'vertical',
                'textOptions' => ['multiline' => true],
                'condition' => [
                    'path' => '%%CURRENTPATH%%.whatsapp_text',
                    'operand' => 'equals',
                    'value' => 'Custom'
                ]
            ]),
            // \Breakdance\Elements\control('product_param', 'Nama Produk', [
            //     'type' => 'text',
            //     'layout' => 'vertical',
            //     'textOptions' => ['multiline' => true],
            //     'condition' => [
            //         'path' => '%%CURRENTPATH%%.whatsapp_text',
            //         'operand' => 'equals',
            //         'value' => 'Order'
            //     ]
            // ])
        ];        
    }

    /**
     * array $attributes
     */    
    public function handler($attributes): StringData
    {

        $text = $attributes['whatsapp_text'] ?? '';

        if($text === 'Custom'){
            $text = $attributes['custom_text'] ?? '';
        }elseif($text === 'Order'){
            $shortcode = sprintf('[vxn-wa-text-order product="%s"]', $attributes['product_param'] ?? '');
            $text = do_shortcode($shortcode);
        }else{
            $text = do_shortcode($text);
        }
        
        $whatsapp_url = do_shortcode( '[vxn-wa-url]' ) . '&text=' . urlencode($text);
        return StringData::fromString($whatsapp_url);        
    }
}
