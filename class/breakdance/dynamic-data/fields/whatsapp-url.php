<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data\Fields;

use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class Whatsapp_Url extends StringField
{
    /**
     * @inheritDoc
     */
    public function label()
    {
        return __('WhatsApp URL', 'vxn-express');
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
        return 'vxn-whatsapp-url';
    }

    /**
     * @inheritDoc
     */    
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
            \Breakdance\Elements\control('whatsapp_text', 'Template', [
                'type' => 'dropdown',
                'layout' => 'vertical',
                'items' => [
                    ['text' => __('Default Text', 'vxn-express'), 'value' => '[vxn-wa-text]'], 
                    ['text' => __('Order Text', 'vxn-express'), 'value' => 'Order'],
                    ['text' => __('Consult Text', 'vxn-express'), 'value' => '[vxn-wa-text-consult]'],
                    ['text' => __('Product Consult Text', 'vxn-express'), 'value' => 'Konsul Produk'],
                    ['text' => __('Appointment Text', 'vxn-express'), 'value' => '[vxn-wa-text-appointment]'],
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
            \Breakdance\Elements\control('product_param', __('Product Name', 'vxn-express'), [
                'type' => 'text',
                'layout' => 'vertical',
                'textOptions' => ['multiline' => true],
                'condition' => [
                    'path' => '%%CURRENTPATH%%.whatsapp_text',
                    'operand' => 'is one of',
                    'value' => ['Order', 'Konsul Produk']
                ]
            ])
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
        }elseif($text === 'Konsul Produk'){
            $shortcode = sprintf('[vxn-wa-text-consult-product product="%s"]', $attributes['product_param'] ?? '');
            $text = do_shortcode($shortcode);
        }else{
            $text = do_shortcode($text);
        }
        
        $whatsapp_url = do_shortcode( '[vxn-wa-url]' ) . '&text=' . urlencode($text);
        return StringData::fromString($whatsapp_url);        
    }
}
