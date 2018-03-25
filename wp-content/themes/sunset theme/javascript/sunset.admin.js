jQuery(document).ready(function($){

  var mediaUploader;

  $('#upload-button').on('click', function(e) {
    // e.preventDefault();
    if( mediaUploader ) {
      mediaUploader.open();
      // we return to avoid the script to continue
      return;
    }
    console.log('hola');
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Upload Profile Picture',
      button: {
        text: 'Choose Picture'
      },
      multiple: false
    });


  });

});
