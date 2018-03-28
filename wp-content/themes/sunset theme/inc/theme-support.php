<?php

  /*
  @package Sunset Theme
    ====================
        THEME SUPPORT PAGE
    =====================
  */

  $options = get_option('post_formats');

  $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
  $output = array();
  foreach ($formats as $format) {

    $output[] = (isset($options[$format]) && $options[$format] == 1 ? $format : '');

    if( !empty($options)) {
      add_theme_support( 'post-formats', $output);
    }
  }

?>
