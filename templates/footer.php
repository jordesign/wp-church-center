<?php

/* Footer for WP Church Hub Pages */
?>

<div class="footer">
	<p>Copyright &copy; <?php echo esc_html( get_option( 'blogname' ) ); ?> <?php echo date('Y'); ?> All Rights Reserved</p>
</div>
<?php wp_footer(); 



/**
 * Print enqueued style/script handles to debug what we want to stop from being de-enqueued by the theme
 * https://lakewood.media/list-enqueued-scripts-handle/
 */
    if( !is_admin() && is_user_logged_in() && current_user_can( 'manage_options' )) {
        // Print Scripts
        global $wp_scripts;
        foreach( $wp_scripts->queue as $handle ) :
           echo '<div style="margin: 5px 3%; border: 1px solid #eee; background-color: #e0e0e0; padding: 20px;clear:both;">Script <br />';
           echo "Handle: " . $handle . '<br />';
           echo "URL: " . $wp_scripts->registered[$handle]->src;
           echo '</div>';
        endforeach;
     
        // Print Styles
        global $wp_styles;
        foreach( $wp_styles->queue as $handle ) :
           echo '<div style="margin: 5px 3%; border: 1px solid #eee; padding: 20px; background-color: #e0e0e0; clear:both;">Style <br />';
           echo "Handle: " . $handle . '<br />';
           echo "URL: " . $wp_styles->registered[$handle]->src;
           echo '</div>';
        endforeach;
    }
