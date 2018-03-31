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
                      'Sunset Contact Form',
                      'Contact Form',
                      'manage_options',
                      'guisopo_sunset_theme_contact',
                      'sunset_contact_form_page'
                    );
    add_submenu_page( 'guisopo_sunset',
                      'Sunset CSS Options',
                      'Custom CSS',
                      'manage_options',
                      'guisopo_sunset_css',
                      'sunset_theme_settings_page'
                    );

    //ACTIVATE CUSTOM SETTINGS
    add_action( 'admin_init', 'sunset_custom_settings');
  }

  add_action( 'admin_menu', 'sunset_add_admin_page' );

  function sunset_custom_settings() {
    //SIDEBAR OPTIONS
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
                        'sunset_sidebar_description',
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-twitter',
                        'Twitter handler',
                        'sunset_sidebar_twitter',
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-facebook',
                        'Facebook handler',
                        'sunset_sidebar_facebook',
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );
    add_settings_field( 'sidebar-gplus',
                        'Google+ handler',
                        'sunset_sidebar_gplus',
                        'guisopo_sunset',
                        'sunset-sidebar-options'
                      );

    //THEME SUPPORT OPTIONS
    register_setting( 'sunset-theme-support', 'post_formats' );
    register_setting( 'sunset-theme-support', 'custom_header' );
    register_setting( 'sunset-theme-support', 'custom_background' );

    add_settings_section( 'sunset-theme-options',
                          'Theme Options',
                          'sunset_theme_options',
                          'guisopo_sunset_theme'
                        );

    add_settings_field( 'post-formats',
                        'Post Formats',
                        'sunset_post_formats',
                        'guisopo_sunset_theme',
                        'sunset-theme-options'
                      );
    add_settings_field( 'custom-header',
                        'Custom Header',
                        'sunset_custom_header',
                        'guisopo_sunset_theme',
                        'sunset-theme-options'
                      );
    add_settings_field( 'custom-background',
                        'Custom Background',
                        'sunset_custom_background',
                        'guisopo_sunset_theme',
                        'sunset-theme-options'
                      );

    //CONTACT FORM OPTIONS
    register_setting( 'sunset-contact-form', 'activate_contact');

    add_settings_section( 'sunset-contact-section',
                          'Contact Form',
                          'sunset_contact_section',
                          'guisopo_sunset_theme_contact'
                        );

    add_settings_field( 'activate-form',
                        'Activate Contact Form',
                        'sunset_activate_contact',
                        'guisopo_sunset_theme_contact',
                        'sunset-contact-section'
                      );

  }

   //==========================
  // SIDEBAR OPTIONS CALLBACKS

  function sunset_sidebar_options() {
    echo 'Customise your sidebar';
  }

  function sunset_sidebar_picture() {
    $picture = esc_attr( get_option( 'profile_picture') );
    if(empty($picture)) {
      // Name of the input should be the same name of the settings that we register at the begining
      echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"/>
            <input type="hidden" id="profile-picture" name="profile_picture" value=""/>';
    } else {
      // When we create a button its gonna have by default a type of submit automatically. We can change that changing the type attribute to button or creating and input with the type of button
      echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"/>
            <input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'"/>
            <input type="button" class="button button-secondary" value="Remove" id="remove-picture"/>';
    }

  }

  function sunset_sidebar_name() {
    $firstName = esc_attr( get_option( 'first_name') );
    $lastName = esc_attr( get_option( 'last_name') );
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

   //================================
  // THEME SUPPORT OPTIONS CALLBACKS

  function sunset_theme_options() {
	   echo 'Activate and Deactivate specific Theme Support Options';
  }

  function sunset_post_formats() {
    $options = get_option('post_formats');
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach ($formats as $format) {
      // checks if an array-key exists and is not null
      $checked = (isset($options[$format]) && $options[$format] == 1 ? "checked" : '');
      $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.'>'.$format.'</label><br>';
    }
    echo $output;
  }

  function sunset_custom_header() {
    $options = get_option( 'custom_header' );
    $checked = ( $options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' />Activate the Custom Header</label>';
  }


  function sunset_custom_background() {
    $options = get_option( 'custom_background' );
    $checked = ($options == 1 ? "checked" : '');
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' />Activate the Custom Background</label>';
  }

   //======================
  //CONTACT FORM CALLBACKS

  function sunset_contact_section() {
    echo 'Activate and Deactivate the Built-in Contact Form';
  }

  function sunset_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( $options == 1 ? 'checked' : '' );
    echo '<input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' />';
  }

   //===================
  //SANITAZING SETTINGS
  function sunset_sanitize_twitter_handler( $input ) {
    $output = sanitize_text_field( $input );
    $output = str_replace( '@', '', $output);
    //Always return, NEVER echo
    return $output;
  }

   //==========================
  //TEMPLATE SUBMENU FUNCTIONS
  function sunset_theme_create_page() {
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php' );
  }

  function sunset_theme_support_page() {
    require_once( get_template_directory() . '/inc/templates/sunset-theme-support.php' );
  }

  function sunset_contact_form_page() {
    require_once( get_template_directory() . '/inc/templates/sunset-contact-form.php' );
  }

  function sunset_theme_settings_page() {
    echo '<h1>Sunset Custom Styles</h1>';
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
