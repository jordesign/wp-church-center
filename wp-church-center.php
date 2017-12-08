<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wpchurch.team
 * @since             1.0.0
 * @package           WP_Church_Center
 *
 * @wordpress-plugin
 * Plugin Name:       WP Church Center
 * Plugin URI:        http://wpchurch.center
 * Description:       Provides a 'Next Steps' Center for your Church.
 * Version:           1.2.9
 * Author:            Jordesign, WP Church Team
 * Author URI:        http://wpchurch.team/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       WP_Church_Center
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Enable ACF 5 early access
 * Requires at least version ACF 4.4.12 to work
 */
define('ACF_EARLY_ACCESS', '5');

add_action( 'after_setup_theme', 'wpcc_acf_setup' );

function wpcc_acf_setup() {
	/**   Check if ACF is used with another plugin, if not already called, use this one */
	if( ! class_exists('acf') ) {

		// 1. customize ACF path
		add_filter('acf/settings/path', 'wpcc_acf_settings_path');
		 
		function wpcc_acf_settings_path( $path ) {
		 
		    // update path
		    $path = plugin_dir_path( __FILE__ ) . '/advanced-custom-fields/';
		    
		    // return
		    return $path;
		    
		}
		
		// 2. customize ACF dir
		add_filter('acf/settings/dir', 'wpcc_acf_settings_dir');
		 
		function wpcc_acf_settings_dir( $dir ) {

			// update path
			$dir = plugin_dir_url( __FILE__ ) . '/advanced-custom-fields/';
			
			// return
			return $dir;

		}

		// 3. Hide ACF field group menu item
		add_filter('acf/settings/show_admin', '__return_false');

			require_once plugin_dir_path( __FILE__ ) . 'advanced-custom-fields/acf.php';
	}
}

/**  Custom Post Type */
require_once plugin_dir_path( __FILE__ ) . 'cpt.php';

/**  Customizer Panels */
require_once plugin_dir_path( __FILE__ ) . 'customizer.php';

/**  PageTemplater Class to add Page Template */
require_once plugin_dir_path( __FILE__ ) . 'templates/pagetemplater.php';

/**  Archive Page Templates */
require_once plugin_dir_path( __FILE__ ) . 'templates.php';

/**  Page Ordering */
require_once plugin_dir_path( __FILE__ ) . 'page-ordering/simple-page-ordering.php';

/**  Stuff for the Admin */
require_once plugin_dir_path( __FILE__ ) . 'admin/admin.php';

