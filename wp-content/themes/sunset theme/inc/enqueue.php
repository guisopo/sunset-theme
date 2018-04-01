<?php

  /*
  @package Sunset Theme
    ==========================
      ADMIN ENQUEUE FUNCTIONS
    ==========================
  */

  function sunset_load_admin_scripts( $hook ) {

    wp_register_style( 'raleway-admin', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
    wp_register_style( 'sunset_admin', get_template_directory_uri() . '/css/sunset.admin.css', array(), '1.0.0', 'all' );
    wp_register_script( 'sunset-admin-script', get_template_directory_uri() . '/javascript/sunset.admin.js', array('jquery'), '1.0.0', true );

    $pages_array = array (
      'toplevel_page_guisopo_sunset',
      'sunset_page_guisopo_sunset_theme',
      'sunset_page_guisopo_sunset_theme_contact'
    );

    if(in_array($hook, $pages_array)) {
      wp_enqueue_style( 'raleway-admin');
      wp_enqueue_style( 'sunset_admin');

    } else if('toplevel_page_guisopo_sunset' == $hook) {
      // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs
      wp_enqueue_media();
      wp_enqueue_script( 'sunset-admin-script');
    } else {
      return;
    }



  }

  add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts');


  /*
    ==========================
      FRONTEND ENQUEUE FUNCTIONS
    ==========================
  */

  function sunset_load_scripts() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7',  'all' );
    wp_enqueue_style( 'sunset', get_template_directory_uri() . '/css/sunset.css', array(), '1.0.0',  'all' );
    wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/javascript/jquery.js', array(), '1.11.3', 'true' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7',  true );

  }

  add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );


?>
