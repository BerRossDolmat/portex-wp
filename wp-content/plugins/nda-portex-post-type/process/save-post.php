<?php

function nda_save_post_admin( $post_id, $post, $update ) {
  if( !$update ) {
    return;
  }

  $product_data = array();
  $product_data['certificate'] = sanitize_text_field( $_POST['nda_product_certificate']);

  update_post_meta( $post_id, 'product_data', $product_data );
}
