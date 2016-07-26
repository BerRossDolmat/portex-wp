<?php

get_header();

$thisCat = get_the_category();

$ancestors = get_ancestors( $thisCat[0]->term_id, 'category' );

$product_data = get_post_meta( get_the_ID(), 'product_data', true );

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
          ?>
          <a href="<?php echo get_category_link( $thisCat[0]->cat_ID ); ?>" class="breadcrumb"><?php echo $thisCat[0]->cat_name; ?></a>
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
            if ( has_post_thumbnail() ) {
              ?>
              <div class="card-image col s4 offset-s4">
                <img src="<?php the_post_thumbnail_url(); ?>" class="responsive-img"></img>
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
                <div class="col s1 m1 l2">
                  <div class="download-ru-container">
                    <a href="<?php echo home_url() . '/wp-content/uploads/certificates/' . $product_data['certificate']; ?>" download>
                      <div class="download-ru-icon inline-block"><i class="material-icons">file_download</i></div>
                      <div class="inline-block download-ru-text">Скачать РУ</div>
                    </a>
                  </div>
                </div>
                <div class="col s7 offset-s4 m5 offset-m6 l3 offset-l7">
                  <a class="btn waves-effect waves-light blue order-btn modal-trigger" href="#modal-add-order">Оформить заказ</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div id="modal-add-order" class="modal modal-order">
  <div class="modal-content">
    <form class="row" onsubmit="newOrderShowMessage();return false;">
      <h5>Оформление заказа</h5>
      <div class="col s12">
        <table class="bordered">
          <thead>
            <tr>
              <th>Заказать</th>
              <th class="width-15p" data-field="code">Код</th>
              <th class="width-85p" data-field="description">Описание</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td colspan="3" class="text-align-center">Набор для чрескожной трахеостомии UltraPerc</td>
            </tr>
            <tr>
              <td class="width-120">
                <a href="#" class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped" data-position="top" data-delay="150" data-tooltip="Уменьшить количество товара">-</a>
                <input type="text" class="order-input" placeholder="0">
                <a href="#" class="order-number-btn-plus waves-effect waves-blue blue tooltipped" data-position="top" data-delay="150" data-tooltip="Увеличить количество товара">+</a>
              </td>
              <td>100/561/070</td>
              <td>Набор для чрескожной трахеостомии UltraPerc с трахеостомической трубкой Blue Line Ultra (7 мм) и интродьюсером.</td>
            </tr>
            <tr>
              <td class="width-120">
                <a href="#" class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped" data-position="top" data-delay="150" data-tooltip="Уменьшить количество товара">-</a>
                <input type="text" class="order-input" placeholder="0">
                <a href="#" class="order-number-btn-plus waves-effect waves-blue blue tooltipped" data-position="top" data-delay="150" data-tooltip="Увеличить количество товара">+</a>
              </td>
              <td>100/561/080</td>
              <td>Набор для чрескожной трахеостомии UltraPerc с трахеостомической трубкой Blue Line Ultra (8 мм) и интродьюсером.</td>
            </tr>
            <tr>
              <td class="width-120">
                <a href="#" class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped" data-position="top" data-delay="150" data-tooltip="Уменьшить количество товара">-</a>
                <input type="text" class="order-input" placeholder="0">
                <a href="#" class="order-number-btn-plus waves-effect waves-blue blue tooltipped" data-position="top" data-delay="150" data-tooltip="Увеличить количество товара">+</a>
              </td>
              <td>100/561/090</td>
              <td>Набор для чрескожной трахеостомии UltraPerc с трахеостомической трубкой Blue Line Ultra (9 мм) и интродьюсером.</td>
            </tr>
            <tr>
              <td colspan="3" class="text-align-center">Набор для чрескожной трахеостомии UltraPerc и трахеостомической трубкой Suctionaid - каналом для санации надманжеточного пространства.</td>
            </tr>
              <td class="width-120">
                <a href="#" class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped" data-position="top" data-delay="150" data-tooltip="Уменьшить количество товара">-</a>
                <input type="text" class="order-input" placeholder="0">
                <a href="#" class="order-number-btn-plus waves-effect waves-blue blue tooltipped" data-position="top" data-delay="150" data-tooltip="Увеличить количество товара">+</a>
              </td>
              <td>100/563/070</td>
              <td>Набор для чрескожной трахеостомии UltraPerc с трахеостомической трубкой Blue Line Ultra Suctionaid с санацией надманжеточного пространства (7 мм) и интродьюсером.</td>
            </tr>
            <tr>
              <td class="width-120">
                <a href="#" class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped" data-position="top" data-delay="150" data-tooltip="Уменьшить количество товара">-</a>
                <input type="text" class="order-input" placeholder="0">
                <a href="#" class="order-number-btn-plus waves-effect waves-blue blue tooltipped" data-position="top" data-delay="150" data-tooltip="Увеличить количество товара">+</a>
              </td>
              <td>100/563/080</td>
              <td>	Набор для чрескожной трахеостомии UltraPerc с трахеостомической трубкой Blue Line Ultra Suctionaid с санацией надманжеточного пространства (8 мм) и интродьюсером.</td>
            </tr>
            <tr>
              <td class="width-120">
                <a href="#" class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped" data-position="top" data-delay="150" data-tooltip="Уменьшить количество товара">-</a>
                <input type="text" class="order-input" placeholder="0">
                <a href="#" class="order-number-btn-plus waves-effect waves-blue blue tooltipped" data-position="top" data-delay="150" data-tooltip="Увеличить количество товара">+</a>
              </td>
              <td>100/563/090</td>
              <td>Набор для чрескожной трахеостомии UltraPerc с трахеостомической трубкой Blue Line Ultra Suctionaid с санацией надманжеточного пространства (9 мм) и интродьюсером.</td>
            </tr>
          </tbody>
        </table>
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
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a>
  </div>
</div> -->


<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/product.js"></script>
