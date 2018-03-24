<?php

  /*
  @package Sunset Theme
    ==============================
      ADMIN ENQUEUE FUNCTIONS
    ===============================
  */

  function sunset_load_admin_scripts() {
    wp_register_style( 'sunset_admin', get_template_directory_uri() . '/css/sunset.admin.css', array(), '1.0.0', 'all' );
  }


?>
