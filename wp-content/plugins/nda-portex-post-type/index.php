<?php
/*
 * Plugin name: Nda-Portex-Post-Type
 * Description: Plugin that inserts custom post type
 * Author: Anton Dolmat
 */

 // Security check if wordpress engine is loaded


if( !function_exists( 'add_action' ) ) {
  echo 'Not allowed';
  exit();
}

// Setup

// Define plugin url constant
define( 'NDA_POST_TYPE_PLUGIN_URL', __FILE__ );

// Includes

include( 'includes/init.php');
include( 'includes/admin/init.php');
include( 'includes/admin/slider-control.php');
include( 'process/save-post.php');
include( 'process/update-category-meta.php');
include( 'process/pdf-upload.php');

// Hooks


//Initialization of post type and admin options
add_action( 'init', 'np_init');
add_action( 'admin_init', 'product_admin_init' );

// Change upload directory for PDF files
add_filter('wp_handle_upload_prefilter', 'nda_pre_upload');
add_filter('wp_handle_upload', 'nda_post_upload');

// Initialization of save product create and edit categories metaboxes
add_action( 'save_post_product', 'nda_save_post_admin', 10, 3 );
add_action( 'edited_category', 'save_category_custom_meta', 10, 2 );
add_action( 'create_category', 'save_category_custom_meta', 10, 2 );

// Load admin scripts
add_action( 'admin_enqueue_scripts', 'my_load_wp_media_files' );

// Initialization of admin menu
add_action( 'admin_menu', 'nda_slider_control' );

// Creation and registration of nda_options
function register_my_settings() {
	register_setting( 'nda_options', 'main_slider_titles' );
  register_setting( 'nda_options', 'main_slider_urls' );
}
add_action( 'admin_init', 'register_my_settings' );




//Shortcodes
