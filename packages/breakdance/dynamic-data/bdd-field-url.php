<?php
namespace VXN\Express\Breakdance\Dynamic_Data;

use Breakdance\DynamicData\StringData;
use VXN\Express\Fields\Email_Field;
use VXN\Express\Fields\Phone_Field;
use VXN\Express\Fields\URL_Field;

use function Breakdance\Elements\control;

/** 
 * Trait to create Breakdance Dynamic Fields (URL) 
 * @package VXN\Express\Breakdance\Dynamic_Data
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
trait BDD_Field_URL
{
    /** @var array $fields default = []*/
    protected $fields = [];

    /**
     * @inheritDoc
     */    
    public function returnTypes()
    {
        return ['url'];
    }    
    
    protected function do_search_fields($sections){
        foreach($sections as $section){            
            foreach($section['fields'] as $field){
                if(is_a($field, URL_Field::class)){
                    $this->fields[] = ['text' => $field['title'], 'value' => $field['id']];    
                }
                if(is_a($field, Phone_Field::class) || is_a($field, Email_Field::class)){                    
                    $this->fields[] = ['text' => $field['title'] . ' URL', 'value' => $field['id'] . '_url'];  
                }
            }            
        }
    }

    public function has_fields(){
        return (!empty($this->fields));
    }        

    protected function get_controls(){
        return [
            control('field_id', 'Field', [
            'type' => 'dropdown',
            'layout' => 'vertical',
            'items' => $this->fields])
        ];
    }

    protected function get_handler($attributes, $shortcode_tag) :StringData{

        $field_id = $attributes['field_id'] ?? '';

        $shortcode = sprintf('[%s field="%s"]', $shortcode_tag, $field_id);
        $value = do_shortcode($shortcode);
        
        return StringData::fromString(esc_url($value));        
    }
}
