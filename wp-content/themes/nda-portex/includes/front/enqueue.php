<?php

function nda_enqueue() {

  // Register front-end styles
  wp_register_style( 'nda_materialize', get_template_directory_uri() . '/assets/css/materialize.min.css' );
  wp_register_style( 'nda_main', get_template_directory_uri() . '/assets/css/main.css' );
  wp_register_style( 'nda_unslider', get_template_directory_uri() . '/assets/css/unslider.css' );
  wp_register_style( 'nda_unslider_dots', get_template_directory_uri() . '/assets/css/unslider-dots.css' );
  wp_register_style( 'nda_material_icons', 'http://fonts.googleapis.com/icon?family=Material+Icons' );
  wp_register_style( 'nda_desoslider', get_template_directory_uri() . '/assets/css/jquery.desoslide.min.css' );
  wp_register_style( 'nda_animate', get_template_directory_uri() . '/assets/css/animate.min.css' );

  // Enqueue front-end styles
  wp_enqueue_style( 'nda_materialize' );
  wp_enqueue_style( 'nda_main' );
  wp_enqueue_style( 'nda_unslider' );
  wp_enqueue_style( 'nda_unslider_dots' );
  wp_enqueue_style( 'nda_material_icons' );
  wp_enqueue_style( 'nda_desoslider' );
  wp_enqueue_style( 'nda_animate' );

  // Register front-end scripts
  wp_register_script( 'nda_materialize', get_template_directory_uri() . '/assets/js/materialize.min.js', array(), false, true );
  wp_register_script( 'nda_scrollreveal', get_template_directory_uri() . '/assets/js/scrollreveal.min.js', array(), false, true );
  wp_register_script( 'nda_main', get_template_directory_uri() . '/assets/js/main.js', array(), false, true );
  wp_register_script( 'nda_unslider', get_template_directory_uri() . '/assets/js/unslider-min.js', array(), false, true );
  wp_register_script( 'nda_desoslider', get_template_directory_uri() . '/assets/js/jquery.desoslide.min.js', array(), false, true );
  
  
  // Register new jquery version
  wp_deregister_script('jquery');
  wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-2.1.1.min.js', array(), false, true );
  wp_enqueue_script( 'jquery' );

  // Scripts for index, category and product pages
  
  if ( is_home() ) {
    wp_register_script( 'nda_index_category', get_template_directory_uri() . '/assets/js/index-category.js', array(), false, true );
    wp_enqueue_script( 'nda_index_category' );
  }
  if( is_category() ) {
    wp_register_script( 'nda_index_category', get_template_directory_uri() . '/assets/js/index-category.js', array(), false, true );
    wp_enqueue_script( 'nda_index_category' );
  }
  if( is_singular() ) {
    wp_register_script( 'nda_product', get_template_directory_uri() . '/assets/js/product.js', array(), false, true );
    wp_enqueue_script( 'nda_product' );
  }
  
  // Enqueue front-end scripts
  wp_enqueue_script( 'nda_materialize' );
  wp_enqueue_script( 'nda_scrollreveal' );
  wp_enqueue_script( 'nda_main' );
  wp_enqueue_script( 'nda_unslider' );
  wp_enqueue_script( 'nda_desoslider' );
}

?>
