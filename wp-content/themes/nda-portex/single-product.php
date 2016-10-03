<?php

get_header();

// Get current product parent category
$thisCat = get_the_category();

// Get ancestors of parent category
$ancestors = get_ancestors( $thisCat[0]->term_id, 'category' );

// Get product data
$product_data = get_post_meta( get_the_ID(), 'product_data', true );
if (isset($product_data['slider_img_urls'])) {
  $product_data['slider_img_urls'] = json_decode($product_data['slider_img_urls']);
}
?>

<div class="container">
  <nav class="breadcrumbs-wrapper">
    <div class="nav-wrapper">
      <div class="row">
        <div class="col s11 offset-s1">
          <a href="<?php echo home_url(); ?>" class="breadcrumb">Главная</a>
          <?php
            if( $ancestors ) {
              $ancestors = array_reverse($ancestors);
              foreach( $ancestors as $ancestor ) {

                $ancestorTitle = get_cat_name( $ancestor );
                if (mb_strlen($ancestorTitle) > 10) {
                  $ancestorTitle = mb_substr($ancestorTitle, 0, 20) . '...';
                }
                ?>
                  <a href="<?php echo get_category_link( $ancestor ); ?>" class="breadcrumb"><?php echo $ancestorTitle; ?></a>
                <?php
              }

            }
            // check for main category that has not to be shown in breadcrumbs
            if ($thisCat[0]->cat_ID !== 1) {
              ?>
              <a href="<?php echo get_category_link( $thisCat[0]->cat_ID ); ?>" class="breadcrumb"><?php echo $thisCat[0]->cat_name; ?></a>
              <?php
            }
          ?>
          <a href="#" class="breadcrumb breadcrumb-active"><?php echo the_title(); ?></a>
        </div>
      </div>
    </div>
  </nav>

  <div class="row">

    <div class="col s12">
      <div class="card product">
        <div class="row">
          <div class="text-align-center devider">
            <h1 class="h1-for-groups-index product_title"><?php echo the_title(); ?></h1>
            <span>_______________</span>
          </div>
          <?php
            if ( (has_post_thumbnail() && $product_data['img_option'] === 'standard') || (has_post_thumbnail() && $product_data['img_option'] === 'undefined') ) {
              ?>
              <div class="card-image col s4 offset-s4">
                <img src="<?php the_post_thumbnail_url('large'); ?>" class="responsive-img"></img>
              </div>
              <?php
            }
            if ($product_data['img_option'] === 'different') {
              ?>
              <div class="card-image col s4 offset-s4">
                <img src="<?php echo $product_data['different_img_url']; ?>" class="responsive-img"></img>
              </div>
              <?php
            }
            if ($product_data['img_option'] === 'slider') {
              ?>
              <div class="card-image col s6 offset-s3" id="slideshow">
                <ul class="thumbs">
                  <?php
                    foreach ($product_data['slider_img_urls'] as $url) {
                      ?>
                      <li>
                        <a href="<?php echo $url;?>">
                          <img src="<?php echo $url;?>">
                        </a>
                      </li>
                      <?php
                    }
                      ?>
                </ul>
              </div>

              <div class="col s6 offset-s3">
                <ul id="slideshow-thumbs" class="slider-thumbs-horizontal">
                  <?php
                  foreach ($product_data['slider_img_urls'] as $url) {
                    $i = 0;
                    ?>
                    <li>
                      <a href="<?php echo $url; ?>" data-desoslide-index="<?php echo $i; ?>">
                        <img src="<?php echo $url; ?>">
                      </a>
                    </li>
                    <?php
                    $i++;
                  }
                  ?>
                </ul>
              </div>
              <?php
            }
          ?>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="text-align-center devider">
              <h2 class="h1-for-groups-index">Описание продукта</h2>
              <span>_______________</span>
            </div>

            <div id="product-content" class="col s10 offset-s1">
              <?php echo $post->post_content; ?>
            </div>
            <div class="col s10 offset-s1">
              <div class="row">
                <?php

                // Check if certificate exists
                if(!empty($product_data['certificate_url'])){
                  ?>
                  <div class="col s1 m1 l2">
                    <div class="download-ru-container">
                      <a href="<?php echo $product_data['certificate_url']; ?>" download>
                        <div class="download-ru-icon inline-block"><i class="material-icons">file_download</i></div>
                        <div class="inline-block download-ru-text">Скачать РУ</div>
                      </a>
                    </div>
                  </div>
                  <div class="col s7 offset-s4 m5 offset-m6 l3 offset-l7">
                    <a class="btn waves-effect waves-light blue order-btn modal-trigger" href="#modal-add-order">Оформить заказ</a>
                  </div>
                <?php
              } else {
                ?>
                <div class="col s7 offset-s5 m5 offset-m7 l3 offset-l9">
                  <a class="btn waves-effect waves-light blue order-btn modal-trigger" href="#modal-add-order">Оформить заказ</a>
                </div>
                <?php
              }
              ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modal-add-order" class="modal modal-order modal-fixed-footer">
  <div class="close-symbol"><a href="#" class="modal-action modal-close">&#10006;</a></div>
  <div class="modal-content">
    <form class="row" onsubmit="newOrder(event)">
      <h5>Оформление заказа</h5>
      <div class="col s12" id="modalPlaceForTables">

      </div>
      <div class="col s12 m6">
        <div class="input-field col s12">
          <input id="name-order" type="text" required class="validate"
            oninvalid="this.setCustomValidity('Представьтесь пожалуйста')"
            oninput="setCustomValidity('')">
          <label for="name-bottom">Представьтесь пожалуйста</label>
        </div>
        <div class="input-field col s12">
          <input id="email-order" type="email" required class="validate"
            oninvalid="this.setCustomValidity('Введите Ваш email')"
            oninput="setCustomValidity('')">
          <label for="email-order">Ваш Email</label>
        </div>
        <div class="input-field col s12">
          <input id="tel-order" type="tel" class="validate" placeholder="+7 XXX XXX-XX-XX">
          <label for="tel-order" class="active">Ваш номер телефона</label>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="input-field col s12">
          <textarea id="message-order" class="materialize-textarea" rows=25></textarea>
          <label for="message-order">Текст сообщения</label>
        </div>
      </div>
      <div class="input-field col s12">
        <button type="submit" class="btn waves-effect waves-light right contacts-submit-btn blue">Подтвердить заказ
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/product.js"></script>
