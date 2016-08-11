<?php

// Metabox add function arguements

function np_create_metaboxes() {
  add_meta_box(
    'np_product_options_mb',
    'Опции товара',
    'np_product_options_mb',
    'product',
    'normal',
    'high'
  );
}
