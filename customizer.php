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
$wp_customize->add_section('wpcc_header', array(
'title' => 'Header',
'description' => '',
'priority' => 120,
'panel' => 'WP_Church_Center',
));

$wp_customize->add_section('wpcc_footer', array(
'title' => 'Footer',
'description' => '',
'priority' => 120,
'panel' => 'WP_Church_Center',
));

$wp_customize->add_section('wpcc_links', array(
'title' => 'Church Links',
'description' => 'Links to your website and Social Media profiles',
'priority' => 120,
'panel' => 'WP_Church_Center',
));

$wp_customize->add_section('wpcc_design', array(
'title' => 'Design Options',
'priority' => 120,
'panel' => 'WP_Church_Center',
));

$wp_customize->add_section('wpcc_settings', array(
'title' => 'Settings',
'priority' => 120,
'panel' => 'WP_Church_Center',
));


/** **** **** *** *** *** *** *** *.
/**   Add Settings and Controls for 'Your Church Details'   */

//Heading for the logo section
add_action( 'customize_render_control_wpcc_header_layout', function(){
    printf( '<h2 style="margin: 30px 0 10px; color:#333; font-size:16px;">%s</h2>', __( 'Logo options', 'wpcc' ) );
});

//Add Control for Header Layout
 $wp_customize->add_setting( 'wpcc_header_layout', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'left',
) );

$wp_customize->add_control( 'wpcc_header_layout', array(
  'type' => 'select',
  'section' => 'wpcc_header', // Add a default or your own section
  'label' => __( 'Logo Position' ),
  'choices' => array(
    'left' => __( 'Left Aligned' ),
    'right' => __( 'Right Aligned' ),
    'center' => __( 'Center Aligned' ),
  ),

) );

// add a setting for the site logo
$wp_customize->add_setting('wpcc_church_logo', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

// Add a control to upload the logo
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpcc_church_logo',
array(
'label' => 'Upload Logo',
'section' => 'wpcc_header',
'settings' => 'wpcc_church_logo',
) ) );

// add a setting for the church name
$wp_customize->add_setting('wpcc_church_name', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//add control for church website name
$wp_customize->add_control( 'wpcc_church_name', array(
   'label'   => 'Church Name',
   'section' => 'wpcc_header',
   'type'    => 'text',
) );

// add a setting for the church name
$wp_customize->add_setting('wpcc_church_copyright', array(
     'type' => 'option', 
     'capability' => 'manage_options',
));

//Heading for the Menu section
add_action( 'customize_render_control_wpcc_icon_style', function(){
    printf( '<h2 style="margin: 0px 0 10px; padding-top: 35px; color:#333; font-size:16px;clear:both;">%s</h2>', __( 'Menu options', 'wpcc' ) );
});

//Add Control for Icon Style
 $wp_customize->add_setting( 'wpcc_icon_style', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'circle',
) );

$wp_customize->add_control( 'wpcc_icon_style', array(
  'type' => 'select',
  'section' => 'wpcc_header', // Add a default or your own section
  'label' => __( 'Menu Icon Style' ),
  'choices' => array(
    'plain' => __( 'Plain' ),
    'circle' => __( 'Circle' ),
    'circle-outline' => __( 'Outlined Circle' ),
    'rounded-square' => __( 'Rounded Square' ),
  ),

) );

//Add Setting for Icon  Colour
$wp_customize->add_setting( 'wpcc_icon_color', array(
       'default'    => '#333', 
       'type'       => 'option', 
       'capability' => 'manage_options', 
    ) 
 ); 

//Add Control for Icon Colour
 $wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 
    'wpcc_icon_color', //Set a unique ID for the control
    array(
       'label'      => __( 'Icon Color', 'wpcc_plugin' ), 
       'settings'   => 'wpcc_icon_color', 
       'section'    => 'wpcc_header',
    ) 
 ) );

//Add Setting for Icon Background Colour
$wp_customize->add_setting( 'wpcc_icon_background', array(
       'default'    => '#ffffff', 
       'type'       => 'option', 
       'capability' => 'manage_options', 
    ) 
 ); 

//Add Control for Icon Background Colour
 $wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 
    'wpcc_icon_background', //Set a unique ID for the control
    array(
       'label'      => __( 'Icon Background Color', 'wpcc_plugin' ), 
       'settings'   => 'wpcc_icon_background', 
       'section'    => 'wpcc_header',
    ) 
 ) );

//add control for church website copyright
$wp_customize->add_control( 'wpcc_church_copyright', array(
   'label'   => 'Footer Copyright Text',
   'section' => 'wpcc_footer',
   'type'    => 'text',
   'description' => 'Leave this blank for no footer'
) );

//Add Setting for Footer Background Colour
$wp_customize->add_setting( 'wpcc_footer_background', array(
       'default'    => '#333', 
       'type'       => 'option', 
       'capability' => 'manage_options', 
    ) 
 ); 

//Add Control for Footer Background Colour
 $wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 
    'wpcc_footer_background', //Set a unique ID for the control
    array(
       'label'      => __( 'Footer Background Color', 'wpcc_plugin' ), 
       'settings'   => 'wpcc_footer_background', 
       'section'    => 'wpcc_footer',
    ) 
 ) );

//Add Setting for Footer Text Colour
$wp_customize->add_setting( 'wpcc_footer_text', array(
       'default'    => '#888888', 
       'type'       => 'option', 
       'capability' => 'manage_options', 
    ) 
 ); 

//Add Control for Footer Text Colour
 $wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 
    'wpcc_footer_text', //Set a unique ID for the control
    array(
       'label'      => __( 'Footer Text Color', 'wpcc_plugin' ), 
       'settings'   => 'wpcc_icon_background', 
       'section'    => 'wpcc_footer',
    ) 
 ) );

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

//Add Control Overall theme
 $wp_customize->add_setting( 'wpcc_theme', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'dark',
) );

$wp_customize->add_control( 'wpcc_theme', array(
  'type' => 'select',
  'section' => 'wpcc_design', // Add a default or your own section
  'label' => __( 'Overall Style' ),
  'choices' => array(
    'light' => __( 'Light Theme' ),
    'dark' => __( 'Dark Theme' ),
    
  ),
) );

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
       'section'    => 'wpcc_design',
    ) 
 ) );

 //Heading for the Card view section
add_action( 'customize_render_control_wpcc_layout', function(){
    printf( '<h2 style="margin: 30px 0 10px; color:#333;clear:both; font-size:16px;padding-top: 50px;">%s</h2>', __( 'Card / List View', 'wpcc' ) );
});

 //Add Control for layout type
 $wp_customize->add_setting( 'wpcc_layout', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'grid',
) );

$wp_customize->add_control( 'wpcc_layout', array(
  'type' => 'select',
  'section' => 'wpcc_design', // Add a default or your own section
  'label' => __( 'Layout Type' ),
  'description' => __( 'What style of layout should we use to show all the Next Steps' ),
  'choices' => array(
    'grid' => __( 'Grid' ),
    'list' => __( 'List' ),
    'small-card' => __( 'Small Cards' ),
    'card' => __( 'Cards' ),
    
  ),
) );

function is_card_layout($control){
    // Check if the selected layout is card'
    if( $control->manager->get_setting('wpcc_layout')->value() != 'card' ){
    // If it isn't - then it won't show the section/panel/control
        return false;
    } else {
    // If it is, we do show it
        return true;
    }
}

 //Add Control for Card Scroll Direction
 $wp_customize->add_setting( 'wpcc_scroll_direction', array(
  'capability' => 'manage_options',
  'sanitize_callback' => 'wpcc_sanitize_select',
  'type' => 'option',
  'default' => 'horizontal',
) );

$wp_customize->add_control( 'wpcc_scroll_direction', array(
  'type' => 'select',
  'section' => 'wpcc_design', // Add a default or your own section
  'active_callback' => 'is_card_layout',
  'description' => __( 'Scroll direction on small screens' ),
  'choices' => array(
    'horizontal' => __( 'Horizontal Scroll' ),
    'vertical' => __( 'Vertical Scroll' ),
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

 //Heading for the Image Control section
add_action( 'customize_render_control_wpcc_greyscale', function(){
    printf( '<h2 style="margin: 30px 0 10px; color:#333;clear:both; font-size:16px;padding-top: 50px;">%s</h2>', __( 'Image Options', 'wpcc' ) );
});

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
        'section'    => 'wpcc_design',
        'type'       => 'checkbox',
        'std'         => '1',
        'description' => 'This makes sure that all images are converted to Black and White, so they work better with the color tinting.',
    ) );

  // Add settings for tinting images
    $wp_customize->add_setting( 'wpcc_tinting', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport' => 'refresh',
    ) );



    // Add control and output for greyscale field
    $wp_customize->add_control( 'wpcc_tinting', array(
        'label'      => __( 'Tint Images with Feature Color', 'wpcc_plugin' ),
        'section'    => 'wpcc_design',
        'type'       => 'checkbox',
        'std'         => '1',
        'description' => 'This will cause the image to be tinted with the selected feature color from the card',
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


// Add link to customizer settings
add_action('admin_menu', 'wpcc_extra_admin_menu');

function wpcc_extra_admin_menu() {
    global $submenu;
    $query['url'] = wpcc_get_home_center_link();
    $query['autofocus[panel]'] = 'WP_Church_Center';
    $url = add_query_arg( $query, admin_url( 'customize.php' ) );

    $submenu['edit.php?post_type=card'][] = array('Center Settings', 'manage_options', $url);
}