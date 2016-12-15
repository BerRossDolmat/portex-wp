<!DOCTYPE html>
<?php
  // Check for user being admin
  if(!is_admin()) {
    echo '<html>';
  } else {
    echo '<html style="margin-top:0px !important;">';
  }
?>

  <head>
    <meta charset="utf-8" />

    <!-- Title for categories -->
    <?php
    if( is_home() ) {
      echo '<title>Portex</title>';
    }
    if( is_page('add-order') ) {
      echo '<title>Как оформить заказ</title>';
    }
    if( is_page('find-product') ) {
      echo '<title>Как найти продукцию</title>';
    }
    if( is_page('find-shipping') ) {
      echo '<title>Как найти отгрузку</title>';
    }
    if( is_category() ) {

      $thisCat = get_category( get_query_var( 'cat' ) );
      $cat_id = $thisCat->term_id;
      $category_data = get_option( "taxonomy_$cat_id" );
      if (!isset($category_data['title']) || $category_data['title'] === '' ) {
        echo '<title>Portex</title>';
      } else {
        echo '<title>' . $category_data['title'] . '</title>'; 
      }
      ?>
        <meta name="title" content="<?php echo $category_data['meta_title']; ?>">
        <meta name="description" content="<?php echo $category_data['meta_description']; ?>">
        <meta name="keywords" content="<?php echo $category_data['meta_keywords']; ?>">
      <?php
    }
    if( is_single() ) {
      $product_data = get_post_meta( get_the_ID(), 'product_data', true );
        if (!isset($product_data['title']) || $product_data['title'] === '' ) {
          echo '<title>Portex</title>';
        } else {
          echo '<title>' . $product_data['title'] . '</title>'; 
        }
        ?>
          <meta name="title" content="<?php echo $product_data['meta_title']; ?>">
          <meta name="description" content="<?php echo $product_data['meta_description']; ?>">
          <meta name="keywords" content="<?php echo $product_data['meta_keywords']; ?>">

        <?php
    }
    if( is_search() ) {
      echo '<title>Поиск на Portex</title>';
    }
      ?>
    
    
    <!--Import styles, fonts and icons-->
    <script src="https://use.fontawesome.com/e8f0f1e444.js"></script>

    <?php wp_head(); ?>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=0.8"/>
  </head>

  <body class="grey lighten-5">

    <div class="navbar-fixed">
      <nav>
        <div class="nav-wrapper blue lighten-2">
          <div class="container">
            <div class="row top-menu">
              <div class="col s2 m1 l1 zero-padding-right">
                <a href="<?php echo home_url( '/' ); ?>" class="logo">Portex</a>
              </div>

              <div class="col m8 offset-m2 s8 hide-on-desktop">
                <div class="right social-bar">
                  <div class="social-icons fb tooltipped" data-position="bottom" data-delay="50" data-tooltip="Мы в Facebook"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></div>
                    <div class="social-icons vk tooltipped" data-position="bottom" data-delay="50" data-tooltip="Мы в Контакте"><i class="fa fa-vk fa-lg" aria-hidden="true"></i></div>
                </div>
                <div class="right">
                  <div class="inline-block search-block" id="search-form-mobile">

                  </div>
                </div>
                <div class="right contact-us-hide">
                  <a href="#contactsModal" class="modal-trigger"><span class="contacts-btn-header">Контакты</span></a>
                </div>
              </div>

              <div class="col s1 m1">
                <a href="#" data-activates="mobile-sidebar" class="button-collapse show-on-mobile"><i class="material-icons">menu</i></a>
              </div>
              <div class="col l11 zero-padding-left hide-on-mobile header-links-container">

                <ul class="left menu-items">
                  <li><a href="<?php echo home_url( '/find-product' ); ?>">Найти продукцию</a></li>
                  <li><a href="<?php echo home_url( '/add-order' ); ?>">Оформить заказ</a></li>
                  <li><a href="<?php echo home_url( '/find-shipping' ); ?>">Найти отгрузку</a></li>
                  <li><a href="#">РУ и сертификаты</a></li>
                  <li><a href="#">Аптеки</a></li>
                </ul>

                <div class="right social-bar">
                    <div class="social-icons fb tooltipped" data-position="bottom" data-delay="50" data-tooltip="Мы в Facebook"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></div>
                    <div class="social-icons vk tooltipped" data-position="bottom" data-delay="50" data-tooltip="Мы в Контакте"><i class="fa fa-vk fa-lg" aria-hidden="true"></i></div>
                </div>

                <div class="right">
                  <div class="contacts-container">
                    <div class="inline-block" id="search-form-desktop">
                      <?php get_search_form(); ?>
                    </div>
                  </div>
                </div>

                <div class="right">
                  <div class="contacts-container">
                    <a href="#contactsModal" class="modal-trigger"><span class="contacts-btn-header">Контакты</span></a>
                  </div>
                </div>

              </div>
              <div>
                <ul class="side-nav" id="mobile-sidebar">
                  <li class="side-menu-li">Меню</li>
                  <li><a href="<?php echo home_url( '/' ); ?>">Главная</a></li>
                  <li><a href="<?php echo home_url( '/find-product' ); ?>">Найти продукцию</a></li>
                  <li><a href="<?php echo home_url( '/add-order' ); ?>">Оформить заказ</a></li>
                  <li><a href="<?php echo home_url( '/find-shipping' ); ?>">Найти отгрузку</a></li>
                  <li><a href="#">РУ и сертификаты</a></li>
                  <li><a href="#">Аптеки</a></li>
                  <li class="show-on-phone"><a href="#contactsModal" class="modal-trigger contacts-container">Контакты</a>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
