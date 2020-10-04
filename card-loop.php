<?php // The loop for displaying cards 

function wpcc_card_display($wpcc_display_query,$wpcc_shortcode_layout){ 

	//SET Get Default Layout for the cards
	$layout = get_option( 'wpcc_layout' );

	// Check URL vars for layout	
	if ( isset($_GET["layout"]) ) {
		$layout = esc_html( $_GET["layout"] );
	}

	// Check if Layout is set by the shortcode
	if ( $wpcc_shortcode_layout ) {
		$layout = $wpcc_shortcode_layout;
	}

// Construct outer 'cardHolder' DIV with classes
$wpcc_card_output= '<div class="cardHolder ';

		$wpcc_card_output.= $layout;
	 

	if($layout == 'card') { 
		$wpcc_card_output.= ' ' . get_option( 'wpcc_scroll_direction' ); 
	}

	if( defined( 'WPCC_LAYOUT_SWITCHING') && WPCC_LAYOUT_SWITCHING  ===  1){ 
		$wpcc_card_output.=  ' layoutSwitching'; 
	}
$wpcc_card_output.= '">';

// Construct Internal 'cards' DIV with classes
$wpcc_card_output.= '<div class="cards ';

	if(get_option( 'wpcc_greyscale' ) == 1) { 
		$wpcc_card_output.= 'greyscale '; 
	} 

	if(get_option( 'wpcc_tinting ' ) == 1) { 
		$wpcc_card_output.= 'tint '; 
	}  

	if($layout == 'small-card') { 
		$wpcc_card_output.= 'js-masonry ' . get_option('wpcc_small_card_columns'); 
	} 

$wpcc_card_output.= '">';

// The Loop	
if ( $wpcc_display_query -> have_posts() ) {
	while ( $wpcc_display_query -> have_posts() ) {
		$wpcc_display_query -> the_post();
		global $post;

				
		//set up the link for the card
		if(get_field("wpcc_card_type") === 'external'){
			$card_link = esc_url(get_field('wpcc_external_url') );
		}else{
			$card_link = get_permalink($post->ID);
		}

		//Add a filter on $card_link to let plugins change it
		if(has_filter('wpcc_card_link')) {
			$card_link = apply_filters('wpcc_card_link', $card_link);
		} 

		// Set Card Title	
		$cardTitle = get_the_title(); 

		if(has_filter('wpcc_archive_card_title')) {
			$cardTitle = apply_filters('wpcc_archive_card_title', $cardTitle);		
		}

		// Set Card Subtitle
		$cardSubtitle = get_field('wpcc_subtitle');

		if(has_filter('wpcc_archive_card_subtitle')) {
			$cardSubtitle = apply_filters('wpcc_archive_card_subtitle', $cardSubtitle);
		}
		
		
		// when 'List' is the layout type
		if (  $layout =='list') { 

			do_action('wpcc_before_card');

			// Card Link
			$wpcc_card_output.= '<a class="card ';

				// Card Link Classes
				ob_start();
				do_action('wpcc_card_link_classes'); 
				$link_classes = ob_get_contents();
				ob_end_clean();
				$wpcc_card_output.= $link_classes;

				// Card Link Href
				$wpcc_card_output.= '" href="' .  $card_link . '" ';

				// Card Link Inline Style
				$wpcc_card_output.= 'style="background-color: ' . get_field('wpcc_color') . '" ';
				
				// Card Link Target
				if(get_field("wppc_external_new_window") == '1'){ 
					$wpcc_card_output.= 'target="_blank" ';
				}

				//Action to add additional attributes to the anchor
				ob_start();
				do_action('wpcc_card_link_attr'); 
				$link_attrs = ob_get_contents();
				ob_end_clean();
				$wpcc_card_output.= $link_attrs;
			
			//END Anchor			 
			$wpcc_card_output.= '>';

				// Card List Body DIV
				$wpcc_card_output.= '<div class="cardBody">';
					

					// Output Card Title		
					$wpcc_card_output.= '<h3 style="color: ' . get_field('wpcc_color') . '">' . $cardTitle . '</h3>';

					// Output Card Subtitle
					if($cardSubtitle){ 
						$wpcc_card_output.= '<p>' . $cardSubtitle . '</p>';
					} 
						
				// Close List Body Div
				$wpcc_card_output.= '</div>';

				// Output Card List Arrow
				$wpcc_card_output.= '<i class="fa fa-angle-circled-right" style="color: ' . get_field('wpcc_color') . '"></i>';

			// CLOSE Anchor
			$wpcc_card_output.= '</a>';

			do_action('wpcc_after_card'); 

		// If 'Small Card' is the layout type
		} elseif ( $layout == 'small-card' ) { 

			do_action('wpcc_before_card'); 

			// Card Link
			$wpcc_card_output.= '<a class="card ';

				// Card Link Classes
				ob_start();
				do_action('wpcc_card_link_classes'); 
				$link_classes = ob_get_contents();
				ob_end_clean();
				$wpcc_card_output.= $link_classes;

				// Card Link Href			
				$wpcc_card_output.= '" href="' . $card_link . '" ';
				
				// Card Link Target
				if(get_field("wppc_external_new_window") == '1'){ 
					$wpcc_card_output.= 'target="_blank" ';
				}

				//Action to add additional attributes to the anchor
				ob_start();
				do_action('wpcc_card_link_attr'); 
				$link_attrs = ob_get_contents();
				ob_end_clean();
				$wpcc_card_output.= $link_attrs; 
							 
			$wpcc_card_output.= '>';


				// Card List Body DIV
				$wpcc_card_output.= '<div class="cardBody">';

					// Card Image DIV
					$wpcc_card_output.= '<div class="cardImage" ';

						// Set Card Image
						$image = get_field('wpcc_image'); 
						$image_obj =  wp_get_attachment_image_src( $image, 'card_image' );

						// Card Image Styles
						$wpcc_card_output.= 'style="background: ' . get_field('wpcc_color') . ' url(' .  $image_obj[0] . ') no-repeat 50% 50%; background-size:cover;">';
					
					// Close Card Image DIV	
					$wpcc_card_output.= '</div>';


					// Card Overlay SPAN
					$wpcc_card_output.= '<span class="overlay" ';

					if(get_option( 'wpcc_tinting' ) == 1) { 
						$wpcc_card_output.= 'style="background-color: ' . get_field('wpcc_color') . '"';
					}
					$wpcc_card_output.= '></span>';

					// Card Details DIV
					$wpcc_card_output.= '<div class="cardDetails">';

						// Output Card Title		
						$wpcc_card_output.= '<h3 style="color: ' . get_field('wpcc_color') . '">' . $cardTitle . '</h3>';
						
						// Output Card Subtitle
						if($cardSubtitle){ 
							$wpcc_card_output.= '<p>' . $cardSubtitle . '</p>';
						} 

					// Close Card Details DIV 
					$wpcc_card_output.= '</div>';
				
				// Close Card List Body DIV
				$wpcc_card_output.= '</div>';
			
			// END Anchor			
			$wpcc_card_output.= '</a>';

			do_action('wpcc_after_card');

		// All other card types
		} else { 

			do_action('wpcc_before_card');

			// Card Link
			$wpcc_card_output.= '<a class="card ';

				// Card Link Classes
				ob_start();
				do_action('wpcc_card_link_classes'); 
				$link_classes = ob_get_contents();
				ob_end_clean();
				$wpcc_card_output.= $link_classes;

				// Card Link Href
				$wpcc_card_output.= '" href="' . $card_link . '" ';
							
				// Card Link Tab Index
				$wpcc_card_output.= 'tabindex="-1" ';

				// Card Link Target
				if(get_field("wppc_external_new_window") == '1'){ 
					$wpcc_card_output.= 'target="_blank" ';
				}

				//Action to add additional attributes to the anchor
				ob_start();
				do_action('wpcc_card_link_attr'); 
				$link_attrs = ob_get_contents();
				ob_end_clean();
				$wpcc_card_output.= $link_attrs;

			$wpcc_card_output.= '>';


				// Card List Body DIV
				$wpcc_card_output.= '<div class="cardBody">';

				
					// Card Top Section
					$wpcc_card_output.= '<div class="topSection" style="background: url(';
					$image = get_field('wpcc_image'); 
					$image_obj =  wp_get_attachment_image_src( $image, 'card_image' ); 
					$wpcc_card_output.=  $image_obj[0] . ') no-repeat 50% 50%; background-size:cover;">';
					$wpcc_card_output.= '</div>';
							
					
					// Card Overlay SPAN
					$wpcc_card_output.= '<span class="overlay" ';

					if(get_option( 'wpcc_tinting' ) == 1) { 
						$wpcc_card_output.= 'style="background-color: ' . get_field('wpcc_color') . '"';
					}
					$wpcc_card_output.= '></span>';

					// Card Bottom Section.
					$wpcc_card_output.= '<div class="bottomSection">';

						$wpcc_card_output.= '<div class="intro">';
							
							// Output Card Title		
							$wpcc_card_output.= '<h3 style="color: ' . get_field('wpcc_color') . '">' . $cardTitle . '</h3>';

							// Output Card Subtitle
							if($cardSubtitle){ 
								$wpcc_card_output.= '<p>' . $cardSubtitle . '</p>';
							}

						$wpcc_card_output.= '</div>';
					$wpcc_card_output.= '</div>';
				$wpcc_card_output.= '</div>';

			$wpcc_card_output.= '</a>';

			do_action('wpcc_after_card'); 

		} 

	} 
} 

wp_reset_query();

$wpcc_card_output.= '</div>';
$wpcc_card_output.= '</div></div>';

return $wpcc_card_output;

}
