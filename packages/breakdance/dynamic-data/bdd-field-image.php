<?php
namespace VXN\Express\Breakdance\Dynamic_Data;

use Breakdance\DynamicData\ImageData;
use VXN\Express\Fields\Email_Field;
use VXN\Express\Fields\URL_Field;

use function Breakdance\Elements\control;

/** 
 * Trait to create Breakdance Dynamic Fields (Image) 
 * @package VXN\Express\Breakdance\Dynamic_Data
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
trait BDD_Field_Image
{
    /** @var array $fields default = []*/
    protected $fields = [];
         
    /**
     * @param array $sections 
     * @return void 
     */
    protected function do_search_fields($sections){
        foreach($sections as $section){            
            foreach($section['fields'] as $field){
                if(is_a($field, URL_Field::class) && $field['is_image']){
                    $this->fields[] = ['text' => $field['title'], 'value' => $field['id']];    
                }
                if(is_a($field, Email_Field::class)){                    
                    $this->fields[] = ['text' => $field['title'] . ' (Avatar Image)', 'value' => $field['id'] . '__avatar__'];  
                }
            }            
        }
    }

    /** @return bool  */
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

    protected function get_handler($attributes, $shortcode_tag) :ImageData{
        $field_id = $attributes['field_id'] ?? '';

        if(substr($field_id, -10) == '__avatar__'){
            $shortcode = sprintf('[%s field="%s"]', $shortcode_tag, rtrim($field_id, '__avatar__'));
            $email = do_shortcode($shortcode);
            return $this->get_avatar_image($email);
        }

        $shortcode = sprintf('[%s field="%s"]', $shortcode_tag, $field_id);
        $url = do_shortcode($shortcode);

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return ImageData::fromUrl($url);
        }

        return ImageData::emptyImage();  
    }

    private function get_avatar_image($email) : ImageData{
     
        $avatarSizes = [
            // The largest available size in Gravatar is 2048x2048
            'full' => get_avatar_data($email, ['size' => 2048])
        ];

        $availableSizes = \Breakdance\Media\Sizes\getAvailableSizes();
        foreach ($availableSizes as $availableSize) {
            if (array_key_exists('width', $availableSize)) {
                $avatarSizes[$availableSize['slug']] = get_avatar_data($email, ['size' => $availableSize['width']]);
            }
        }

        $imageData = new ImageData();
        $imageData->sizes = $avatarSizes;
        return $imageData;   
    }

}
