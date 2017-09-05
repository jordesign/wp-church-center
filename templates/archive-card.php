<?php

/* Archive for WP Church Center  */

/**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'header.php'; ?>

<div class="cardHolder 
	<?php if( isset($_GET["layout"]) ) { 
		echo esc_html( $_GET["layout"] );
	} elseif ( $layout = get_option( 'wpcc_layout' ) ){
		echo esc_html( $layout );
	} else {
		echo 'list';
	}  ?>

	<?php if( defined( 'WPCC_LAYOUT_SWITCHING') && WPCC_LAYOUT_SWITCHING  ===  1){ echo 'layoutSwitching'; } ?>">

	<div class="cards <?php if(get_option( 'wpcc_greyscale' ) == 1) { echo 'greyscale '; } if(get_option( 'wpcc_tinting ' ) == 1) { echo 'tint '; } if(get_option( 'wpcc_layout' ) == 'small-card') { echo 'js-masonry ' . get_option('wpcc_small_card_columns'); } ?>">

	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();  ?>

				<?php //set up the link for the card
					if(get_field("wpcc_card_type") === 'external'){
						$card_link = esc_url(get_field('wpcc_external_url') );
					}else{
						$card_link = get_permalink($post->ID);
					} ?>
			
				<?php if ( isset($_GET["layout"]) ) {
						$layout = esc_html( $_GET["layout"] );
					}
					if ( get_option( 'wpcc_layout' ) == 'list' && $layout !='grid' && $layout !='card' && $layout != 'small-card' ) { ?>

					<a class="card" href="<?php echo $card_link; ?>" style="background-color: <?php the_field('wpcc_color'); ?>" <?php if(get_field("wppc_external_new_window") == '1'){ echo 'target="_blank"';} ?>>
						<div class="cardBody">
							<h3><?php the_title(); ?></h3>
							<p><?php the_field('wpcc_subtitle'); ?></p>
						</div>
						<i class="fa fa-angle-circled-right" style="color: <?php the_field('wpcc_color'); ?>"></i>
					</a>

				<?php } elseif ( $layout=='list' && $layout != 'small-card' ) { ?>
					<a class="card" href="<?php echo $card_link; ?>" style="background-color: <?php the_field('wpcc_color'); ?>" <?php if(get_field("wppc_external_new_window") == '1'){ echo 'target="_blank"';} ?>>
						<div class="cardBody">
							<h3><?php the_title(); ?></h3>
							<p><?php the_field('wpcc_subtitle'); ?></p>
						</div>
						<i class="fa fa-angle-circled-right" style="color: <?php the_field('wpcc_color'); ?>"></i>
					</a>
				<?php } elseif ( $layout=='small-card'  ) { ?>
					<a class="card item" href="<?php echo $card_link; ?>" <?php if(get_field("wppc_external_new_window") == '1'){ echo 'target="_blank"';} ?>>
						<div class="cardBody">
							<div class="cardImage" style="background: <?php the_field('wpcc_color'); ?> url(<?php $image = get_field('wpcc_image'); $image_obj =  wp_get_attachment_image_src( $image, 'card_image' ); echo $image_obj[0]; ?>) no-repeat 50% 50%; background-size:cover;">
								
							</div>
							<span class="overlay" <?php if(get_option( 'wpcc_tinting' ) == 1) { ?>style="background-color: <?php the_field('wpcc_color'); ?>"<?php } ?>></span>
							<div class="cardDetails">
								<h3 style="color: <?php the_field('wpcc_color'); ?>"><?php the_title(); ?></h3>
								<p><?php the_field('wpcc_subtitle'); ?></p>
							</div>
						</div>
						
					</a>
				<?php } else { ?>
					<a class="card" href="<?php echo $card_link; ?>" tabindex="-1" <?php if(get_field("wppc_external_new_window") == '1'){ echo 'target="_blank"';} ?>>
						<div class="cardBody">
							<div class="topSection" style="background: url(<?php $image = get_field('wpcc_image'); $image_obj =  wp_get_attachment_image_src( $image, 'card_image' ); echo $image_obj[0]; ?>) no-repeat 50% 50%; background-size:cover;">
								
							</div>
							
								<span class="overlay" <?php if(get_option( 'wpcc_tinting' ) == 1) { ?>style="background-color: <?php the_field('wpcc_color'); ?>"<?php } ?>></span>
							
							<div class="bottomSection">
								<div class="intro">
									<h3 style="color: <?php the_field('wpcc_color'); ?>"><?php the_title(); ?></h3>
									<p><?php the_field('wpcc_subtitle'); ?></p>
								</div>
							</div>
						</div>
					</a>
				<?php } ?>

		<?php } 
	} ?>

</div>
</div>


<?php /**  Load Footer */
require_once plugin_dir_path( __FILE__ ) . 'footer.php'; ?>