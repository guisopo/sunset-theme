<h1>Sunset Theme Options</h1>
<?php settings_errors(); ?>

<?php
  $profilePicture = esc_attr( get_option( 'profile_picture') );
  $firstName = esc_attr( get_option( 'first_name') );
  $lastName = esc_attr( get_option( 'last_name') );
  $fullName = $firstName . ' ' . $lastName;
  $description = esc_attr( get_option( 'user_description'));
?>

<div class="sunset-sidebar-preview">
  <div class="sunset-sidebar">
    <div class="image-container">
      <div class="profile-picture" style="background-image: url(<?php  print $profilePicture; ?>)">
      </div>
    </div>
    <h1 class="sunset-username"><?php print $fullName; ?></h1>
    <h2 class="sunset-description"><?php print $description; ?></h2>
    <div class="icons-wrapper">
    </div>
  </div>
</div>

<!-- Method will always be post -->
<form method="post" action="options.php">
  <?php settings_fields( 'sunset-settings-group' ); ?>
  <?php do_settings_sections( 'guisopo_sunset' ); ?>
  <?php submit_button(); ?>
</form>
