<?php

/* Archive for WP Church Center  */

/**  Load Header */
require_once plugin_dir_path( __FILE__ ) . 'header.php';

echo wpcc_card_display($wp_query,NULL);


/**  Load Footer */
require_once plugin_dir_path( __FILE__ ) . 'footer.php'; 