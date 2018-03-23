<?php

  /*
  @package Sunset Theme
    ====================
      ADMIN PAGE
    =====================
  */

  function sunset_add_admin_page() {
    // Generate Sunset Admin Page
    add_menu_page( 'Sunset Theme Options',      // $page_title,
                   'Sunset',                    // $menu_title
                   'manage_options',            // $capability
                   'guisopo_sunset',            // $menu_slug (should always be a single word)
                   'sunset_theme_create_page',  // $function fills the section with the desired content
                   get_template_directory_uri() . '/img/sunset-icon.png', // $icon_url
                   110                          // $position
                  );
    // Generate Sunset Admin Subpages
    add_submenu_page( 'guisopo_sunset',              // $parent_slug
                      'Sunset Theme Options',        // $page_title: same as the parent
                      'General',                     // $menu_title
                      'manage_options',              // $capability
                      'guisopo_sunset',              // $menu_slug: same as the parent
                      'sunset_theme_create_page'     // $function fills the section with the desired content
                    );
    add_submenu_page( 'guisopo_sunset',
                      'Sunset CSS Options',
                      'Custom CSS',
                      'manage_options',
                      'guisopo_sunset_css',
                      'sunset_theme_settings_page'
                    );

    //Activate Custom Settings: we write this action inside this function to prevent the system generate the custom settings if we are not creating the page, if the system is not starting properly.
    add_action( 'admin_init', 'sunset_custom_settings');
  }

  add_action( 'admin_menu', 'sunset_add_admin_page' );

  function sunset_custom_settings() {
    // Gives us the ability to create a specific section in the WP database to recorde a custom group of settings, fields, options, checkbox. Args ($option_group, $option_name)
    register_setting( 'sunset-settings-group', 'first_name' );
    register_setting( 'sunset-settings-group', 'last_name' );
    register_setting( 'sunset-settings-group', 'twitter_handler' );
    add_settings_section( 'sunset-sidebar-options', //$id of the section
                          'Sidebar Options',        //$title of the section
                          'sunset_sidebar_options', //$callback function fills the section with the desired content
                          'guisopo_sunset'          //$page where settings are printed
                        );
    // Use this to define a settings field that will show as part of a settings section inside a settings page.
    add_settings_field( 'sidebar-name',           //$id
                        'Full Name',             //$title
                        'sunset_sidebar_name',    //$callback
                        'guisopo_sunset',         //$page
                        'sunset-sidebar-options' //$section: slug of the section of the settings page in which to show the box.
                      );
    add_settings_field( 'sidebar-twitter',
                        'Twitter handler',
                        'sunset_sidebar_twitter', //we use another $callback
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
  }

  //generation of our admin page
  function sunset_theme_create_page() {

    require_once( get_template_directory() . '/inc/templates/sunset-admin.php' );
  }

  function sunset_sidebar_options() {
    echo 'Customise your sidebar';
  }

  function sunset_sidebar_name() {
    $firstName = esc_attr( get_option( 'first_name') );
    $lastName = esc_attr( get_option( 'last_name') );
    // Name of the input should be the same name of the settings that we register at the begining
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeHolder="First Name" />
          <input type="text" name="last_name" value="'.$lastName.'" placeHolder="Last Name" />';
  }

  function sunset_sidebar_twitter() {
    $twitter = esc_attr( get_option( 'twitter_handler'));
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeHolder="Twitter Handler" />';
  }

  //generation of our CSS page
  function sunset_theme_settings_page() {

  }
?>
