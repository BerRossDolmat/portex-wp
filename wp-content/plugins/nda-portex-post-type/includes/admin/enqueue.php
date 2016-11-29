<?php

  // Register admin styles and scripts

function nda_admin_enqueue() {

  // Admin styles and scripts

  wp_register_style( 'nda_bootstrap', plugins_url('/assets/css/bootstrap.min.css', NDA_POST_TYPE_PLUGIN_URL ) );
  wp_register_style( 'nda_bootstrap_theme', plugins_url('/assets/css/bootstrap-theme.min.css', NDA_POST_TYPE_PLUGIN_URL ) );
  wp_enqueue_style( 'nda_bootstrap' );
  wp_enqueue_style( 'nda_bootstrap_theme' );

  wp_register_script( 'nda_bootstrap', plugins_url('/assets/js/bootstrap.min.js', NDA_POST_TYPE_PLUGIN_URL ), array(), false, true );
  wp_enqueue_script( 'nda_bootstrap' );

  // Global variables

  global $typenow, $pagenow;


  // Scripts and styles for admin product page

  if($typenow == 'product' ) {
    wp_register_script( 'nda_product', plugins_url('/assets/js/admin-product.js', NDA_POST_TYPE_PLUGIN_URL ), array(), false, true );

    wp_enqueue_script( 'nda_product' );
  }

  // Scripts and styles for admin slider page

  if($pagenow == 'options-general.php') {
    wp_register_script( 'nda_main_slider', plugins_url('/assets/js/admin-slider.js', NDA_POST_TYPE_PLUGIN_URL ), array(), false, true );

    wp_enqueue_script( 'nda_main_slider' );
  }

}
