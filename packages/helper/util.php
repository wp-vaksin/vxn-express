<?php
namespace VXN\Express\Helper;

use VXN\Express\Fields\Field;
use VXN\Express\Fields\Text_Field;
use VXN\Express\Fields\Text_Area;

/**
 * Static utility functions
 * @package VXN\Express\Helper
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
class Util {    

    /**
     * To format phone number
     * <code>
     * $formated
     * </code>
     * @param string $phone  Example: +6281220003131
     * @param string $format Example: 3|0xxx-xxxx-xxxxx
     * @return string Result from example: 0812-2000-3131
     */
    public static function format_phone($phone, $format){
        
        if(!$format) {
            return $phone;
        }

        $opts = explode('|', $format);        
        $start = 0;
        
        if(count($opts)>1) {
            $start = intval($opts[0]);
            $format = $opts[1];
        }

        $arr_format = str_split($format);
        $arr_phone = str_split($phone);

        $i = $start;
        $result = '';

        foreach($arr_format as $value){
            if($value == 'x'){
                if($i >= count($arr_phone)){
                    break;
                }

                $result .= $arr_phone[$i];

                $i += 1;
            } else {
                $result .= $value;
            }
        }

        if($i <= count($arr_phone)){
            $result .= substr($phone, $i);
        }

        return $result;
    }

    /** @return string  */
    public static function get_current_url(){
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    /**
     * @param mixed $var 
     * @return void 
     */
    public static function print_debug($var){
        echo "< !-- \n DEBUG: \n";
        print_r($var);
        echo "\n --> ";
    }

    /** @return string|false  */
    public static function get_logo_url(){
        $logo_id = get_theme_mod('custom_logo');
        return wp_get_attachment_image_url($logo_id, 'full') ?? '';
    }

    /**
     * @param array $array 
     * @return array 
     */
    public static function remove_empty_array_deep(array $array){
        foreach($array as $key => $value) {
            if(empty($value)) {
                unset($array[$key]);
            }elseif(is_array($value)){
                $array[$key] = self::remove_empty_array_deep($value);
            }
        }
        return $array;
    }

    /**
     * @param Field $field 
     * @return string|float|int|void 
     */
    public static function sanitize_field (Field $field ) { 
    
		switch(true){
			case is_a($field, Text_Field::class):
				return sanitize_text_field($field['value']);
				break;
            case is_a($field, Text_Area::class):
                return esc_textarea($field['value']);
                break;
			case is_a($field, Select_Field::class):
				return sanitize_text_field($field['value']);
				break;	
			case is_a($field, Date_Field::class):
				return sanitize_text_field($field['value']);
				break;
			case is_a($field, Checkbox::class):
				return sanitize_text_field($field['value']);
				break;
			case is_a($field, Number_Field::class):
                $value = sanitize_text_field($field['value']);
                
                if($field['number_type'] = 'float') {
                    return floatval($value);
                }

                return intval($value);

				break;                    
			case is_a($field, Email_Field::class):
				return sanitize_email($field['value']);
				break;                    
			default:
				break;
		}
    }

	/**
	 * @param string $text 
	 * @return string 
	 */
	public static function parse_shortcode_dynamic_var( $text ) {

		if ( strpos( $text, '{page_title}' ) !== false ) {
			$dynamic_var['page_title'] = get_the_title();
		}		

		if ( strpos( $text, '{url}' ) !== false ) {
			$dynamic_var['url'] = get_permalink( get_the_ID() );
		}

		if ( !empty( $dynamic_var ) ) {
			foreach ( $dynamic_var as $key => $value ) {
				$text = str_replace( '{' . $key . '}', $value, $text );
			}
		}

		return $text;
	}

	/**
	 * @param string $text 
	 * @param array $args 
	 * @return string 
	 */
	public static function replace_shortcode_dynamic_var_with_atts( $text, $args ) {
		if ( !empty( $args ) ) {
			foreach ( $args as $key => $value ) {
				if ( $value ) {
					$text = str_replace( '{' . $key . '}', do_shortcode( $value ), $text );
				}
			}
		}

		return $text;
	}

    public static function get_key_value($key, $array) {
        if(array_key_exists ($key, $array)){
            return $array[$key];
        }else{
            foreach($array as $value){
                if(is_array($value)){
                    $val = static::get_key_value($key, $value);
                    if(!is_null($val)){
                        return $val;
                    }
                }
            }
        }

        return null;
    }

    public static function google_map_url($place){
        $url = 'https://www.google.com/maps/search/?api=1&query='. urlencode($place);
        return esc_url($url);
    }

    public static function remove_empty(array $array){
        $array = array_filter($array, function($var){
            return !empty($var) || $var === '0';
        });

        foreach($array as $key => $value){
            if(is_array($value)){
                $value = self::remove_empty($value);
            }
            $array[$key] = $value;
        }
        return $array;
    }    
}
