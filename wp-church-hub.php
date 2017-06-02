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
 * @package           WP_Church_Hub
 *
 * @wordpress-plugin
 * Plugin Name:       WP Church Hub
 * Plugin URI:        http://wpchurch.team/church_hub/
 * Description:       Provides a Hub of Next Steps for your Church.
 * Version:           1.0.0
 * Author:            WP Church Team
 * Author URI:        http://wpchurch.team/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_church_team
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**  Custom Post Type */
require_once plugin_dir_path( __FILE__ ) . 'cpt.php';

/**  Customizer Panels */
require_once plugin_dir_path( __FILE__ ) . 'customizer.php';

/**  PageTemplater Class to add Page Template */
require_once plugin_dir_path( __FILE__ ) . 'templates/pagetemplater.php';

/**  Archive Page Templates */
require_once plugin_dir_path( __FILE__ ) . 'templates.php';

/**   Check if ACF is used with another plugin, if not already called, use this one */
if( ! class_exists('acf') ) {
	
	

	// 1. customize ACF path
	add_filter('acf/settings/path', 'wpch_acf_settings_path');
	 
	function wpch_acf_settings_path( $path ) {
	 
	    // update path
	    $path = plugin_dir_path( __FILE__ ) . '/advanced-custom-fields/';
	    
	    // return
	    return $path;
	    
	}
	// 2. customize ACF dir
	add_filter('acf/settings/dir', 'wpch_acf_settings_dir');
	 
	function wpch_acf_settings_dir( $dir ) {
	 
	    // update path
	    $dir = plugin_dir_path( __FILE__ ) . '/advanced-custom-fields/';
	    
	    // return
	    return $dir;
	    
	}

	// 3. Hide ACF field group menu item
	add_filter('acf/settings/show_admin', '__return_false');

	require_once plugin_dir_path( __FILE__ ) . 'advanced-custom-fields/acf.php';
}