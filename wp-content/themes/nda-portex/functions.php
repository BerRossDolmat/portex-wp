<?php

// Set Up

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 200, 200, true ); // default Featured Image dimensions (cropped)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'category-thumb', 200, 200 );
 }

// Includes

include ( get_template_directory() . '/includes/front/enqueue.php' );
include ( get_template_directory() . '/includes/back/send-mail.php' );

// Actions & Hooks

add_action( 'wp_enqueue_scripts', 'nda_enqueue' );
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

// Shortcodes

?>
