<?php
namespace VXN\Express\Contact;

use VXN\Express;
use VXN\Express\Contact\Admin\Contact_Page;
use VXN\Express\Helper\Util;
use VXN\Express\Module_Interface;

/** @package VXN\Express\Contact */
class Contact_Module implements Module_Interface {
    
    /** @inheritDoc */
    public static function name(){
        return 'Contact';
    }

    /** @inheritDoc */
    public static function slug(){
        return 'vxn_express_contact';
    }

    /** @inheritDoc */
    public static function section() {
        return 'free';
    }

    /** @return void  */
    public function run(){
        define( 'VXN_EXPRESS_CONTACT_DOMAIN', 'vxn-express-contact' );
        define( 'VXN_EXPRESS_CONTACT_MODULE_FILE', __FILE__ );
  
        load_plugin_textdomain( VXN_EXPRESS_CONTACT_DOMAIN, false, dirname( plugin_basename(VXN_EXPRESS_CONTACT_MODULE_FILE) ) . '/languages' ); 

        Express::add_menu_page(new Contact_Page());

        // self::add_shortcodes();
    }

    /** @return array  */
    private static function add_shortcodes(){
        
        Express::add_shortcode(
            'vxn-google-map-url',
            function() {
                $url = 'https://www.google.com/maps/search/?api=1&query='. urlencode(Express::Options('vxn_express_contact.txt-place'));
                return esc_url($url);
            }
        );
    }

}