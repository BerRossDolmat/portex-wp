<?php

  get_header();

  $thisCat = get_category( get_query_var( 'cat' ) );

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


    ?>

    <div class="text-align-center devider">
      <h1 class="h1-for-groups-index"><?php echo $thisCat->cat_name; ?></h1>
      <span>_______________</span>
    </div>

    <?php

      foreach ( $categories as $category ) {

        $term_id = $category->term_id;
        $image   = category_image_src( array( 'term_id'=>$term_id ) , false );

        ?>
          <div class="width-20p animate-fadein">
            <a href="<?php echo get_category_link( $category->term_id ); ?>">
              <div class="card hoverable category-card" title="<?php echo $category->category_description;?>">
                <?php
                  if ($image) {
                    ?>
                    <div class="card-image image-padding">
                      <img class="responsive-img img-border" src="<?php echo $image; ?>">
                    </div>
                    <?php
                  }
                ?>
                <div class="card-content text-align-center card-content-text-container">
                  <p class="card-content-text"><?php echo $category->name; ?></p>
                </div>
              </div>
            </a>
          </div>
        <?php
      }
    ?>

  </div>

  <div class="row">

    <?php

    $args = array( 'post_type' => 'product', 'category__in' => $thisCat->term_id, 'posts_per_page' => 10 );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
      ?>
      <div class="width-20p animate-fadein">
        <a href="<?php echo get_permalink(); ?>">
          <div class="card hoverable category-card">
            <?php
              if ( has_post_thumbnail() ) {
                ?>
                <div class="card-image image-padding">
                  <img class="responsive-img img-border" src="<?php the_post_thumbnail_url(); ?>">
                </div>
                <?php
              }
            ?>
            <div class="card-content text-align-center card-content-text-container">
              <p class="card-content-text"><?php echo the_title(); ?></p>
            </div>
          </div>
        </a>
      </div>
      <?php
      endwhile;
      ?>

  </div>

</div>

<?php get_footer(); ?>
