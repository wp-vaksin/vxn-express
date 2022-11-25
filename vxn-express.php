<?php
/**
 * Plugin Name:       Express Add On
 * Plugin URI: 		  https://github.com/wp-vaksin/vxn-express
 * Description:       Express Add-on for Breakdance website builder, the time saver plugin!
 * Version:           1.1.3
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Vaksin
 * Author URI:        https://wp.vaks.in/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vxn-express
 * Domain Path: 	  /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'VXN_EXPRESS_ADDON_PLUGIN_FILE', __FILE__  );
define( 'VXN_EXPRESS_ADDON_PATH', plugin_dir_path( __FILE__ ) );
define( 'VXN_EXPRESS_ADDON_URL', plugin_dir_url( __FILE__ ) );

require_once VXN_EXPRESS_ADDON_PATH . '/inc/autoloader.php';
require_once VXN_EXPRESS_ADDON_PATH . '/packages/bootstrap.php';

\VXN\Express\Addon\Plugin::run();
\VXN\Express::run();