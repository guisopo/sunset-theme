jQuery(document).ready(function($){

  var mediaUploader;

  $('#upload-button').on('click', function(e) {
    e.preventDefault();
    if( mediaUploader ) {
      mediaUploader.open();
      // we return to avoid the script to continue
      return;
    }

    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Upload Profile Picture',
      button: {
        text: 'Choose Picture'
      },
      multiple: false
    });

    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#profile-picture').val(attachment.url);
      $('#profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');
    });

    mediaUploader.open();


  });

});
