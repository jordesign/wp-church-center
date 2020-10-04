<?php

define( 'wpcc_PLUGIN_PATH', dirname(__FILE__) );

//Use Filters to direct the 'card' CPT to use the templates in our plugin
add_filter( 'single_template' , 'wpcc_single_template', 20 );
add_filter( 'archive_template' , 'wpcc_archive_template' );
add_filter( 'taxonomy_template' , 'wpcc_taxonomy_archive_template' );

//route single-template
function wpcc_single_template( $single_template ){
  global $post;
  $found = locate_template('single-card.php', false) ;
  if( $post->post_type == 'card' && $found == '' ){
    $single_template = wpcc_PLUGIN_PATH .'/templates/single-card.php';
  }
  return $single_template;
}

//route taxonomy-archive-template
function wpcc_taxonomy_archive_template( $template ){
  if( is_tax('card_group') ){
    $theme_files = array('archive-card.php','taxonomy-card_group.php')  ;
    $exists_in_theme = locate_template($theme_files, false);
    if( $exists_in_theme == '' ){
      return wpcc_PLUGIN_PATH . '/templates/archive-card.php';
    }
  }
  return $template;
}

//route archive-template
function wpcc_archive_template( $template ){
  if( is_post_type_archive('card') ){
    $theme_files = array('archive-card.php')  ;
    $exists_in_theme = locate_template($theme_files, false);
    if( $exists_in_theme == '' ){
      return wpcc_PLUGIN_PATH . '/templates/archive-card.php';
    }
  }
  return $template;
}




// De-Queue all Stylesheets
function wpcc_remove_default_styles (){

	if ( get_post_type() == 'card' || is_post_type_archive('card') || is_page_template('center_home.php') ){
		// get all styles data
		global $wp_styles;

		$keep_styles = array(
		   'admin-bar',  //Always show the admin bar
		   'nf-display',  //Ninja Forms
		   'wp-mediaelement' //MediaElement
		);

		// loop over all of the registered scripts
		foreach ( $wp_styles->registered as $handle => $data )
		{
			if( !in_array ($handle, $keep_styles ) ){
				// remove it
				wp_deregister_style($handle);
				wp_dequeue_style($handle);
			}
		}

	}
}

if( 1 == get_option( 'wpcc_disable_styles' ) && !is_admin() ){
	add_action('wp_print_scripts', 'wpcc_remove_default_styles', 100);

}

// De-Queue all Scripts
function wpcc_remove_default_scripts (){

	if (  get_post_type() == 'card' || is_post_type_archive('card') || is_page_template('center_home.php' ) ){

		// get all styles data
		global $wp_scripts;

		$keep_scripts = array(
		   'wpcc-scripts',
		   'jquery' ,
		   'nf-front-end-deps' , 	
		   'nf-front-end' , 	
		   'admin-bar' ,
		   'masonry',
		   'wp-mediaelement',
		   'wpcc-tithely-giving',
		   'wpcc-pco-giving',
		   
		);

		// loop over all of the registered scripts
		foreach ( $wp_scripts->registered as $handle => $data )
		{

			if( !in_array ($handle, $keep_scripts ) ){
				// remove it
				//wp_deregister_script($handle);
				wp_dequeue_script($handle);
			}
		}

	}
}
if( 1 == get_option( 'wpcc_disable_scripts' )  && !is_admin() ){
	add_action('wp_print_scripts', 'wpcc_remove_default_scripts', 100);
}

//Now enqueue styles we want 
function wpcc_add_styles() {
	global $post;
	if( is_singular( 'card' )  || is_post_type_archive('card') || get_page_template_slug( get_the_ID() ) =='center_home.php' || is_tax('card_group') || has_shortcode( $post->post_content, 'wpcc') ){
		wp_enqueue_style( 'wpcc-style', plugins_url( '/templates/wpcc_style.1.3.css', __FILE__  ) );
		//if( get_option('wpcc_scroll_direction') =='horizontal' ) {
			wp_enqueue_script( 'wpcc-scripts', plugins_url( '/templates/wpcc_script.1.3-min.js', __FILE__ ), array( 'jquery' ) );
		//}
		if( get_option('wpcc_layout') =='small-card' ) {
			// Pull Masonry from the core of WordPress
			wp_enqueue_script( 'masonry' );
		}
		
	}
}
add_action('wp_enqueue_scripts', 'wpcc_add_styles', 1000);

//Image Sizes
add_image_size( 'card_image', 600, 1200, false );
add_image_size( 'card_hero_image', 1200, 1200, false );

//remove automated WP title 
add_action('template_redirect', 'wpcc_remove_title');
function wpcc_remove_title()
{
    if ( get_post_type() == 'card' || is_post_type_archive('card') || is_page_template('center_home.php' ) ){
		remove_action( 'wp_head', '_wp_render_title_tag', 1 );
	}
}


//Definitely Hide admin bar when not logged in
add_filter( 'show_admin_bar', 'wpct_hide_adminbar' );
function wpct_hide_adminbar($status){
    if( !is_user_logged_in() ){
        return false;
    }
    return $status;
}

//Function to check if certain plugins are active
function active( $plugin ) {
    $network_active = false;
    if ( is_multisite() ) {
        $plugins = get_site_option( 'active_sitewide_plugins' );
        if ( isset( $plugins[$plugin] ) ) {
            $network_active = true;
        }
    }
    return in_array( $plugin, get_option( 'active_plugins' ) ) || $network_active;
}

//Change sort order of post type archive
add_action( 'pre_get_posts', 'wpcc_sort_cards' );
function wpcc_sort_cards( $query ) {
    if ( $query->is_main_query() && !is_admin() ) {
        if (  $query->is_post_type_archive('card') ) {
            $query->set('orderby', 'menu_order');  
            $query->set('order', 'ASC'); 
        }       
    }
} 

// Don't show unlisted cards in Archive/Category queries
add_action( 'pre_get_posts', 'wpcc_exclude_unlisted_cards' );
function wpcc_exclude_unlisted_cards( $query ) {
    if ( $query->is_main_query() && !is_admin() ) {
        if (  $query->is_post_type_archive('card') ) {
	        // in case for some reason there's already a meta query set from other plugin
	        $meta_query = $query->get('meta_query')? : [];

	        // append yours
	        $meta_query[] = [
	        'relation' => 'OR',
	        array(
  			'key' => 'wpcc_unlisted',
	          'compare' => 'NOT EXISTS'
	        ),
	        array(
  			'key' => 'wpcc_unlisted',
  			'value' => '0',
	          'compare' => '==',
	        ),

	            
	        ];

	        $query->set('meta_query', $meta_query);

	      	//echo '<pre>'; print_r( $query ); echo '</pre>';

	    }
	}
}


//Add an extra class for theming
/**
 * Adds classes to the array of body classes.
 *
 * @uses body_class() filter
 */
function wpcc_body_classes( $classes ) {
     
    $classes[] = 'wpcc_' . get_option('wpcc_theme');   
     
    return $classes;
}
add_filter( 'body_class', 'wpcc_body_classes' );

//Include editor.min.css even if there is no text editor
function wpcc_add_admin_editor_styles() {
    wp_register_style($handle = 'wpcc-theme-admin-styles', $src = site_url() . '/wp-includes/css/editor.min.css', $deps = array(), $ver = '1.0.0', $media = 'all');
    wp_enqueue_style('wpcc-theme-admin-styles');}
    add_action('admin_print_styles', 'wpcc_add_admin_editor_styles');