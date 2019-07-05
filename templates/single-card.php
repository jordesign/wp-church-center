<?php

/* Single Page for WPChurch Center  */


/**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'header.php'; ?>


<div class="singleCard">

	<?php 
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();  ?>

			<div class="cardContent">

				<div class="cardHeader">
					<div class="cardImage <?php if(get_option( 'wpcc_greyscale' ) == 1) { echo 'greyscale'; } ?>" style="background: url(<?php $image = get_field('wpcc_image'); $image_obj = wp_get_attachment_image_src( $image, 'card_hero_image' ); echo $image_obj[0];?>) no-repeat 50% 50%; background-size:cover;"></div>
					<?php if(get_option( 'wpcc_tinting' ) == 1) { ?>
						<span class="overlay" style="background-color: <?php echo get_post_meta(get_the_ID(),'wpcc_color',true); ?>"></span>
					<?php } ?>

					
					
					<a class="backButton" href="<?php wpcc_get_home_center_link(); ?>"><i class="fa  fa-arrow-circle-o-left"></i><span> Back</span></a>

				</div>
			
				
				<div class="cardInfo" >
					<div class="cardTitle">

						<?php //set up title with a filter so we can change it with addons

						$cardTitle = '<h1 style="color:' .  get_post_meta(get_the_ID(),'wpcc_color',true) . ';">';
						$cardTitle .= get_the_title();
						$cardTitle .= '</h1>';

						if(has_filter('wpcc_card_title')) {
						
							$cardTitle = apply_filters('wpcc_card_title', $cardTitle);
							
						}  

						echo $cardTitle;
						?>

						<?php //set up the subtitle with a filter so we can change it with addons
						$cardSubtitle = '<p>' . get_post_meta(get_the_ID(get_the_ID()),'wpcc_subtitle',true) . '</p>';
						if(has_filter('wpcc_card_subtitle')) {
						
							$cardSubtitle = apply_filters('wpcc_card_subtitle', $cardSubtitle);
							
						}  ?>

						<?php echo $cardSubtitle ?>
					</div>

					<?php //set up the content so we can filter it with any addons
					$cardContent =  get_field('wpcc_content', get_the_ID() );

					if(has_filter('wpcc_card_content')) {
						
						$cardContent = apply_filters('wpcc_card_content', $cardContent);
							
					}
					if ( ! post_password_required() ) {
						echo $cardContent;

					}
					//include this so password protected stuff works
					echo '<div class="passwordBlock">';
					the_content(); 
					echo '</div>';

					?>
	
				
			</div>
					

		<?php } 
	} 
	?>

</div>

</div>


<?php /**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'footer.php';