<?php

function nda_enqueue() {
  wp_register_style( 'nda_materialize', get_template_directory_uri() . '/assets/css/materialize.min.css' );
  wp_register_style( 'nda_main', get_template_directory_uri() . '/assets/css/main.css' );
  wp_register_style( 'nda_unslider', get_template_directory_uri() . '/assets/css/unslider.css' );
  wp_register_style( 'nda_unslider_dots', get_template_directory_uri() . '/assets/css/unslider-dots.css' );
  wp_register_style( 'nda_material_icons', 'http://fonts.googleapis.com/icon?family=Material+Icons' );

  wp_enqueue_style( 'nda_materialize' );
  wp_enqueue_style( 'nda_main' );
  wp_enqueue_style( 'nda_unslider' );
  wp_enqueue_style( 'nda_unslider_dots' );
  wp_enqueue_style( 'nda_material_icons' );

  wp_register_script( 'nda_materialize', get_template_directory_uri() . '/assets/js/materialize.min.js', array(), false, true );
  wp_register_script( 'nda_scrollreveal', get_template_directory_uri() . '/assets/js/scrollreveal.min.js', array(), false, true );
  wp_register_script( 'nda_main', get_template_directory_uri() . '/assets/js/main.js', array(), false, true );
  wp_register_script( 'nda_unslider', get_template_directory_uri() . '/assets/js/unslider-min.js', array(), false, true );


  wp_deregister_script('jquery');
  wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-2.1.1.min.js', array(), false, true );

  wp_enqueue_script( 'jquery' );

  wp_enqueue_script( 'nda_materialize' );
  wp_enqueue_script( 'nda_scrollreveal' );
  wp_enqueue_script( 'nda_main' );
  wp_enqueue_script( 'nda_unslider' );
}

?>
