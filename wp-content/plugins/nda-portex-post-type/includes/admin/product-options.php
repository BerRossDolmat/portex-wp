<?php

function np_product_options_mb( $post ) {

  // Get post meta for current post

  $product_data = get_post_meta( $post->ID, 'product_data', true );

  // Post meta existence checks

  if( !$product_data ) {
    $product_data['certificate_title'] = '';
    $product_data['certificate_url'] = '';
    $product_data['meta_title'] = '';
    $product_data['meta_description'] = '';
    $product_data['meta_keywords'] = '';
    $product_data['img_option'] = 'standard';
  }
  if( !isset($product_data['priority']) ) {
    $product_data['priority'] = 10;
  }
  if( !isset($product_data['different_img_title'])) {
    $product_data['different_img_title'] = '';
  }
  if(!isset($product_data['different_img_url'])) {
    $product_data['different_img_url'] = '';
  }
  if (!isset($product_data['minified'])) {
    $product_data['minified'] = 'true';
  }
  if (!isset($product_data['slider_left'])) {
    $product_data['slider_left'] = 'false';
  }
  if(!isset($product_data['breadcrumb'])) {
    $product_data['breadcrumb'] = '';
  }
  if(!isset($product_data['title'])) {
    $product_data['title'] = '';
  }

  ?>

  <!-- Metabox template -->
  <h3>Основные опции товара</h3>
  <div class="row">
    <div class="col-xs-6">
      <h4>Тайтл</h4>
      <div class="form-group">
        <label>Тайтл</label>
        <input class="form-control" type="text" name="nda_product_title" value="<?php echo $product_data['title']; ?>">
      </div>
    </div>
    <div class="col-xs-6">
      <h4>Хлебные крошки</h4>
      <div class="form-group">
        <label>Имя в хлебных крошках</label>
        <input class="form-control" type="text" name="nda_product_breadcrumb" value="<?php echo $product_data['breadcrumb']; ?>">
      </div>
    </div>
  </div>

  <h4>Метаданные</h4>
  <div class="row">
    <div class="col-xs-6">
      <div class="form-group">
        <label>Meta Title</label>
        <input class="form-control" type="text" name="nda_product_meta_title" value="<?php echo $product_data['meta_title']; ?>">
      </div>
    </div>
    <div class="col-xs-6">
      <div class="form-group">
        <label>Meta Keywords</label>
        <input class="form-control" type="text" name="nda_product_meta_keywords" value="<?php echo $product_data['meta_keywords']; ?>">
      </div>
    </div>
    <div class="col-xs-12">
      <div class="form-group">
        <label>Meta Description</label>
        <input class="form-control" type="text" name="nda_product_meta_description" value="<?php echo $product_data['meta_description']; ?>">
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <h4>Сертификат</h4>
      <div class="form-group">
        <div class="col-xs-6">
          <button id="choose_certificate" class="btn btn-default">Выберите Сертификат</button>
        </div>
        <div class="col-xs-6">
          <input type="text" class="form-control" value="<?php echo $product_data['certificate_title'] ?>" disabled id="certificate_title">
        </div>
        <input type="hidden" value="<?php echo $product_data['certificate_title']; ?>" id="certificate_title_hidden" name="nda_product_certificate_title">
        <input type="hidden" value="<?php echo $product_data['certificate_url']; ?>" id="certificate-url" name="nda_product_certificate_url">
      </div>
    </div>
    <div class="col-xs-6 col-md-3">
      <h4>Минифицировать</h4>
      <div class="form-group">
        <label class="checkbox-inline" style="margin-top: 10px;"><input style="margin-top:0px;" type="checkbox" name="nda_product_minified" <?php echo $product_data['minified'] === 'true' ? 'checked' : '' ?> value="">Минифицировать</label>
      </div>
    </div>
    <div class="col-xs-6 col-md-3">
      <h4>Приоритет</h4>
      <div class="form-group">
        <input class="form-control" type="number" name="nda_product_priority" value="<?php echo $product_data['priority']; ?>">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-md-12">
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
            <button class="btn btn-default">Выберите изображение</button>
            <input type="text" value="<?php echo $product_data['different_img_title'] ?>" disabled id="different-image-input">
            <input type="hidden" value="<?php echo $product_data['different_img_url']; ?>" id="different-image-url" name="nda_different_img_url">
            <input type="hidden" value="<?php echo $product_data['different_img_title']; ?>" id="different-image-title" name="nda_different_img_title">
          </div>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="nda_img_radio_option" id="optionsRadios3" value="slider" style="margin-top: 0px;" <?php if($product_data['img_option'] === 'slider') echo 'checked'; ?>>
            Слайдер (Выберите изображения, из которых должен быть сформирован слайдер)
          </label>
          <div hidden id="slider-left-button">
            <h4>Слайдер слева</h4>
            <div class="form-group">
              <label class="checkbox-inline"><input style="margin-top:0px;" type="checkbox" name="nda_product_slider_left" id="product_slider_left" <?php echo $product_data['slider_left'] === 'true' ? 'checked' : '' ?> value="">Слайдер слева</label>
            </div>
          </div>
          <div id="slider-button" hidden style="width: 20%;">
            <button class="btn btn-default">Выберите изображения для слайдера</button>
            <div id="imgTitlesBlock" <?php if(!isset($product_data['slider_img_titles'])) echo 'hidden'; ?>>
              <h4>Выбранные файлы</h4>
              <ul class="list-group" id="imgTitles">
                <?php

                // Create list of chosen img titles

                if ($product_data['slider_img_titles']) {
                  $titles = json_decode($product_data['slider_img_titles']);
                  foreach($titles as $title) {
                    echo '<li class="list-group-item">' . $title . '</li>';
                  }
                }
                ?>
              </ul>
            </div>
            <input 
              type="hidden" 
              name="nda_slider_img_urls" 
              id="slider_img_urls" 
              value=<?php if ( isset( $product_data['slider_img_urls'] )) { echo $product_data['slider_img_urls'];} ?>>
            <input 
              type="hidden" 
              name="nda_slider_img_titles" 
              id="slider_img_titles" 
              value=<?php if ( isset( $product_data['slider_img_titles'] )){ echo $product_data['slider_img_titles'];} ?>>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-md-12">
      <h4>Добавить PDF файлы к товару </h4>
      <p>Файлы добавленные в этом пункте будут отображены в списке прицепленных файлов при просмотре. 
        Если файлы, указанные здесь, должны индексироваться поисковым движком сайта - установите галочку - "Индексировать" (по умолчанию - включена, замедляет работу базы данных) 
      </p>
        <button id="pdf-attach-button" class="btn btn-default">Добавить ПДФ файлы</button>
        <div id="pdfNamesBlock" <?php if(!isset($product_data['attached_pdf_names'])) echo 'hidden'; ?>>
          <h4>Выбранные PDF</h4>
          <ul class="list-group" id="pdfNames">
            <?php

            // Create list of chosen img titles

              if (isset($product_data['attached_pdf_names'])) {
                $names = json_decode($product_data['attached_pdf_names']);
                foreach($names as $name) {
                  echo '<li class="list-group-item">' . $name . '</li>';
                }
              }
            ?>
          </ul>
          <input 
            type="hidden" 
            name="nda_attached_pdf_urls" 
            id="attached_pdf_urls" 
            value=<?php if ( isset( $product_data['attached_pdf_urls'] )) { echo $product_data['attached_pdf_urls'];} ?>>
          <input 
            type="hidden" 
            name="nda_attached_pdf_names" 
            id="attached_pdf_names" 
            value=<?php if ( isset( $product_data['attached_pdf_names'] )){ echo $product_data['attached_pdf_names'];} ?>>
          
          <div class="form-group" style="padding-left: 10px;">
            <label class="checkbox-inline">
              <input 
                style="margin-top:0px;" 
                type="checkbox" 
                name="nda_index_pdf_checkbox" 
                id="product_index_pdf_checkbox" <?php if (isset($product_data['index_checkbox'])){echo $product_data['index_checkbox'] === 'false' ? '' : 'checked';} else {echo 'checked';} ?> 
                value="">
                Индексировать
              </label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
}
