<?php

function nda_admin_enqueue() {

  global $typenow;

  if($typenow !== 'product' ) {
    return;
  }

  wp_register_style( 'nda_bootstrap', plugins_url('/assets/css/bootstrap.min.css', NDA_POST_TYPE_PLUGIN_URL ) );
  wp_register_style( 'nda_bootstrap_theme', plugins_url('/assets/css/bootstrap-theme.min.css', NDA_POST_TYPE_PLUGIN_URL ) );
  wp_enqueue_style( 'nda_bootstrap' );
  wp_enqueue_style( 'nda_bootstrap_theme' );
}
