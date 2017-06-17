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
					<div class="cardImage <?php if(get_option( 'wpcc_greyscale' ) == 1) { echo 'greyscale'; } ?>" style="background: url(<?php $image = get_field('wpcc_image'); echo wp_get_attachment_image_src( $image, 'card_hero_image' )[0];?>) no-repeat 50% 50%; background-size:cover;"></div>
					<span class="overlay" style="background-color: <?php the_field('wpcc_color'); ?>"></span>

					
					
					<a class="backButton" href="<?php echo wpcc_get_home_center_link(); ?>"><i class="fa fa-angle-circled-right"></i><span> Back</span></a>

				</div>
			
				
				<div class="cardInfo" >
					<div class="cardTitle">
						<h1 style="color: <?php the_field('wpcc_color'); ?>"><?php the_title(); ?></h1>
						<p><?php the_field('wpcc_subtitle'); ?></p>
					</div>

					<?php the_field('wpcc_content'); ?>
	
				
			</div>
					

		<?php } 
	} 
	?>

</div>

</div>


<?php /**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'footer.php'; ?>