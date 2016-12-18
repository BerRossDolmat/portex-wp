<?php

// Set Up

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 200, 200, false ); // default Featured Image dimensions (cropped)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'category-thumb', 200, 200 );
    add_image_size( 'category-descr', 400, 400 );
 }

// Includes

include ( get_template_directory() . '/includes/front/enqueue.php' );
include ( get_template_directory() . '/includes/back/send-mail.php' );
include ( get_template_directory() . '/includes/back/remove-menu-pages.php');

// Actions & Hooks
// remove the html filtering

add_action( 'wp_enqueue_scripts', 'nda_enqueue' );
add_action( 'admin_menu', 'nda_remove_menu_pages' );

// Add rest route for mailing
add_action( 'rest_api_init', function () {
    register_rest_route(
        'mail',
        '/send',
        array(
            'methods' => 'POST',
            'callback' => 'send_mail',
        )
    );
} );

// Define content type of emails
add_filter( 'wp_mail_content_type', function( $content_type ) {
	return 'text/html';
});

// Shortcodes

?>
