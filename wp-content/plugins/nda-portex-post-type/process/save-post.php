<?php

function nda_save_post_admin( $post_id, $post, $update ) {
  if( !$update ) {
    return;
  }

  $product_data = array();
  $product_data['certificate'] = sanitize_text_field( $_POST['nda_product_certificate']);
  $product_data['meta_title'] = sanitize_text_field( $_POST['nda_product_meta_title']);
  $product_data['meta_description'] = sanitize_text_field( $_POST['nda_product_meta_description']);
  $product_data['meta_keywords'] = sanitize_text_field( $_POST['nda_product_meta_keywords']);
  $product_data['img_option'] = sanitize_text_field( $_POST['nda_img_radio_option']);
  if ( $product_data['img_option'] ==='different' ) {
    $product_data['different_img_url'] = sanitize_text_field( $_POST['nda_different_img_url']);
    $product_data['different_img_title'] = sanitize_text_field( $_POST['nda_different_img_title']);
  }
  if ( $product_data['img_option'] ==='slider' ) {
    $product_data['slider_img_urls'] = sanitize_text_field( $_POST['nda_slider_img_urls']);
    $product_data['slider_img_titles'] = sanitize_text_field( $_POST['nda_slider_img_titles']);
  }


  update_post_meta( $post_id, 'product_data', $product_data );
}
