<?php
    //Redirceting 'In the Media' pages 
    if ( is_singular('card') && get_field('wpcc_card_type') === 'external' ){
        $redirectLocation = get_field('wpcc_external_url');
        header( 'Location:' . esc_url($redirectLocation) ) ;
    }

?><?php

/* Header for WP Church Center Pages */
?>

<!DOCTYPE html> 
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" class="wpchurch_center">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">

    <?php if ( is_singular('card') ) { ?>
        <title><?php the_title();?> | <?php echo esc_html(get_option( 'wpcc_church_name' ) ); ?></title>
    <?php }else{ ?>
        <title><?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?></title>
    <?php } ?>

    
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php //Set up title and description to be filterable
    if ( is_singular('card' ) ) {
        
        $singleCardTitle = get_the_title();
        if(has_filter('wpcc_card_seo_title')) {
                        
            $singleCardTitle = apply_filters('wpcc_card_seo_title', $singleCardTitle);
            
        }

        $singleCardDescription = get_field('wpcc_subtitle');
        if(has_filter('wpcc_card_seo_description')) {
                        
            $singleCardDescription = apply_filters('wpcc_card_seo_description', $singleCardDescription);
            
        }
    }  ?>  

    <!-- Meta Tags if YOAST SEO is not enabled -->
    <?php if ( !active( 'wordpress-seo/wp-seo.php' ) ) { ?>
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="website">
        <?php if ( is_singular('card') ) { ?>
            <meta property="og:title" content="<?php echo $singleCardTitle;?> | <?php echo esc_html(get_option( 'wpcc_church_name' ) ); ?>">
        <?php } else { ?>
            <meta property="og:title" content="<?php echo esc_html(get_option( 'wpcc_church_name' ) ); ?>">
        <?php } ?>

        <?php if ( is_singular('card' ) ) { ?>
            <meta property="og:description" content="<?php echo $singleCardDescription; ?>">
            <meta name="twitter:description" content="<?php echo $singleCardDescription; ?>">
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
            <meta property="og:image" content="<?php $image = get_field('wpcc_image'); $image_obj = wp_get_attachment_image_src( $image, 'card_hero_image' ); echo $image_obj[0];?>">
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
                        <meta property="og:image" content="<?php $image = get_field('wpcc_image'); $image_obj = wp_get_attachment_image_src( $image, 'card_image' ); echo $image_obj[0]; ?> ">
                    <?php } 
                } 
                wp_reset_query();
            }
               
         } ?>

        <meta name="twitter:card" content="summary">
        

        <?php if ( is_singular('card') ) { ?>
            <meta name="twitter:title" content="<?php echo $singleCardTitle;?> | <?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?>">
        <?php } else { ?>
            <meta name="twitter:title" content="<?php echo esc_html( get_option( 'wpcc_church_name' ) ); ?>">
        <?php } ?>
        <meta name="twitter:image" content="<?php $image = get_field('wpcc_image'); $image_obj =  wp_get_attachment_image_src( $image, 'card_hero_image' );?>">
    <?php } ?>

    <?php // Add Favicon if it is set
    if( $center_favicon = get_option( 'wpcc_favicon' )) { ?>
                <link rel="shortcut icon" type="image/png" href="<?php echo $center_favicon; ?>">
    <?php } ?>


    <!-- Include the CDN version of FontAwesome -->
    <script src="https://use.fontawesome.com/3be0bee871.js"></script>

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

         body .wpccHeader #menu ul li a i {
             background: <?php echo get_option( 'wpcc_icon_background' ); ?>;
             color: <?php echo get_option( 'wpcc_icon_color' ); ?>
         }
         

         .post-type-archive-card .wpccFooter.grid, .wpccFooter {
             background:<?php echo get_option( 'wpcc_footer_background' ); ?>;
         }

         .post-type-archive-card .wpccFooter.grid p, .wpccFooter p {
             color: <?php echo get_option( 'wpcc_footer_text' ); ?>;
         }

         .cardHolder.small-card .card .cardBody {
             border-radius: <?php echo get_option( 'wpcc_corner_radius' ); ?>;
         }

         .cardHolder.small-card .card .cardImage,
         .cardHolder.small-card .card  .overlay {
             border-top-left-radius: <?php echo get_option( 'wpcc_corner_radius' ); ?>;
             border-bottom-left-radius: <?php echo get_option( 'wpcc_corner_radius' ); ?>;
         }


         @media only screen and (min-width: 900px) {
            .wpccHeader #menu ul li a i,
            .backButton, .backButton:hover {
             color: <?php echo get_option( 'wpcc_background' ); ?>;
             
             }

             body .wpccHeader #menu ul.circle-outline li a i,
             body .wpccHeader #menu ul.plain li a i {
                 color:<?php echo get_option( 'wpcc_icon_color' ); ?> !important;
                 border-color:<?php echo get_option( 'wpcc_icon_color' ); ?>;
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

<div class="wpccHeader <?php if ( isset($layout) ) { 
        echo $layout;
    } elseif ($layout = get_option( 'wpcc_layout' ) ) {
        echo $layout;
    } else {
        echo 'list';
    }
    echo ' ' . get_option('wpcc_header_layout');  ?>

    <?php if( defined('WPCC_LAYOUT_SWITCHING') && WPCC_LAYOUT_SWITCHING ===  true){ echo 'layoutSwitcher'; }  ?>">

    <?php if ($customHomeLink = get_option('wpcc_logo_link') ){ ?>
		<a href="<?php echo $customHomeLink; ?>" style="background-image:url('<?php echo esc_html( get_option( 'wpcc_church_logo' ) ); ?>');">
			<span><?php echo esc_html( get_option( 'blogname' ) ); ?></span>
		</a>
    <?php }else{ ?>
		<a href="<?php wpcc_get_home_center_link(); ?>" style="background-image:url('<?php echo esc_html( get_option( 'wpcc_church_logo' ) ); ?>');">
			<span><?php echo esc_html( get_option( 'blogname' ) ); ?></span>
		</a>
    <?php } ?>

	

        <div id="menu" class="columns large-9 wpccMenu">

        		<!-- Social Icons -->
        		<ul class="socialMenu <?php echo esc_html( get_option('wpcc_icon_style') ); ?>">

        			<?php if ( $churchLink = esc_url( get_option( 'wpcc_church_url' ) ) ) { ?>
					   <li><a href="<?php echo $churchLink; ?>"><i class="fa fa-home"></i><span>
                        <?php if($church_website_name = esc_html( get_option( 'wpcc_church_url_title' ) ) ){
                            echo $church_website_name;
                        }else{
                            echo 'Main Church Website';
                        } ?>
                            </span></a></li>
        			<?php } ?>


        			<?php if ( $facebookLink = esc_url( get_option( 'wpcc_facebook' ) ) ) { ?>
					   <li><a href="<?php echo $facebookLink; ?>" title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
        			<?php } ?>

        			<?php if ( $twitterLink = esc_url( get_option( 'wpcc_twitter' ) ) ) { ?>
					   <li><a href="<?php echo $twitterLink; ?>" title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
        			<?php } ?>

        			<?php if ( $instaLink = esc_url( get_option( 'wpcc_instagram' ) ) ) { ?>
					   <li><a href="<?php echo $instaLink; ?>" title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a></li>
        			<?php } ?>

        			<?php if ( $snapchatLink = esc_url( get_option( 'wpcc_snapchat' ) ) ) { ?>
					   <li><a href="<?php echo $snapchatLink; ?>" title="Snapchat"><i class="fa fa-snapchat-ghost"></i><span>Snapchat</span></a></li>
        			<?php } ?>

        			<?php if ( $vimeoLink = esc_url( get_option( 'wpcc_vimeo' ) ) ){ ?>
					   <li><a href="<?php echo $vimeoLink; ?>" title="Vimeo"><i class="fa fa-vimeo"></i><span>Vimeo</span></a></li>
        			<?php } ?>

        			<?php if ( $youtubeLink = esc_url( get_option( 'wpcc_youtube' ) ) ) { ?>
					   <li><a href="<?php echo $youtubeLink; ?>" title="Youtube"><i class="fa fa-youtube-play"></i><span>Youtube</span></a></li>
        			<?php } ?>

        			<?php if ( $givingLink = esc_url( get_option( 'wpcc_giving' ) ) ) { ?>
					   <li><a href="<?php echo $givingLink; ?>" title="Online Giving"><i class="fa fa-money"></i><span>Online Giving</span></a></li>
        			<?php } ?> 

                     <?php if ( $livestreamLink = esc_url( get_option( 'wpcc_online_church' ) ) ) { ?>
                       <li><a href="<?php echo $livestreamLink; ?>" title="Livestream"><i class="fa fa-tv"></i><span>Livestream</span></a></li>
                    <?php } ?>

                    <?php if ( $membersLink = esc_url( get_option( 'wpcc_members' ) ) ) { ?>
                       <li><a href="<?php echo $membersLink; ?>" title="Members Login"><i class="fa fa-vcard"></i><span>Members Login</span></a></li>
                    <?php } ?>

        		</ul>

            <!-- Close Menu -->
            <a href="#" class="closeMenu">
                <i class="fa fa-close"></i>
                <span>Close Menu</span>
            </a>  
        </div>

        <?php if( $churchLink || $facebookLink || $twitterLink || $instaLink || $snapchatLink || $vimeoLink || $youtubeLink || $givingLink){ ?>

            <a href="#menu" aria-controls="menu" class="menuLink" tabindex="2">
              <i class="fa fa-bars"></i><span>Menu</span>
            </a>
        <?php } ?>

    </div>
