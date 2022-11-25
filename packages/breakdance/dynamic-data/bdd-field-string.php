<?php
namespace VXN\Express\Breakdance\Dynamic_Data;

use Breakdance\DynamicData\StringData;
use VXN\Express\Fields\Date_Field;
use VXN\Express\Fields\Phone_Field;
use VXN\Express\Fields\URL_Field;

use function Breakdance\Elements\control;

/** 
 * Trait to create Breakdance Dynamic Fields (String) 
 * @package VVXN\Express\Breakdance\Dynamic_Data
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
trait BDD_Field_String
{
    /** @var array $fields default = [] */
    protected $fields = [];

     /** @var array $date_fields default = [] */
    protected $date_fields = [];

    /**
     * @inheritDoc
     */    
    public function returnTypes()
    {
        return ['string'];
    }    
    
    /**
     * @param array $sections 
     * @return void 
     */
    protected function do_search_fields($sections){
        foreach($sections as $section){            
            foreach($section['fields'] as $field){
                if(!is_a($field, URL_Field::class)){
                    if(is_a($field, Date_Field::class)){
                        array_push($this->date_fields, $field['id']) ; 
                    }
                    $this->fields[] = ['text' => $field['title'], 'value' => $field['id']];    
                }
                if(is_a($field, Phone_Field::class)){                    
                    $this->fields[] = ['text' => $field['title'] . ' (Formatted)', 'value' => $field['id'] . '_formatted'];  
                }                
            }            
        }
    }

    public function has_fields(){
        return (!empty($this->fields));
    }    

    protected function get_controls(){
        $date_format_controls = [];   

        if(!empty($this->date_fields)){
            $date_format_controls[] = control('date_format', 'Format', [
                'type' => 'dropdown',
                'layout' => 'vertical',
                'items' => array_merge(
                    [['text' => 'Default', 'value' => get_option( 'date_format' )]],
                    \Breakdance\DynamicData\get_date_formats(),
                    [['text' => 'Custom', 'value' => 'Custom'], ['text' => 'Human', 'value' => 'Human']]
                ),
                'condition' => [
                    'path' => '%%CURRENTPATH%%.field_id',
                    'operand' => 'is one of',
                    'value' => $this->date_fields
                ] 
            ]);

            $date_format_controls[] = control('date_format_custom', 'Custom Format', [
                'type' => 'text',
                'layout' => 'vertical',
                'condition' => [
                    'path' => '%%CURRENTPATH%%.date_format',
                    'operand' => 'equals',
                    'value' => 'Custom'
                ]
            ]);
        }

        $controls = array_merge(
            [control('field_id', 'Field', [
            'type' => 'dropdown',
            'layout' => 'vertical',
            'items' => $this->fields])],
            $date_format_controls
        );

        return $controls;    
    }

    protected function get_handler($attributes, $shortcode_tag) :StringData{
        $field_id = $attributes['field_id'] ?? '';
        $shortcode = sprintf('[%s field="%s"]', $shortcode_tag, $field_id);
        $value = do_shortcode($shortcode);

        $format = $attributes['date_format'] ?? '';
        if($format){
            foreach($this->fields as $field){
                if($field_id == $field['id']){
                    if(is_a($field, Date_Field::class)){                            
                        // $format = $format ? : get_option( 'date_format' );
                        if ($format === 'Human') {
                            $value = human_time_diff(strtotime($value));
                        }else{
                            $value = date_format(date_create($value), $format);
                        }
                    }
                    break;
                }
            }
        }
        return StringData::fromString($value);        
    }
}
