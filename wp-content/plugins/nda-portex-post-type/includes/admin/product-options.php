<?php

function np_product_options_mb( $post ) {
  $product_data = get_post_meta( $post->ID, 'product_data', true );

  if( !$product_data ) {
    $product_data['certificate'] = '';
  }

  ?>
  <div class="form-group">
    <label>Введите имя файла сертификата РУ</label>
    <input class="form-control" type="text" name="nda_product_certificate" value="<?php echo $product_data['certificate']; ?>">
  </div>
  <?php
}
