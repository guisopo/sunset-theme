<?php

  /*
    This is the tempalte for the header

    @package sunsettheme
  */

?>

<!DOCTYPE html>
<html <?php language_attributes() ?> dir="ltr">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <!-- We wanna hidde this section in the case the page is not a single post, page or in case the pingback has been deactivated from the backend. -->
    <?php if( is_singular() && pings_open( get_queried_object() ) ) : ?>
      <link rel="pingback" href="<?php bloginfo( 'ping_back_url' ); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
