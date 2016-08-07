<?php

function np_product_options_mb( $post ) {
  $product_data = get_post_meta( $post->ID, 'product_data', true );
  // print_r($product_data);
  // die();
  if( !$product_data ) {
    $product_data['certificate'] = '';
    $product_data['meta_title'] = '';
    $product_data['meta_description'] = '';
    $product_data['meta_keywords'] = '';
    $product_data['img_option'] = 'standard';
    $product_data['different_img_title'] = '';
    $product_data['different_img_url'] = '';
  }

  ?>
  <h4>Сертификат</h4>
  <div class="form-group">
    <label>Введите имя файла сертификата РУ</label>
    <input class="form-control" type="text" name="nda_product_certificate" value="<?php echo $product_data['certificate']; ?>">
  </div>
  <h4>Метаданные</h4>
  <div class="form-group">
    <label>Meta Title</label>
    <input class="form-control" type="text" name="nda_product_meta_title" value="<?php echo $product_data['meta_title']; ?>">
  </div>
  <div class="form-group">
    <label>Meta Description</label>
    <input class="form-control" type="text" name="nda_product_meta_description" value="<?php echo $product_data['meta_description']; ?>">
  </div>
  <div class="form-group">
    <label>Meta Keywords</label>
    <input class="form-control" type="text" name="nda_product_meta_keywords" value="<?php echo $product_data['meta_keywords']; ?>">
  </div>
  <h4>Отображение изображения товара</h4>
  <div class="form-group">
    <div class="radio">
      <label>
        <input type="radio" name="nda_img_radio_option" id="optionsRadios1" value="standard" style="margin-top: 0px;" <?php if($product_data['img_option'] === 'standard') echo 'checked'; ?>>
        Обычное (1 картинка на миниатюре и странице товара)
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="nda_img_radio_option" id="optionsRadios2" value="different" style="margin-top: 0px;" <?php if($product_data['img_option'] === 'different') echo 'checked'; ?>>
        Разные изображения (На миниатюре будет отображаться основное изображение, выбранное в правой части этого окна, а на странице будет отображаться изображение выбранное ниже.)
      </label>
      <div id="different-image-button" hidden>
        <button>Выберите изображение</button>
        <input type="text" value="<?php echo $product_data['different_img_title'] ?>" disabled id="different-image-input">
        <input type="hidden" value="<?php echo $product_data['different_img_url']; ?>" id="different-image-url" name="nda_different_img_url">
        <input type="hidden" value="<?php echo $product_data['different_img_title']; ?>" id="different-image-title" name="nda_different_img_title">
      </div>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="nda_img_radio_option" id="optionsRadios3" value="slider" style="margin-top: 0px;" <?php if($product_data['img_option'] === 'slider') echo 'checked'; ?>>
        Слайдер (Выберите изображения, из которых должен быть сформирован слйдер)
      </label>
      <div id="slider-button" hidden style="width: 20%;">
        <button>Выберите изображения для слайдера</button>
        <div id="imgTitlesBlock" <?php if(!$product_data['slider_img_titles']) echo 'hidden'; ?>>
          <h4>Выбранные файлы</h4>
          <ul class="list-group" id="imgTitles">
            <?php
            if ($product_data['slider_img_titles']) {
              $titles = json_decode($product_data['slider_img_titles']);
              foreach($titles as $title) {
                echo '<li class="list-group-item">' . $title . '</li>';
              }
            }
            ?>
          </ul>
        </div>
        <input type="hidden" name="nda_slider_img_urls" id="slider_img_urls">
        <input type="hidden" name="nda_slider_img_titles" id="slider_img_titles">
      </div>
    </div>
  </div>

  <?php
}
