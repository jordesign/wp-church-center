<?php // Add Shortcode
function wpcc_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'count' => '-1',
			'card_group' => '',
			'layout' => NULL,
		),
		$atts,
		'wpcc'
	);


	// Use Card_Group *if* we have one
	if ($atts['card_group'] != ''){
		$wpcc_query = new WP_Query( array (
		     'post_type' => 'card', 
		     'posts_per_page' => $atts['count'],
		     'orderby' => 'menu_order',
		     'order' => 'ASC',
		     'tax_query' => array(
		        array(
		            'taxonomy' => 'card_group',
		            'field'    => 'slug',
		            'terms'    =>  $atts['card_group'],
		        ),
		    ),
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
	}else{
		$wpcc_query = new WP_Query( array (
		     'post_type' => 'card', 
		     'posts_per_page' => $atts['count'],
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
	}

	return wpcc_card_display($wpcc_query,$atts['layout']);

}
add_shortcode( 'wpcc', 'wpcc_shortcode' );