<?php
/*
 * Plugin name: Nda-Portex-Post-Type
 * Description: Plugin that inserts custom post type
 * Author: Anton Dolmat
 */

if( !function_exists( 'add_action' ) ) {
  echo 'Not allowed';
  exit();
}

// Setup
define( 'NDA_POST_TYPE_PLUGIN_URL', __FILE__ );

// Includes

include( 'includes/init.php');
include( 'includes/admin/init.php');
include( 'process/save-post.php');

// Hooks

add_action( 'init', 'np_init');
add_action( 'admin_init', 'product_admin_init' );
add_action( 'save_post_product', 'nda_save_post_admin', 10, 3 );

//Shortcodes
