<?php

  /*
    This is the tempalte for the header

    @package sunsettheme
  */

?>

<!DOCTYPE html>
<html <?php language_attributes() ?> dir="ltr">
  <head>
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ) ?>">
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

    <div class="container">
      <div class="row">
        <div class="col-xs-12">

          <!-- Beacuse we can NOT call the custom BG header we have to call it here -->
          <div class="header-container background-image  text-center" style="background-image: url(<?php header_image() ?>)">

            <div class="header-content">
              <div class="header-content-wrapper">
                <h1 class="site-title sunset-icon">
                  <span class="sunset-logo"></span>
                  <span class="hide"><?php bloginfo( 'name' ); ?></span>
                </h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
              </div>
            </div>

            <div class="nav-container">

            </div>

          </div>

        </div>
      </div>
    </div>
