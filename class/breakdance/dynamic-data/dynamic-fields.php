<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data;

use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Address;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Email;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact_Info;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Phone;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact_URL;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Show_Whatsapp_Form;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Whatsapp_Url;

use function Breakdance\DynamicData\registerField;

class Dynamic_Fields {
 
    public static function register(){
        add_action('init', function() {
            if (!function_exists('\Breakdance\DynamicData\registerField') || !class_exists('\Breakdance\DynamicData\Field')) {
                return;
            }
    
            $fields = array_merge(
                self::setup_fields(),
                self::whatsapp_fields(), 
                self::contact_fields(), 
            );
            
            foreach ($fields as $field) {
                registerField($field);
            }	            
        });
	}
 
    public static function contact_fields() {
        return [
            new Contact_URL(),
            new Contact_Info(),
        ];
    }    
 
    public static function whatsapp_fields() {
        return [
            new Whatsapp_Url(),
            new Show_Whatsapp_Form(),			
        ];
    }
 
    public static function setup_fields() {
        return [];
    }
}