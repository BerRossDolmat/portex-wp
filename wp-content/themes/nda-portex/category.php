<?php

  get_header();

  // Get current category object
  $thisCat = get_category( get_query_var( 'cat' ) );

  // Comparison function for array filtering
  function compare($elm1, $elm2) {
    if ($elm1->priority === $elm2->priority) {
         return 0;
    }

    return ($elm1->priority < $elm2->priority) ? -1 : 1;
  }

  // Arguements for category query
  $args = array(
    'orderby' => 'name',
    'child_of' => $thisCat->cat_ID,
    'hide_empty' => 0,
    'exclude' => '1',
    'depth' => 1
  );

  $categories = get_categories( $args );

  $ancestors = get_ancestors( $thisCat->cat_ID, 'category' );

?>

<div class="container">

  <!-- Breadcrumbs generation -->

  <nav class="breadcrumbs-wrapper">
    <div class="nav-wrapper">
      <div class="row">
        <div class="col s11 offset-s1">
          <a href="<?php echo home_url(); ?>" class="breadcrumb">Главная</a>
          <?php
            if( $ancestors ) {
              $ancestors = array_reverse( $ancestors );
              foreach( $ancestors as $ancestor ) {
                $ancestorTitle = get_cat_name( $ancestor );
                if (mb_strlen( $ancestorTitle ) > 10) {
                  $ancestorTitle = mb_substr( $ancestorTitle, 0, 20 ) . '...';
                }
                ?>
                  <a href="<?php echo get_category_link( $ancestor ); ?>" class="breadcrumb"><?php echo $ancestorTitle; ?></a>
                <?php
              }

            }
          ?>
          <a href="#" class="breadcrumb breadcrumb-active"><?php echo get_cat_name( $thisCat->cat_ID ) ?></a>
        </div>
      </div>
    </div>
  </nav>

  <div class="row">

    <?php

    $thisCat = get_category(get_query_var( 'cat' ));

    $args = array(
      'orderby' => 'name',
      'parent' => $thisCat->cat_ID,
      'hide_empty' => 0,
      'exclude' => '1',
      'depth' => 1
    );

    $categories = get_categories( $args );

    foreach ($categories as $category) {
      $priority = get_option( "taxonomy_$category->term_id" );
      if(isset($priority['priority'])) {
        $category->priority = $priority['priority'];
      }
    }

    $args = array( 'post_type' => 'product', 'category__in' => $thisCat->term_id, 'numberposts' => -1 );

    $posts = get_posts($args);

    foreach ($posts as $post) {
      $priority = get_post_meta( get_the_ID(), 'product_data', true );
      if(isset($priority['priority'])) {
        $post->priority = $priority['priority'];
      }
    }

    $terms =[];
    $i = 0;
    foreach( $posts as $post) {
      $terms[$i] = $post;
      $i++;
    }
    foreach ($categories as $category) {
      $terms[$i] = $category;
      $i++;
    }
    
    usort($terms, 'compare');

    ?>

    <div class="text-align-center devider">
      <h1 class="h1-for-groups-index"><?php echo $thisCat->cat_name; ?></h1>
      <span>_______________</span>
    </div>

    <?php

    foreach ($terms as $term) {
      if( $term->taxonomy == 'category') {
        $term_id = $term->term_id;
        $image   = category_image_src( array( 'term_id'=>$term_id, 'size'=>'thumbnail' ) , false );

        ?>
          <div class="minicard animate-fadein">
            <a href="<?php echo get_category_link( $term->term_id ); ?>">
              <div class="card hoverable category-card" title="<?php echo $term->category_description;?>">
                <?php
                  if ($image) {
                    ?>
                    <div class="card-image image-padding">
                      <img class="responsive-img img-border" src="<?php echo $image; ?>">
                    </div>
                    <?php
                  }
                ?>
                <div class="card-content-text-container">
                  <span><?php echo $term->name; ?></span>
                </div>
              </div>
            </a>
          </div>
        <?php
        continue;
      }
      if ( $term->post_type == 'product') {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $term->ID ), 'thumbnail' );
        ?>
      <div class="minicard animate-fadein">
        <a href="<?php echo get_permalink($term); ?>">
          <div class="card hoverable category-card">
            <?php
              if ( $image ) {
                ?>
                <div class="card-image image-padding">
                  <img class="responsive-img img-border" src="<?php echo $image[0]; ?>">
                </div>
                <?php
              }
            ?>
            <div class="card-content-text-container">
              <span><?php echo $term->post_title; ?></span>
            </div>
          </div>
        </a>
      </div>
      <?php
    }
  }
?>

  </div>

</div>

<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/index-category.js"></script>