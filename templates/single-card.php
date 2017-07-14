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
					<span class="overlay" style="background-color: <?php echo get_post_meta(get_the_ID(),'wpcc_color',true); ?>"></span>

					
					
					<a class="backButton" href="<?php wpcc_get_home_center_link(); ?>"><i class="fa fa-angle-circled-right"></i><span> Back</span></a>

				</div>
			
				
				<div class="cardInfo" >
					<div class="cardTitle">
						
						<h1 style="color: <?php echo get_post_meta(get_the_ID(),'wpcc_color',true); ?>"><?php echo get_the_title(); ?></h1>
						<p><?php echo get_post_meta(get_the_ID(get_the_ID()),'wpcc_subtitle',true); ?></p>
					</div>

					<?php $content = get_post_meta(get_the_ID(),'wpcc_content',true); 
					echo apply_filters( 'the_content', $content ); ?>
	
				
			</div>
					

		<?php } 
	} 
	?>

</div>

</div>


<?php /**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'footer.php'; ?>