<?php

/** Enqueue Media Scripts and Styles **/
function wpcc_enqueue_media() {
    if( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'wpcc_enqueue_media');

/** Enqueue Admin Stylesheet **/
function wpcc_load_custom_wp_admin_style($hook) {
        // Load only on Edit pages
        
        wp_enqueue_style( 'custom_wp_admin_css', plugins_url('wpcc-admin-min.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'wpcc_load_custom_wp_admin_style' );
