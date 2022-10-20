<?php
namespace VXN\Express\Core;

use VXN\Express\Core\Admin\Admin_menu;

/**
 * Class to run express add on plugin
 * @package VXN\Express\Core 
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Plugin{

    /** @return void  */
    public static function run() {
		self::check_requirements();

		load_plugin_textdomain( 'vxn-express', false, dirname( plugin_basename(VXN_EXPRESS_CORE_PLUGIN_FILE) ) . '/languages' ); 
		
		add_action('breakdance_loaded', function() {
			Breakdance::register();
		});

		add_action( 'plugins_loaded', function() {			

			if( is_admin() ){
				add_action('vxn_express_loaded', function() {
					Admin_menu::add();
				}, 999);
			}else{
				add_action('vxn_express_loaded', function() {
					Shortcodes::add();
					do_action('vxn_express_shortcodes_loaded');
				}, 999);
			}
	
			add_action('vxn_express_init', function() {
				Options::reload();
			}, 999);
	
			add_action('vxn_express_loaded', function() {
				Assets::enqueue();
			}, 999);

			do_action('vxn_express_init');	
			do_action('vxn_express_loaded');			
	
		});

    }

	/** @return bool  */
	private static function check_requirements() {
		add_action( 'admin_init', function() {
			$ok = true;			
			if (! defined('__BREAKDANCE_PLUGIN_FILE__') ||  ! is_plugin_active(plugin_basename(__BREAKDANCE_PLUGIN_FILE__))){
				add_action('admin_notices', function() {
					echo <<< EOT
						<div class="error">
							<p>Express Add On deactivated!, this plugins requires <a href="https://s.id/breakdance">Breakdance</a> installed & activated.<p>
						</div>
					EOT;
				});
				$ok = false;
			}
	
			if(!$ok){
				deactivate_plugins(VXN_EXPRESS_CORE_PLUGIN_FILE);
			}	
		});
	}	
}