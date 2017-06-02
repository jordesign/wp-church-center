<?php

/* Single Page for WP Church Hub  */


/**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'header.php'; ?>


<div class="singleCard">

	<?php 
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();  ?>

			<div class="cardContent">

				<div class="cardHeader">
					<div class="cardImage <?php if(get_option( 'wpch_greyscale' ) == 1) { echo 'greyscale'; } ?>" style="background: url(<?php $image = get_field('wpch_image'); echo wp_get_attachment_image_src( $image, 'card_hero_image' )[0];?>) no-repeat 50% 50%; background-size:cover;"></div>
					<span class="overlay" style="background-color: <?php the_field('wpch_color'); ?>"></span>

					
					
					<a class="backButton" href="<?php wpch_get_home_hub_link(); ?>"><i class="fa fa-angle-circled-right"></i><span> Back</span></a>

				</div>
			
				
				<div class="cardInfo" >
					<div class="cardTitle">
						<h1 style="color: <?php the_field('wpch_color'); ?>"><?php the_title(); ?></h1>
						<p><?php the_field('wpch_subtitle'); ?></p>
					</div>

					<?php the_field('wpch_content'); ?>		
				
			</div>
					

		<?php } 
	} 
	?>



</div>


<?php /**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'footer.php'; ?>