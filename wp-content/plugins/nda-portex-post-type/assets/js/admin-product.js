var $ = jQuery;
$(document).ready(function() {
    
    // Fix the footer

    $('#wpfooter').css('position', 'static');

    // Hide/show radio buttons for slider controls,
    // manage left-slider checkbox input

    $('input[type="radio"]').click(function() {
        if ($(this).attr('id') == 'optionsRadios2') {
            $('#different-image-button').show(500);
        } else {
            $('#different-image-button').hide(500);
        }
        if ($(this).attr('id') == 'optionsRadios3') {
            $('#slider-button').show(500);
            $('#slider-left-button').show(500);
        } else {
            $('#slider-button').hide(500);
            $('#slider-left-button').hide(500);
            $('#product_slider_left').prop('checked', false);
        }
    });
});

// Auto-open permalinks field on body-mouseover event

var checked = false;

$('body').on('mouseover', function() {
    if (checked === false && $('#edit-slug-buttons').length > 0) {
        $('#edit-slug-buttons').children('.edit-slug').click();
        checked = true;
        $('body').off('mouseover');
    }
})

// Event handler for Upload certificate button

var file_frame;
jQuery('#choose_certificate').live('click', function(event) {
    event.preventDefault();
    
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).data('uploader_title'),
        button: {
            text: jQuery(this).data('uploader_button_text'),
        },
        multiple: false
    });
    // When an image is selected, run a callback.
    file_frame.on('select', function() {
        // We set multiple to false so only get one image from the uploader
        attachment = file_frame.state().get('selection').first().toJSON();
        // Do something with attachment.id and/or attachment.url here
        $('#certificate_title').val(attachment.title);
        $('#certificate_title_hidden').val(attachment.title);
        $('#certificate-url').val(attachment.url);
    });
    // Finally, open the modal
    file_frame.open();
});

// Event handler for Upload file for different image slider type
var file_frame;
jQuery('#different-image-button').live('click', function(event) {
    event.preventDefault();
    
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).data('uploader_title'),
        button: {
            text: jQuery(this).data('uploader_button_text'),
        },
        multiple: false
    });
    // When an image is selected, run a callback.
    file_frame.on('select', function() {
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

// Event handler for Upload files for usual and left slider types 

jQuery('#slider-button').live('click', function(event) {
    event.preventDefault();

    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).data('uploader_title'),
        button: {
            text: jQuery(this).data('uploader_button_text'),
        },
        multiple: true
    });
    file_frame.on('select', function() {
        var imgUrls = [];
        var imgTitles = [];
        var selection = file_frame.state().get('selection');
        $('#imgTitles').html('');
        selection.map(function(attachment) {
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

// Choose pdf files for product

jQuery('#pdf-attach-button').live('click', function(event) {
    event.preventDefault();

    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).data('uploader_title'),
        button: {
            text: jQuery(this).data('uploader_button_text'),
        },
        multiple: true
    });
    file_frame.on('select', function() {
        var pdfUrls = [];
        var pdfNames = [];

        var selection = file_frame.state().get('selection');
        $('#pdfNames').html('');
        selection.map(function(attachment) {
            attachment = attachment.toJSON();
            console.log(attachment);
            // Do something with attachment.id and/or attachment.url here
            console.log(attachment);
            pdfUrls.push(attachment.url);
            pdfNames.push(attachment.title);
            $('#pdfNames').append('<li class="list-group-item">' + attachment.title + '</li>');
            $('#pdfNamesBlock').show(500);
        });

        $('#attached_pdf_urls').val(JSON.stringify(pdfUrls));
        $('#attached_pdf_names').val(JSON.stringify(pdfNames));

    });
    // Finally, open the modal
    file_frame.open();
});

