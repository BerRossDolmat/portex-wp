var $ = jQuery;

var file_frame;

jQuery('#main-slider-button').live('click', function( event ){
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

    $('#main_slider_img_urls').val(JSON.stringify(imgUrls));
    $('#main_slider_img_titles').val(JSON.stringify(imgTitles));

  });
  // Finally, open the modal
  file_frame.open();
});
