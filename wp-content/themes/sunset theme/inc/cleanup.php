<?php

/*
@package Sunset Theme
  ======================================
    REMOVE GENERATION VERSION NUMBER
  ======================================
*/

function sunset_remove_wp_version_strings( $src ) {
  //calling global before a variable we will be able to access whatever global variable WP defines before the generation of the frontend.
  global $wp_version;
  //PHP_URL_QUERY will check the php version of the code passed. This &ver=4.4.1 is a php query var.
  // Whatever result we got in the first argument is gonna be stored in the $query variable
  parse_str( parse_url($src, PHP_URL_QUERY), $query );

  if( !empty($query['ver'] ) &&  $query['ver'] === $wp_version ) {
    $src = remove_query_arg( 'ver', $src );
  }

  return $src;
}

add_filter( 'script_loader_src', 'sunset_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'sunset_remove_wp_version_strings' );

function sunset_remove_meta_version() {
  return '';
}

add_filter( 'the_generator', 'sunset_remove_meta_version' );

?>
