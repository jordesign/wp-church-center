<?php

/* Footer for WP Church Center Pages */
?>

<?php if ( $footerText = get_option( 'wpcc_church_copyright' ) ){ ?>
  <div class="wpccFooter <?php if ( isset($_GET["layout"]) ) { 
    echo $_GET["layout"];
  } elseif ( $layout = get_option( 'wpcc_layout' ) ){
    echo $layout;
  } else {
    echo 'list';
  }  ?>">
  	<p><?php echo $footerText; ?></p>
  </div>
<?php } ?>
</div>
<?php wp_footer(); 

