<?php

function product_admin_init() {

  include( 'create-metaboxes.php' );
  include( 'product-options.php' );
  include( 'enqueue.php' );

  add_action( 'add_meta_boxes_product', 'np_create_metaboxes' );
  add_action( 'admin_enqueue_scripts', 'nda_admin_enqueue' );
}
