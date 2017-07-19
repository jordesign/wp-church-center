<?php

/* Header for WP Church Center Pages */
?>

<!DOCTYPE html> 
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">

    <?php if ( is_singular('card') ) { ?>
        <title><?php the_title();?> | <?php echo esc_html(get_option( 'wpcc_church_name' ) ); ?></title>
    <?php }else{ ?>
        <title><?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?></title>
    <?php } ?>

    
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta Tags if YOAST SEO is not enabled -->
    <?php if ( !active( 'wordpress-seo/wp-seo.php' ) ) { ?>
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="website">
        <?php if ( is_singular('card') ) { ?>
            <meta property="og:title" content="<?php the_title();?> | <?php echo esc_html(get_option( 'wpcc_church_name' ) ); ?>">
        <?php } else { ?>
            <meta property="og:title" content="<?php echo esc_html(get_option( 'wpcc_church_name' ) ); ?>">
        <?php } ?>

        <?php if ( is_singular('card' ) ) { ?>
            <meta property="og:description" content="<?php the_field('wpcc_subtitle'); ?>">
            <meta name="twitter:description" content="<?php the_field('wpcc_subtitle'); ?>">
        <?php } else { ?>
            <meta property="og:description" content="<?php echo esc_html(get_option( 'wpcc_center_description' ) ); ?>">
            <meta name="twitter:description" content="<?php echo esc_html(get_option( 'wpcc_center_description' ) ); ?>">
        <?php } ?>
        
        <?php if ( is_singular('card' ) ) { ?>
            <meta property="og:url" content="<?php the_permalink(); ?>">
        <?php }else{ ?>
            <meta property="og:url" content="<?php wpcc_get_home_center_link(); ?>">
        <?php } ?>

        <meta property="og:site_name" content="<?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?>">

        <?php if ( is_singular('card' ) ) { ?>
            <meta property="og:image" content="<?php $image = get_field('wpcc_image'); echo wp_get_attachment_image_src( $image, 'card_hero_image' )[0];?>">
        <?php }else{ 
            if( $center_home_image = get_option( 'wpcc_center_image' )) { ?>
                <meta property="og:image" content="<?php echo esc_html($center_home_image); ?>">
            <?php }else{
                $wpcc_query = new WP_Query( array (
                    'post_type' => 'card', 
                    'posts_per_page' => 1
                ) );

                if ( $wpcc_query -> have_posts() ) {
                    while ( $wpcc_query -> have_posts() ) {
                        $wpcc_query -> the_post();  ?>
                        <meta property="og:image" content="<?php $image = get_field('wpcc_image'); echo wp_get_attachment_image_src( $image, 'card_image' )[0]; ?> ">
                    <?php } 
                } 
                wp_reset_query();
            }
               
         } ?>

        <meta name="twitter:card" content="summary">
        

        <?php if ( is_singular('card') ) { ?>
            <meta name="twitter:title" content="<?php the_title();?> | <?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?>">
        <?php } else { ?>
            <meta name="twitter:title" content="<?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?>">
        <?php } ?>
        <meta name="twitter:image" content="<?php $image = get_field('wpcc_image'); echo wp_get_attachment_image_src( $image, 'card_hero_image' )[0];?>">
    <?php } ?>

    <!-- The mountain of stuff WP puts in -->
    <?php wp_head(); ?>

    <style>
    	 body.wpchurch_center{
    	 	background: <?php echo get_option( 'wpcc_background' ); ?> !important;
    	 }
         #menu ul li a i {
             background: <?php echo get_option( 'wpcc_background' ); ?>;
         } 

         .cardInfo h2, .cardInfo h3, .cardInfo h4, .cardInfo h5, .cardInfo h6, .cardInfo a {
             color: <?php echo get_post_meta(get_the_ID(),'wpcc_color',true ); ?>;
         }

         body .header #menu ul li a i {
             background: <?php echo get_option( 'wpcc_icon_background' ); ?>;
             color: <?php echo get_option( 'wpcc_icon_color' ); ?>
         }
         body .header #menu ul.circle-outline li a i,
         body .header #menu ul.plain li a i {
             color:<?php echo get_option( 'wpcc_icon_color' ); ?> !important;
             border-color:<?php echo get_option( 'wpcc_icon_color' ); ?>;
         }

         .post-type-archive-card .footer.grid, .footer {
             background:<?php echo get_option( 'wpcc_footer_background' ); ?>;
         }

         .post-type-archive-card .footer.grid p, .footer p {
             color: <?php echo get_option( 'wpcc_footer_text' ); ?>;
         }

         .cardHolder.small-card .card .cardBody {
             border-radius: <?php echo get_option( 'wpcc_corner_radius' ); ?>;
         }

         .cardHolder.small-card .card .cardImage {
             border-top-left-radius: <?php echo get_option( 'wpcc_corner_radius' ); ?>;
             border-bottom-left-radius: <?php echo get_option( 'wpcc_corner_radius' ); ?>;
         }


         @media only screen and (min-width: 900px) {
            .header #menu ul li a i,
            .backButton, .backButton:hover {
             color: <?php echo get_option( 'wpcc_background' ); ?>;
         }
        }
    	</style>

</head>


<body <?php body_class( 'wpchurch_center nojs ' . get_option('wpcc_header_layout') ) ?>>
 
<?php if (defined('WPCC_LAYOUT_SWITCHING') && WPCC_LAYOUT_SWITCHING ===  true ){ 
    if (is_post_type_archive('card') || get_page_template_slug( get_the_ID() ) ){

        if( isset($_GET["layout"]) ) { 
            $layout = esc_html( $_GET["layout"] );
        } ?>

        <div class="wppc_layout_switcher">
            <p>
                <span>Switch layout</span>
                <a href="?layout=grid" class="<?php if ('grid' == get_option('wpcc_layout') && $layout == false || 'grid' == $layout ){ echo 'active'; } ?>">
                    Grid
                </a>
                <a href="?layout=list" class="<?php if ('list' == get_option('wpcc_layout') && $layout == false || 'list' == $layout ){ echo 'active'; } ?>">    
                    List
                </a>
                <a href="?layout=small-card" class="<?php if ('small-card' == get_option('wpcc_layout') && $layout == false || 'small-card' == $layout ){ echo 'active'; } ?>">
                    Small Card
                </a>
                <a href="?layout=card" class="<?php if ('card' == get_option('wpcc_layout') && $layout == false || 'card' == $layout ){ echo 'active'; } ?>">
                    Card
                </a>
                <a href="https://wordpress.org/plugins/wp-church-center/" class="downloadLink" target="_blank">Download Plugin</a>
            </p>
        </div>

        <?php } 
     }?>


<div class="wrapper <?php if( defined( 'WPCC_LAYOUT_SWITCHING') && WPCC_LAYOUT_SWITCHING  ===  true){ echo 'layoutSwitching'; } ?>">
<div class="skip-container">
    <a class="skip-link" tabindex="1" href="#main"><?php esc_html_e( '&darr; Skip to Main Content', 'wpcc' ); ?></a>
</div><!-- .skip-container -->

<div class="header <?php if ( isset($layout) ) { 
        echo $layout;
    } elseif ($layout = get_option( 'wpcc_layout' ) ) {
        echo $layout;
    } else {
        echo 'list';
    }
    echo ' ' . get_option('wpcc_header_layout');  ?>

    <?php if( defined('WPCC_LAYOUT_SWITCHING') && WPCC_LAYOUT_SWITCHING ===  true){ echo 'layoutSwitcher'; }  ?>">
	<a href="<?php wpcc_get_home_center_link(); ?>"><img src="<?php echo esc_html( get_option( 'wpcc_church_logo' ) ); ?>" alt="<?php echo esc_html( get_option( 'blogname' ) ); ?> Logo" id="logo"></a>

	<a href="#menu" aria-controls="menu" class="menuLink" tabindex="2">
	  <i class="fa-logo fa-menu"></i><span>Menu</span>
	</a>

        <div id="menu" class="columns large-9">

        		<!-- Social Icons -->
        		<ul class="socialMenu <?php echo esc_html( get_option('wpcc_icon_style') ); ?>">

        			<?php if ( $churchLink = esc_url( get_option( 'wpcc_church_url' ) ) ) { ?>
					   <li><a href="<?php echo $churchLink; ?>"><i class="fa-logo fa-home"></i><span><?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?> Website</span></a></li>
        			<?php } ?>


        			<?php if ( $facebookLink = esc_url( get_option( 'wpcc_facebook' ) ) ) { ?>
					   <li><a href="<?php echo $facebookLink; ?>" title="Facebook"><i class="fa-logo fa-facebook"></i><span>Facebook</span></a></li>
        			<?php } ?>

        			<?php if ( $twitterLink = esc_url( get_option( 'wpcc_twitter' ) ) ) { ?>
					   <li><a href="<?php echo $twitterLink; ?>" title="Twitter"><i class="fa-logo fa-twitter"></i><span>Twitter</span></a></li>
        			<?php } ?>

        			<?php if ( $instaLink = esc_url( get_option( 'wpcc_instagram' ) ) ) { ?>
					   <li><a href="<?php echo $instaLink; ?>" title="Instagram"><i class="fa-logo fa-instagram"></i><span>Instagram</span></a></li>
        			<?php } ?>

        			<?php if ( $snapchatLink = esc_url( get_option( 'wpcc_snapchat' ) ) ) { ?>
					   <li><a href="<?php echo $snapchatLink; ?>" title="Snapchat"><i class="fa-logo fa-snapchat-ghost"></i><span>Snapchat</span></a></li>
        			<?php } ?>

        			<?php if ( $vimeoLink = esc_url( get_option( 'wpcc_vimeo' ) ) ){ ?>
					   <li><a href="<?php echo $vimeoLink; ?>" title="Vimeo"><i class="fa-logo fa-vimeo"></i><span>Vimeo</span></a></li>
        			<?php } ?>

        			<?php if ( $youtubeLink = esc_url( get_option( 'wpcc_youtube' ) ) ) { ?>
					   <li><a href="<?php echo $youtubeLink; ?>" title="Youtube"><i class="fa-logo fa-youtube-play"></i><span>Youtube</span></a></li>
        			<?php } ?>

        			<?php if ( $givingLink = esc_url( get_option( 'wpcc_giving' ) ) ) { ?>
					   <li><a href="<?php echo $givingLink; ?>" title="Online Giving"><i class="fa-logo fa-money"></i><span>Online Giving</span></a></li>
        			<?php } ?>

        		</ul>

            <!-- Close Menu -->
            <a href="#" class="closeMenu">
                <i class="fa-logo fa-cancel"></i>
                <span>Close Menu</span>
            </a>  
        </div>
    </div>