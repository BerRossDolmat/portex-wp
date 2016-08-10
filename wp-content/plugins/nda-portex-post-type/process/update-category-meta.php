<?php

function save_category_custom_meta( $term_id ) {

  $category_data = array();
  $category_data['meta_title'] = sanitize_text_field( $_POST['nda_category_meta_title']);
  $category_data['meta_description'] = sanitize_text_field( $_POST['nda_category_meta_description']);
  $category_data['meta_keywords'] = sanitize_text_field( $_POST['nda_category_meta_keywords']);
  $category_data['priority'] = sanitize_text_field( $_POST['nda_category_priority']);

		// Save the option array.
	update_option( "taxonomy_$term_id", $category_data );
}
