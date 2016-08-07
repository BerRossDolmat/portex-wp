<?php

function product_admin_init() {

  include( 'create-metaboxes.php' );
  include( 'product-options.php' );
  include( 'enqueue.php' );
  include( 'add-category-fields.php' );

  add_action( 'add_meta_boxes_product', 'np_create_metaboxes' );
  add_action( 'admin_enqueue_scripts', 'nda_admin_enqueue' );
  add_action( 'category_add_form_fields', 'nda_category_add_new_meta_field', 10, 2 );
  add_action( 'category_edit_form_fields', 'nda_category_add_new_meta_field', 10, 2 );
}
