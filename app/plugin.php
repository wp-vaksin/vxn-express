<?php
namespace VXN\Express\Addon;

use Closure;
use VXN\Express;
use VXN\Express\Contact\Contact_Module;
use VXN\Express\Team_Member\Team_Member_Module;
use VXN\Express\Testi\Testi_Module;
use VXN\Express\Whatsapp\Whatsapp_Module;
use VXN\Express\WP\Shortcode\Shortcode;

/**
 * Class to run express add on plugin
 * @package VXN\Express\Addon 
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Plugin{

    /** @return void  */
    public static function run() {	

		add_action('vxn_express_load_modules', function() {
			define( 'VXN_EXPRESS_ADDON_DOMAIN', 'vxn-express' );
			load_plugin_textdomain( VXN_EXPRESS_DOMAIN, false, dirname( plugin_basename(VXN_EXPRESS_ADDON_PLUGIN_FILE) ) . '/languages' );
            
            Express::add_module(new Contact_Module());
			Express::add_module(new Whatsapp_Module());
            Express::add_module(new Testi_Module());
            Express::add_module(new Team_Member_Module());

			Express::add_shortcode(
                'vxn-format-idr',
                function( $atts, $content ) {
                    $content = do_shortcode($content);
                    return esc_html('Rp. ' . number_format($content,0,",","."));
                }
            );
        },1);

		add_action('vxn_express_load_modules', function() {
            Express::add_menu_page(Setup_Page_Factory::create());
        },999);        
    }
}