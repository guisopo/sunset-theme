<h1>Sunset Theme Support</h1>
<?php settings_errors(); ?>

<!-- Method will always be post -->
<form method="post" action="options.php">
  <?php settings_fields( 'sunset-theme-support' ); ?>
  <?php do_settings_sections( 'guisopo_sunset_theme' ); ?>
  <?php submit_button(); ?>
</form>
