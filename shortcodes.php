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

	return wpcc_card_display();

}
add_shortcode( 'wpcc', 'wpcc_shortcode' );