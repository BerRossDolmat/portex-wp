<?php

get_header();

$thisCat = get_the_category();

$ancestors = get_ancestors( $thisCat[0]->term_id, 'category' );
$product_data = get_post_meta( get_the_ID(), 'product_data', true );
$product_data['slider_img_urls'] = json_decode($product_data['slider_img_urls']);
// print_r($product_data);
// die();
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
            <h1 class="h1-for-groups-index"><?php echo the_title(); ?></h1>
            <span>_______________</span>
          </div>
          <?php
            if ( (has_post_thumbnail() && $product_data['img_option'] === 'standard') || (has_post_thumbnail() && $product_data['img_option'] === undefined) ) {
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
              <h1 class="h1-for-groups-index">Описание продукта</h1>
              <span>_______________</span>
            </div>

            <div id="product-content" class="col s10 offset-s1" hidden>
              <?php echo $post->post_content; ?>
            </div>
            <div class="col s10 offset-s1">
              <div class="row">
                <?php
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

<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/product.js"></script>
