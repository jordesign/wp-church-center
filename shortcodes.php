<?php // Add Shortcode
function wpcc_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'count' => '-1',
			'card_group' => '',
			'layout' => 'card',
		),
		$atts,
		'wpcc'
	);

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

	return wpcc_card_display($wpcc_query);

}
add_shortcode( 'wpcc', 'wpcc_shortcode' );