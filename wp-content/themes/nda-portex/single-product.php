<?php
// retrieves the attachment ID from the file URL
function get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}

get_header();

// Get current product parent category
$thisCat = get_the_category();

// Get ancestors of parent category

$ancestors = get_ancestors( $thisCat[0]->term_id, 'category' );

// Get product data

$product_data = get_post_meta( get_the_ID(), 'product_data', true );

// Check for slider img urls

if (isset($product_data['slider_img_urls'])) {
  $product_data['slider_img_urls'] = json_decode($product_data['slider_img_urls']);
}
?>

    <div class="container">

        <!-- Create breadcrumbs -->
        
        <nav class="breadcrumbs-wrapper">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s11 offset-s1">
                        <a href="<?php echo home_url(); ?>" class="breadcrumb">Главная</a>
                        <?php
                            if( $ancestors ) {
                                $ancestors = array_reverse($ancestors);
                                foreach( $ancestors as $ancestor ) {
                                    $category_meta = get_option( "taxonomy_$ancestor" );
                                    $ancestorTitle = $category_meta['breadcrumb'];
                                    if (mb_strlen($ancestorTitle) > 10) {
                                        $ancestorTitle = mb_substr($ancestorTitle, 0, 20) . '...';
                                    }
                                    ?>
                                        <a href="<?php echo get_category_link( $ancestor ); ?>" class="breadcrumb">
                                            <?php echo $ancestorTitle; ?>
                                        </a>
                                    <?php
                                    }

                            }
            
            // check for main category that has not to be shown in breadcrumbs
            
            if ($thisCat[0]->cat_ID !== 1) {
                $term_id = $thisCat[0]->term_id;
                $category_meta = get_option( "taxonomy_$term_id" );
                ?>
                <a href="<?php echo get_category_link( $thisCat[0]->cat_ID ); ?>" class="breadcrumb">
                    <?php echo $category_meta['breadcrumb']; ?>
                </a>
                <?php
            }
            ?>
                <a href="#" class="breadcrumb breadcrumb-active">
                    <?php echo $product_data['breadcrumb']; ?>
                </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- End of breadcrumbs -->
        
        <div class="row">

            <!-- Main card container -->

            <div class="col s12">
                <div class="card product">
                    <div class="row">
                        <div class="text-align-center divider-product">
                            <h1 class="h1-for-product product_title">
                                <?php echo the_title(); ?>
                            </h1>
                            <span>_______________</span>
                        </div>
                        <?php

            // Check slider type
            
            // If slider type is standard

            if ( (has_post_thumbnail() && $product_data['img_option'] === 'standard') || (has_post_thumbnail() && $product_data['img_option'] === 'undefined') ) {
              ?>
                <div class="card-image col s8 offset-s2 m6 offset-m3 l4 offset-l4">
                    <?php 
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        echo wp_get_attachment_image( $post_thumbnail_id, 'large', "", array( "class" => "responsive-img" ) );  
                    ?>
                </div>
                <?php
            }

            // If slider type is different

            if ($product_data['img_option'] === 'different') {
                $img_id = get_image_id($product_data['different_img_url']);
                ?>
                    <div class="card-image col s8 offset-s2 m6 offset-m3 l4 offset-l4">
                        <?php echo wp_get_attachment_image( $img_id, 'large', "", array( "class" => "responsive-img" ) ); ?>
                    </div>
                <?php
            }

            // If slider type is slider

            if ($product_data['img_option'] === 'slider') {
              
              // Create slider holder

              ?>
                <div id="slider-holder" hidden>
                    <div class="card-image col s12 m10 offset-m1 l6 offset-l3" id="slideshow">
                        <ul class="thumbs">
                            <?php
                                foreach ($product_data['slider_img_urls'] as $url) {
                                    $img_id = get_image_id($url);
                                    ?>
                                        <li>
                                            <a href="<?php echo $url;?>">
                                                <?php echo wp_get_attachment_image( $img_id); ?>
                                            </a>
                                        </li>
                                        <?php
                                }
                                        ?>
                        </ul>
                    </div>

                    <!-- Create slider thumbnails -->
                    
                    <div class="col s12 m10 offset-m1 l6 offset-l3" id="slideshow-thumbs-holder">
                        <ul id="slideshow-thumbs" class="slider-thumbs-horizontal">
                            <?php
                                $i = 0;
                                foreach ($product_data['slider_img_urls'] as $url) {
                                    $img_id = get_image_id($url);
                                ?>
                                    <li>
                                        <a href="<?php echo $url; ?>" data-desoslide-index="<?php echo $i; ?>">
                                            <?php echo wp_get_attachment_image( $img_id ); ?>
                                        </a>
                                    </li>
                                <?php
                                     $i++;
                                }
                                ?>
                        </ul>
                    </div>
                </div>
                <?php
            }
            // Start rendering content card
          ?>
                <div class="card-content">
                    <div class="row">
                        <div class="text-align-center divider-product-description col s12" id="product-description">
                            <h2 class="h2-for-product-description">Описание продукта</h2>
                            <span>_______________</span>
                        </div>

                        <div id="product-content" hidden class="col s12 m10 offset-m1">
                            <?php echo $post->post_content; ?>
                        </div>
                        
                        <?php
                            
                            // Check for attached pdf files

                            if (isset($product_data['attached_pdf_urls'])
                            && isset($product_data['attached_pdf_names']) 
                            && ($product_data['attached_pdf_names'] != '')
                            && ($product_data['attached_pdf_urls'] != '')) {
                                $product_data['attached_pdf_urls'] = json_decode($product_data['attached_pdf_urls']);
                                $product_data['attached_pdf_names'] = json_decode($product_data['attached_pdf_names']);
                                ?>
                                <div class="col s12 m10 offset-m1 text-align-center" id="attached-pdfs">
                                    <div class="divider-span">
                                        <span>_______________</span>
                                    </div>
                                    <h6>Файлы, связанные с товаром <b><?php echo the_title(); ?></b></h6>
                                    <div class="pdf-collection-container">
                                    <div class="collection">
                                <?php
                                $i = 0;
                            // Render download pdfs block

                                foreach($product_data['attached_pdf_urls'] as $pdf) {
                                    ?>
                                    <a download href="<?php echo $product_data['attached_pdf_urls'][$i]; ?>" class="pdf-download-link collection-item">
                                        Скачать файл - <?php echo $product_data['attached_pdf_names'][$i]; ?>
                                    </a>
                                    <?php
                                    $i++;
                                }
                            ?>  </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col s12 m10 offset-m1" id="cert-and-order">
                                <div class="row">
                                    <?php

                // Check if certificate exists
                if(!empty($product_data['certificate_url'])){
                  ?>
                    <div class="col s5 m5 l3">
                        <div class="download-ru-container">
                            <a href="<?php echo $product_data['certificate_url']; ?>" download>
                                <div class="download-ru-icon inline-block"><i class="material-icons">file_download</i></div>
                                <div class="inline-block download-ru-text">Скачать РУ</div>
                            </a>
                        </div>
                    </div>
                    <div class="col s7 m6 offset-m1 l4 offset-l5 text-align-right">
                        <a class="btn waves-effect waves-light blue order-btn modal-trigger" href="#modal-add-order">Оформить заказ</a>
                    </div>
                    <?php
              } else {
                ?>
                <div class="col s7 offset-s5 m6 offset-m6 l4 offset-l8 text-align-right">
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
    </div>
    <div hidden>
        <input type="hidden" id="minified" value="<?php echo $product_data['minified'] ?>">
    </div>
    <div hidden>
        <input type="hidden" id="slider_left" value="<?php echo $product_data['slider_left'] ?>">
    </div>

    <!-- Add order modal -->

    <div id="modal-add-order" class="modal modal-order modal-fixed-footer">
        <div class="close-symbol"><a href="#" class="modal-action modal-close">&#10006;</a></div>
        <div class="modal-content">
            <form class="row" onsubmit="newOrder(event)">
                <h5>Оформление заказа</h5>
                <div class="col s12" id="modalPlaceForTables">

                </div>
                <div class="col s12 m12 l6">
                    <div class="input-field col s12">
                        <input id="name-order" type="text" required class="validate" oninvalid="this.setCustomValidity('Представьтесь пожалуйста')" oninput="setCustomValidity('')">
                        <label for="name-bottom">Представьтесь пожалуйста</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="email-order" type="email" required class="validate" oninvalid="this.setCustomValidity('Введите Ваш email')" oninput="setCustomValidity('')">
                        <label for="email-order">Ваш Email</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="tel-order" type="tel" class="validate" placeholder="+7 XXX XXX-XX-XX">
                        <label for="tel-order" class="active">Ваш номер телефона</label>
                    </div>
                    <div class="file-field input-field col s12">
                        <div class="btn" style="background-color: #0091ea;">
                            <span>Реквизиты</span>
                            <input type="file" id="req-file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Приложить файл с реквизитами">
                        </div>
                        <div hidden id="error-filesize">
                            <p>Размер файла превышает 10 мегабайт</p>
                        </div>
                        <div hidden id="error-filetype">
                            <p>Файл должен быть одного из следующих типов: .pdf, .xls, .doc, .jpg</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l6">
                    <div class="input-field col s12">
                        <textarea id="message-order" class="materialize-textarea" rows=30></textarea>
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
