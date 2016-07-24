<?php

function np_init() {
  $labels = array(
  'name'               => 'Товар',
  'singular_name'      => 'Товар',
  'menu_name'          => 'Товар',
  'name_admin_bar'     => 'Товар',
  'add_new'            => 'Добавить новый',
  'add_new_item'       => 'Добавить новый Товар',
  'new_item'           => 'Новый Товар',
  'edit_item'          => 'Редактировать Товар',
  'view_item'          => 'Просмотреть Товар',
  'all_items'          => 'Все Товары',
  'search_items'       => 'Искать Товар',
  'parent_item_colon'  => 'Parent Books:',
  'not_found'          => 'Товар не найден',
  'not_found_in_trash' => 'No books found in Trash.',
);

$args = array(
  'labels'             => $labels,
  'description'        => 'Товар portex-nda',
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'product' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_position'      => 20,
  'supports'           => array( 'title', 'editor', 'thumbnail' ),
  'taxonomies'         => array( 'category', 'post_tag' )
);

register_post_type( 'product', $args );

}
