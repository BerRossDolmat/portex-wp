var $ = jQuery;
$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'optionsRadios2') {
            $('#different-image-button').show(500);
       }
       else {
            $('#different-image-button').hide(500);
       }
       if($(this).attr('id') == 'optionsRadios3') {
            $('#slider-button').show(500);
       }
       else {
            $('#slider-button').hide(500);
       }
   });
});

// Uploading file
var file_frame;
  jQuery('#different-image-button').live('click', function( event ){
    event.preventDefault();
    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false
      // Set to true to allow multiple files to be selected
    });
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();
      // Do something with attachment.id and/or attachment.url here
      $('#different-image-input').val(attachment.title);
      $('#different-image-title').val(attachment.title);
      $('#different-image-url').val(attachment.url);
      $('#different-image-input').show(500);

    });
    // Finally, open the modal
    file_frame.open();
  });

  // Upload files


  jQuery('#slider-button').live('click', function( event ){
    event.preventDefault();

    if ( file_frame ) {
      file_frame.open();
      return;
    }
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: true
    });
    file_frame.on( 'select', function() {
      var imgUrls = [];
      var imgTitles = [];
      var selection = file_frame.state().get('selection');
      $('#imgTitles').html('');
      selection.map( function( attachment ) {
        attachment = attachment.toJSON();
      // Do something with attachment.id and/or attachment.url here
      imgUrls.push(attachment.url);
      imgTitles.push(attachment.title);
      $('#imgTitles').append('<li class="list-group-item">' + attachment.title + '</li>');
      $('#imgTitlesBlock').show(500);
      });

      $('#slider_img_urls').val(JSON.stringify(imgUrls));
      $('#slider_img_titles').val(JSON.stringify(imgTitles));

    });
    // Finally, open the modal
    file_frame.open();
  });
