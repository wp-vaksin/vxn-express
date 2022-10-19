<?php
namespace VXN\Express\Core\Breakdance\Dynamic_Data;

use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Address;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Address_Map;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Email;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Email_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Facebook_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Instagram_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_linkedin_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Phone;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Phone_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Twitter_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Contact\Contact_Youtube_Url;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Whatsapp\Show_Whatsapp_Form;
use VXN\Express\Core\Breakdance\Dynamic_Data\Fields\Whatsapp\Whatsapp_Url;

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
            new Contact_Phone(),
            new Contact_Phone_Url(),
            new Contact_Email(),
            new Contact_Email_Url(),
            new Contact_Address(),
            new Contact_Address_Map(),
            new Contact_Facebook_Url(),
            new Contact_Instagram_Url(),
            new Contact_Youtube_Url(),
            new Contact_Twitter_Url(),
            new Contact_linkedin_Url(),
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