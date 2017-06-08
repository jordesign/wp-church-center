<?php
// Register Custom Post Type
function wpcc_post_type() {

	$labels = array(
		'name'                  => _x( 'Cards', 'Post Type General Name', 'WP_Church_Center' ),
		'singular_name'         => _x( 'Card', 'Post Type Singular Name', 'WP_Church_Center' ),
		'menu_name'             => __( 'Church Center', 'WP_Church_Center' ),
		'name_admin_bar'        => __( 'Cards', 'WP_Church_Center' ),
		'archives'              => __( 'Card Archives', 'WP_Church_Center' ),
		'attributes'            => __( 'Card Attributes', 'WP_Church_Center' ),
		'parent_item_colon'     => __( 'Parent Card:', 'WP_Church_Center' ),
		'all_items'             => __( 'All Cards', 'WP_Church_Center' ),
		'add_new_item'          => __( 'Add New Card', 'WP_Church_Center' ),
		'add_new'               => __( 'Add Card', 'WP_Church_Center' ),
		'new_item'              => __( 'New Card', 'WP_Church_Center' ),
		'edit_item'             => __( 'Edit Card', 'WP_Church_Center' ),
		'update_item'           => __( 'Update Card', 'WP_Church_Center' ),
		'view_item'             => __( 'View Card', 'WP_Church_Center' ),
		'view_items'            => __( 'View Cards', 'WP_Church_Center' ),
		'search_items'          => __( 'Search Item', 'WP_Church_Center' ),
		'not_found'             => __( 'Not found', 'WP_Church_Center' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'WP_Church_Center' ),
		'featured_image'        => __( 'Featured Image', 'WP_Church_Center' ),
		'set_featured_image'    => __( 'Set featured image', 'WP_Church_Center' ),
		'remove_featured_image' => __( 'Remove featured image', 'WP_Church_Center' ),
		'use_featured_image'    => __( 'Use as featured image', 'WP_Church_Center' ),
		'insert_into_item'      => __( 'Insert into item', 'WP_Church_Center' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'WP_Church_Center' ),
		'items_list'            => __( 'Card list', 'WP_Church_Center' ),
		'items_list_navigation' => __( 'Items list navigation', 'WP_Church_Center' ),
		'filter_items_list'     => __( 'Filter items list', 'WP_Church_Center' ),
	);
	$args = array(
		'label'                 => __( 'Card', 'WP_Church_Center' ),
		'description'           => __( 'Cards for the Church Hub', 'WP_Church_Center' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-screenoptions',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'card', $args );

	if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_card-content',
		'title' => 'Card Content',
		'fields' => array (
			array (
				'key' => 'field_5908a41b36dd2',
				'label' => 'Subtitle',
				'name' => 'wpcc_subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5908a49e36dd3',
				'label' => 'Card Content',
				'name' => 'wpcc_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'card',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_card-presentation',
		'title' => 'Card Presentation',
		'fields' => array (
			array (
				'key' => 'field_5908a8e2b3dab',
				'label' => 'Card Image',
				'name' => 'wpcc_image',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_5908a904b3dac',
				'label' => 'Highlight Color',
				'name' => 'wpcc_color',
				'type' => 'color_picker',
				'required' => 1,
				'default_value' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'card',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

}
add_action( 'init', 'wpcc_post_type', 0 );

/**
 * Remove the slug from published post permalinks. Only affect our custom post type, though.
 */
function wpcc_remove_cpt_slug( $post_link, $post, $leavename ) {
 
    if ( 'card' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
 
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
 
    return $post_link;
}
add_filter( 'post_type_link', 'wpcc_remove_cpt_slug', 10, 3 );

/**
 * Have WordPress match postname to any of our public post types (post, page, race)
 * All of our public post types can have /post-name/ as the slug, so they better be unique across all posts
 * By default, core only accounts for posts and pages where the slug is /post-name/
 */
function wpcc_parse_request_trick( $query ) {
 
    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;
 
    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
 
    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'page', 'card' ) );
    }
}
add_action( 'pre_get_posts', 'wpcc_parse_request_trick' );

function wpcc_get_home_center_link(){
	//Set Global for Hub Home link
	$centerHomeQuery = new WP_Query( array(
	    'post_type'  => 'page',
	    'meta_key'   => '_wp_page_template',
	    'meta_value' => 'center_home.php',
	    'orderby' 	  => 'modified',
	    'posts_per_page' => 1
	) );

	if ( $centerHomeQuery->have_posts() ) {
	    while ( $centerHomeQuery->have_posts() ) : $centerHomeQuery->the_post(); // WP loop
	        return get_the_permalink(); 
	    endwhile; // end of the loop.
	} else { // in case there are no pages with this template
	    return get_post_type_archive_link( 'card' );
	}
	wp_reset_query();
}


