<?php
/*
 * Template Name: Church Center Homepage
 * Description: The full list of Church Center cards
 */


/**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'header.php';

// Set up query	
	$wpcc_query = new WP_Query( array (
	     'post_type' => 'card', 
	     'posts_per_page' => -1,
	     'orderby' => 'menu_order',
	     'order' => 'ASC',
	     'meta_query' => array(
	        'relation' => 'OR',
	        array(
				'key' => 'wpcc_unlisted',
	          'compare' => 'NOT EXISTS'
	        ),
	        array(
				'key' => 'wpcc_unlisted',
				'value' => '0',
	          'compare' => '==',
	        ),
	     ),
	) );

echo wpcc_card_display($wpcc_query,NULL);


 /**  Load Footer */
require_once plugin_dir_path( __FILE__ ) . 'footer.php';