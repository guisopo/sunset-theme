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
                      'Sunset Sidebar Options',      // $page_title: same as the parent
                      'Sidebar',                     // $menu_title
                      'manage_options',              // $capability
                      'guisopo_sunset',              // $menu_slug: same as the parent
                      'sunset_theme_create_page'     // $function fills the section with the desired content
                    );
    add_submenu_page( 'guisopo_sunset',
                      'Sunset Theme Options',
                      'Theme Options',
                      'manage_options',
                      'guisopo_sunset_theme',
                      'sunset_theme_support_page'
                    );
    add_submenu_page( 'guisopo_sunset',
                      'Sunset CSS Options',
                      'Custom CSS',
                      'manage_options',
                      'guisopo_sunset_css',
                      'sunset_theme_settings_page'
                    );

    //ACTIVATE CUSTOM SETTINGS: we write this action inside this function to prevent the system generate the custom settings if we are not creating the page, if the system is not starting properly.
    add_action( 'admin_init', 'sunset_custom_settings');
  }

  add_action( 'admin_menu', 'sunset_add_admin_page' );

  function sunset_custom_settings() {
    //SIDEBAR OPTIONS
    // Gives us the ability to create a specific section in the WP database to recorde a custom group of settings, fields, options, checkbox. Args ($option_group, $option_name)
    register_setting( 'sunset-settings-group', 'profile_picture' );
    register_setting( 'sunset-settings-group', 'first_name' );
    register_setting( 'sunset-settings-group', 'last_name' );
    register_setting( 'sunset-settings-group', 'user_description' );
    register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
    register_setting( 'sunset-settings-group', 'facebook_handler' );
    register_setting( 'sunset-settings-group', 'gplus_handler' );

    add_settings_section( 'sunset-sidebar-options', //$id of the section
                          'Sidebar Options',        //$title of the section
                          'sunset_sidebar_options', //$callback function fills the section with the desired content
                          'guisopo_sunset'          //$page where settings are printed
                        );
    // Use this to define a settings field that will show as part of a settings section inside a settings page.
    add_settings_field( 'sidebar-profile-picture',//$id
                        'Profile Picture',        //$title
                        'sunset_sidebar_picture', //$callback
                        'guisopo_sunset',         //$page
                        'sunset-sidebar-options'  //$section: slug of the section of the settings page in which to show the box.
                      );
    add_settings_field( 'sidebar-name',
                        'Full Name',
                        'sunset_sidebar_name',
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-description',
                        'Description',
                        'sunset_sidebar_description', //we use another $callback
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-twitter',
                        'Twitter handler',
                        'sunset_sidebar_twitter', //we use another $callback
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-facebook',
                        'Facebook handler',
                        'sunset_sidebar_facebook', //we use another $callback
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-gplus',
                        'Google+ handler',
                        'sunset_sidebar_gplus', //we use another $callback
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );

    //THEME SUPPORT OPTIONS
    register_setting( 'sunset-theme-support', 'post_formats', 'sunset_post_formats_callback' );

    add_settings_section( 'sunset-theme-options',
                          'Theme Options',
                          'sunset_theme_options',
                          'guisopo_sunset_theme'
                        );
  }

  function sunset_sidebar_options() {
    echo 'Customise your sidebar';
  }

  function sunset_sidebar_picture() {
    $picture = esc_attr( get_option( 'profile_picture') );
    // Name of the input should be the same name of the settings that we register at the begining
    echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"/>
          <input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'"/>';
  }

  function sunset_sidebar_name() {
    $firstName = esc_attr( get_option( 'first_name') );
    $lastName = esc_attr( get_option( 'last_name') );
    // Name of the input should be the same name of the settings that we register at the begining
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeHolder="First Name" />
          <input type="text" name="last_name" value="'.$lastName.'" placeHolder="Last Name" />';
  }

  function sunset_sidebar_description() {
    $description = esc_attr( get_option( 'user_description'));
    echo '<input type="text" name="user_description" value="'.$description.'" placeHolder="Description Handler" />
          <p class="description">Write something smart.</p>';
  }

  function sunset_sidebar_twitter() {
    $twitter = esc_attr( get_option( 'twitter_handler'));
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeHolder="Twitter Handler" />
          <p class="description">Input yout user name without @ character.</p>';
  }

  function sunset_sidebar_facebook() {
    $facebook = esc_attr( get_option( 'facebook_handler'));
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeHolder="Facebook Handler" />';
  }

  function sunset_sidebar_gplus() {
    $gplus = esc_attr( get_option( 'gplus_handler'));
    echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeHolder="Google+ Handler" />';
  }

  function sunset_theme_options() {
    
  }

  //SANITAZING SETTINGS
  // As an argument we include $input which will be whatever value the user inputs inside this field. WP will pass it automatically.
  function sunset_sanitize_twitter_handler( $input ) {
    // As a standard procesure we will use a prebuild WP function to sanitize a text field which checks for invalid UTF-8 and convert every special character into strip tags.
    $output = sanitize_text_field( $input );
    $output = str_replace( '@', '', $output);
    //Always return, NEVER echo
    return $output;
  }

  // POST FORMAT CALLBACK
  function sunset_post_formats_callback($input) {
    return $input;
  }

  //TEMPLATE SUBMENU FUNCTIONS
  //generation of our admin page
  function sunset_theme_create_page() {
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php' );
  }

  function sunset_theme_support_page() {
    require_once( get_template_directory() . '/inc/templates/sunset-theme-support.php' );
  }

  //generation of our CSS page
  function sunset_theme_settings_page() {

  }

  //
  // / The settings field callback function - First name
  // function sunset_sidebar_name() {
  //  $options = get_option('input_fields');
  //
  //  if ( !isset($options['first_name']) ) $options['first_name'] = '';
  //
  //  echo '<input type="text" class="regular-text" id="first_name" name="input_fields[first_name]" value="'. $options['first_name']. '" placeholder="First Name">';
  // }
  //
  // // The settings fields callback function - Last name
  // function sunset_sidebar_last_name() {
  //  $options = get_option('input_fields');
  //
  //  if( !isset ($options['last_name']) ) $options['last_name'] = '';
  //
  //  echo '<input type="text" class="regular-text" id="last_name" name="input_fields[last_name]" value="' .$options['last_name']. '" placeholder="Last Name">';
  // }
  //
  // // The settings fields callback function - Email
  // function sunset_sidebar_email() {
  //  $options = get_option('input_fields');
  //
  //  if( !isset($options['email_address']) ) $options['email_address'] = '';
  //
  //  echo '<input type="email" class="regular-text" id="email_address" name="input_fields[email_address]" value="'.$options['email_address'].'" placeholder="Your E-mail Address">';
  // }
?>
