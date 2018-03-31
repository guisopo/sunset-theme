<h1>Sunset Contact Form</h1>
<?php settings_errors(); ?>

<!-- Method will always be post -->
<form method="post" action="options.php" class="sunset-general-form">
  <?php settings_fields( 'sunset-contact-form' ); ?>
  <?php do_settings_sections( 'guisopo_sunset_theme_contact' ); ?>
  <?php submit_button(); ?>
</form>
