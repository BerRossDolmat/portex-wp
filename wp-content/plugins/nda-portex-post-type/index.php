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


// Includes

include( 'includes/init.php');
include( 'includes/admin/init.php');

// Hooks

add_action( 'init', 'np_init');
add_action( 'admin_init', 'product_admin_init' );

//Shortcodes
