<?php

/**
* Create Logo Setting and Upload Control
*/
function wpcc_new_customizer_settings($wp_customize) {

/** **** **** *** *** *** *** *** *.
/**   Add WP Church Center Panel   */
$wp_customize->add_panel( 'WP_Church_Center', array(
  'title' => __( 'Church Center' ),
  'description' => 'Set up the details of your Church Center', 
  'priority' => 160, // Mixed with top-level-section hierarchy.
) );

/** **** **** *** *** *** *** *** *.
/**   Add WP Church Center Sections   */
$wp_customize->add_section('wpcc_details', array(
'title' => 'Your Church Details',
'description' => 'Basic settings for your Church Center',
'priority' => 120,
'panel' => 'WP_Church_Center',
));

$wp_customize->add_section('wpcc_links', array(
'title' => 'Church Links',
'description' => '<p>Links to your website and Social Media profiles</p>',
'priority' => 120,
'panel' => 'WP_Church_Center',
));

$wp_customize->add_section('wpcc_settings', array(
'title' => 'Design &amp; Settings',
'priority' => 120,
'panel' => 'WP_Church_Center',
));


/** **** **** *** *** *** *** *** *.
/**   Add Settings and Controls for 'Your Church Details'   */

// add a setting for the site logo
$wp_customize->add_setting('wpcc_church_logo', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

// Add a control to upload the logo
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpcc_church_logo',
array(
'label' => 'Upload Logo',
'section' => 'wpcc_details',
'settings' => 'wpcc_church_logo',
) ) );

// add a setting for the church name
$wp_customize->add_setting('wpcc_church_name', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for church website link
$wp_customize->add_control( 'wpcc_church_name', array(
   'label'   => 'Church Name',
   'section' => 'wpcc_details',
   'type'    => 'text',
) );


 



/** **** **** *** *** *** *** *** *.
/**   Add Settings and Controls for 'Church Links'   */

// add a setting for the church website link
$wp_customize->add_setting('wpcc_church_url', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for church website link
$wp_customize->add_control( 'wpcc_church_url', array(
   'label'   => 'Church Website URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );

// add a setting for the Facebook link
$wp_customize->add_setting('wpcc_facebook', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_facebook', array(
   'label'   => 'Facebook Profile URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );


// add a setting for the Twitter link
$wp_customize->add_setting('wpcc_twitter', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_twitter', array(
   'label'   => 'Twitter Profile URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );


// add a setting for the Twitter link
$wp_customize->add_setting('wpcc_instagram', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_instagram', array(
   'label'   => 'Instagram Profile URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );


// add a setting for the Snapchat link
$wp_customize->add_setting('wpcc_snapchat', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_snapchat', array(
   'label'   => 'Snapchat Profile URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );


// add a setting for the Snapchat link
$wp_customize->add_setting('wpcc_youtube', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_youtube', array(
   'label'   => 'Youtube Profile URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );


// add a setting for the Snapchat link
$wp_customize->add_setting('wpcc_vimeo', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_vimeo', array(
   'label'   => 'Vimeo profile URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );

// add a setting for the Snapchat link
$wp_customize->add_setting('wpcc_giving', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for Facebook link
$wp_customize->add_control( 'wpcc_giving', array(
   'label'   => 'Online Giving URL',
   'section' => 'wpcc_links',
   'type'    => 'text',
) );


/** **** **** *** *** *** *** *** *.
/**   Add Settings and Controls for 'Center Settings'   */

//Add Setting for Background COlour
$wp_customize->add_setting( 'wpcc_background', array(
       'default'    => '#333333', 
       'type'       => 'option', 
       'capability' => 'manage_options', 
    ) 
 ); 

//Add Control for Background Colour
 $wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 
    'wpcc_background', //Set a unique ID for the control
    array(
       'label'      => __( 'Background Color', 'wpcc_plugin' ), 
       'settings'   => 'wpcc_background', 
       'section'    => 'wpcc_settings',
    ) 
 ) );

 //Add Control for layout type
 $wp_customize->add_setting( 'wpcc_layout', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'grid',
) );

$wp_customize->add_control( 'wpcc_layout', array(
  'type' => 'select',
  'section' => 'wpcc_settings', // Add a default or your own section
  'label' => __( 'Layout Type' ),
  'description' => __( 'What style of layout should we use to show all the Next Steps' ),
  'choices' => array(
    'grid' => __( 'Grid' ),
    'card' => __( 'Cards' ),
    'list' => __( 'List' ),
  ),
) );

function wpcc_sanitize_select( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}



// Add settings for greyscale images
    $wp_customize->add_setting( 'wpcc_greyscale', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport' => 'refresh',
    ) );

    // Add control and output for greyscale field
    $wp_customize->add_control( 'wpcc_greyscale', array(
        'label'      => __( 'Convert Images to Greyscale', 'wpcc_plugin' ),
        'section'    => 'wpcc_settings',
        'type'       => 'checkbox',
        'std'         => '1',
        'description' => 'This makes sure that all images are converted to Black and White, so they work better with the color tinting.',
    ) );

  // Add settings for disabling styles
    $wp_customize->add_setting( 'wpcc_disable_styles', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport' => 'refresh',
    ) );

    // Add control and output for disabling styles
    $wp_customize->add_control( 'wpcc_disable_styles', array(
        'label'      => __( 'Disable Theme &amp; Plugin Styles', 'wpcc_plugin' ),
        'section'    => 'wpcc_settings',
        'type'       => 'checkbox',
        'std'         => '1',
        'description' => 'This removes unecessary stylesheets to help load your center faster. If some content appears incorrectly, you may need to disable this setting.',
    ) );

    // Add settings for disabling scripts
    $wp_customize->add_setting( 'wpcc_disable_scripts', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport' => 'refresh',
    ) );

    // Add control and output for disabling scripts
    $wp_customize->add_control( 'wpcc_disable_scripts', array(
        'label'      => __( 'Disable Theme &amp; Plugin Scripts', 'wpcc_plugin' ),
        'section'    => 'wpcc_settings',
        'type'       => 'checkbox',
        'std'         => '1',
        'description' => 'This removes unecessary scripts to help load your center faster. If some content appears incorrectly, you may need to disable this setting.',
    ) );



}
add_action('customize_register', 'wpcc_new_customizer_settings');



//Customizer S
function tmx_customizer_live_preview() {

  wp_enqueue_script(
    'wpcc-theme-customizer',
    '/wp-content/plugins/wp-church-center/templates/wpcc_customizer.js',
    array( 'jquery', 'customize-preview' ),
    '',
    true
  );

} // end tcx_customizer_live_preview
add_action( 'customize_preview_init', 'tmx_customizer_live_preview' );

// Add link to customizer settings
add_action('admin_menu', 'wpcc_extra_admin_menu');

function wpcc_extra_admin_menu() {
    global $submenu;
    $query['url'] = wpcc_get_home_center_link();
    $query['autofocus[panel]'] = 'WP_Church_Center';
    $url = add_query_arg( $query, admin_url( 'customize.php' ) );

    $submenu['edit.php?post_type=card'][] = array('Center Settings', 'manage_options', $url);
}