<?php

define('wpcc_PLUGIN_PATH', dirname(__FILE__));

//Use Filters to direct the 'card' CPT to use the templates in our plugin
add_filter('single_template','wpcc_single_template');
add_filter('archive_template','wpcc_archive_template');

//route single- template
function wpcc_single_template($single_template){
  global $post;
  $found = locate_template('single-card.php', false);
  if($post->post_type == 'card' && $found == ''){
    $single_template = wpcc_PLUGIN_PATH .'/templates/single-card.php';
  }
  return $single_template;
}

//route archive- template
function wpcc_archive_template($template){
  if(is_post_type_archive('card')){
    $theme_files = array('archive-card.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return wpcc_PLUGIN_PATH . '/templates/archive-card.php';
    }
  }
  return $template;
}


// De-Queue ALL scripts and Stylesheets

function wpcc_remove_default_styles ()
{

	if ('card' == get_post_type() || is_post_type_archive('card') || is_page_template('center_home.php') ){
		// get all styles data
		global $wp_styles;

		$keep_styles = array(
		   'admin-bar',  //Always show the admin bar
		   'nf-display'  //Ninja Forms
		);

		// loop over all of the registered scripts
		foreach ($wp_styles->registered as $handle => $data)
		{
			if(!in_array ($handle, $keep_styles) ){
				// remove it
				wp_deregister_style($handle);
				wp_dequeue_style($handle);
			}
		}

	}
}

if(get_option( 'wpcc_disable_styles' ) == 1){
	add_action('wp_print_scripts', 'wpcc_remove_default_styles', 100);

}





function wpcc_remove_default_scripts ()
{

	if ('card' == get_post_type() || is_post_type_archive('card') || is_page_template('center_home.php') ){

		// get all styles data
		global $wp_scripts;

		$keep_scripts = array(
		   'jquery',
		   'nf-front-end-deps', //Ninja Forms
		   'nf-front-end', //Ninja Forms
		   'admin-bar' ,
		   'wpcc-scripts'
		);

		// loop over all of the registered scripts
		foreach ($wp_scripts->registered as $handle => $data)
		{

			if(!in_array ($handle, $keep_scripts) ){
				// remove it
				wp_deregister_script($handle);
				wp_dequeue_script($handle);
			}
		}

	}
}
if(get_option( 'wpcc_disable_scripts' ) == 1 && !is_admin() ){
	add_action('wp_print_scripts', 'wpcc_remove_default_scripts', 100);
}

//Now enqueue styles we want
add_action('wp_enqueue_scripts', 'wpcc_add_styles', 101);

function wpcc_add_styles() {
	if(is_singular( 'card' )  || is_post_type_archive('card') || get_page_template_slug( get_the_ID() ) =='center_home.php' ){
		wp_enqueue_style( 'wpcc-style', '/wp-content/plugins/wp-church-center/templates/wpcc_style.css' );
		wp_enqueue_script( 'wpcc-scripts', '/wp-content/plugins/wp-church-center/templates/wpcc_script.js' );
	}
}

//Image Sizes
add_image_size( 'card_image', 600, 1200, false );
add_image_size( 'card_hero_image', 1200, 1200, false );

//Definitely Hide admin bar when not logged in
add_filter('show_admin_bar', 'wpct_hide_adminbar');
function wpct_hide_adminbar(){
    if(!is_user_logged_in() ){
        return false;
    }
    return true;
}






