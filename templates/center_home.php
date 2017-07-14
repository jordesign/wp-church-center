<?php
/*
 * Template Name: Church Center Homepage
 * Description: The full list of Church Center cards
 */


/**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'header.php'; ?>

<div class="cardHolder <?php if ( isset($_GET["layout"]) ) { 
		echo $_GET["layout"];
	} elseif ( $layout = get_option( 'wpcc_layout' ) ) {
		echo $layout;
	} else {
		echo 'list';
	}  ?>">
<div class="cards <?php if(get_option( 'wpcc_greyscale' ) == 1) { echo 'greyscale'; } ?>">

	<?php

	$wpcc_query = new WP_Query( array (
                    'post_type' => 'card', 
                    'posts_per_page' => -1
     ) );

	
	if ( $wpcc_query -> have_posts() ) {
		while ( $wpcc_query -> have_posts() ) {
			$wpcc_query -> the_post();  ?>
			
				<?php if ( isset($_GET["layout"]) ) {
						$layout = $_GET["layout"];
					}
					if ( get_option( 'wpcc_layout' ) == 'list' && $layout !='grid' && $layout !='card' ) { ?>

					<a class="card" href="<?php the_permalink(); ?>" style="background-color: <?php the_field('wpcc_color'); ?>">
						<div class="cardBody">
							<h3><?php the_title(); ?></h3>
							<p><?php the_field('wpcc_subtitle'); ?></p>
						</div>
						<i class="fa fa-angle-circled-right" style="color: <?php the_field('wpcc_color'); ?>"></i>
					</a>

				<?php } elseif ( $layout=='list' ) { ?>
					<a class="card" href="<?php the_permalink(); ?>" style="background-color: <?php the_field('wpcc_color'); ?>">
						<div class="cardBody">
							<h3><?php the_title(); ?></h3>
							<p><?php the_field('wpcc_subtitle'); ?></p>
						</div>
						<i class="fa fa-angle-circled-right" style="color: <?php the_field('wpcc_color'); ?>"></i>
					</a>
				<?php } else { ?>
					<a class="card" href="<?php the_permalink(); ?>" tabindex="-1">
						<div class="cardBody">
							<div class="topSection" style="background: url(<?php $image = get_field('wpcc_image'); $image_obj =  wp_get_attachment_image_src( $image, 'card_image' ); echo $image_obj[0]; ?>) no-repeat 50% 50%; background-size:cover;">
								
							</div>
							<span class="overlay" style="background-color: <?php the_field('wpcc_color'); ?>"></span>
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
	} 
	wp_reset_query();
	?>
</div>
</div>


<?php /**  Load Footer */
require_once plugin_dir_path( __FILE__ ) . 'footer.php'; ?>