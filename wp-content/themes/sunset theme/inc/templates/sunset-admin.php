<h1>Sunset Theme Options</h1>
<?php settings_errors(); ?>
<!-- Method will always be post -->
<form method="post" action="options.php">
  <?php settings_fields( 'sunset-settings-group' ); ?>
  <?php do_settings_sections( 'guisopo_sunset' ); ?>
  <?php submit_button(); ?>
</form>