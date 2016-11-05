<?php

  // Function updates post meta while updating or saving post_type of product

function nda_save_post_admin( $post_id, $post, $update ) {

  // Update action check

  if( !$update ) {
    return;
  }

  // Saving product meta

  $product_data = array();
  $product_data['certificate_title'] = sanitize_text_field( $_POST['nda_product_certificate_title']);
  $product_data['certificate_url'] = sanitize_text_field( $_POST['nda_product_certificate_url']);
  $product_data['meta_title'] = sanitize_text_field( $_POST['nda_product_meta_title']);
  $product_data['meta_description'] = sanitize_text_field( $_POST['nda_product_meta_description']);
  $product_data['meta_keywords'] = sanitize_text_field( $_POST['nda_product_meta_keywords']);
  $product_data['img_option'] = sanitize_text_field( $_POST['nda_img_radio_option']);
  if (isset($_POST['nda_product_minified'])) {
    $product_data['minified'] = 'true';
  } else {
    $product_data['minified'] = 'false';
  }
  if ($_POST['nda_product_breadcrumb'] === '') {

    $product_data['breadcrumb'] = sanitize_text_field( $post->post_title);
  } else {
    $product_data['breadcrumb'] = sanitize_text_field( $_POST['nda_product_breadcrumb']);
  }
  $product_data['title'] = sanitize_text_field( $_POST['nda_product_title']);
  

  // Image presentation mode check for different imgs mode

  if ( $product_data['img_option'] ==='different' ) {
    $product_data['different_img_url'] = sanitize_text_field( $_POST['nda_different_img_url']);
    $product_data['different_img_title'] = sanitize_text_field( $_POST['nda_different_img_title']);
  }

  // Image presentation mode check for slider mode

  if ( $product_data['img_option'] ==='slider' ) {
    $product_data['slider_img_urls'] = sanitize_text_field( $_POST['nda_slider_img_urls']);
    $product_data['slider_img_titles'] = sanitize_text_field( $_POST['nda_slider_img_titles']);
  }

  // Save product priority

  $product_data['priority'] = sanitize_text_field( $_POST['nda_product_priority']);

  // Update post meta

  update_post_meta( $post_id, 'product_data', $product_data );
}
?>