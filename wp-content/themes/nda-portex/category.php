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

  // Get all child categories for render loop later on

  $categories = get_categories( $args );

  // Get category ancestors to create breadcrumbs

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

              // Reverse array to match breadcrumbs order

              $ancestors = array_reverse( $ancestors );

              // Loop through ancestors to get titles

              foreach( $ancestors as $ancestor ) {
                $category_meta = get_option( "taxonomy_$ancestor" );
                $ancestorTitle = $category_meta['breadcrumb'];
                
                // Crop too long ancestor titles to match desired length
                
                if (mb_strlen( $ancestorTitle ) > 10) {
                  $ancestorTitle = mb_substr( $ancestorTitle, 0, 20 ) . '...';
                }
                // Echo breadcrumb
                ?>
                  <a href="<?php echo get_category_link( $ancestor ); ?>" class="breadcrumb"><?php echo $ancestorTitle; ?></a>
                <?php
              }
            }
            // Get current category id and echo it in last place
            $category_data = get_option( "taxonomy_$thisCat->cat_ID" );
          ?>
          <a href="#" class="breadcrumb breadcrumb-active"><?php echo $category_data['breadcrumb'] ?></a>
        </div>
      </div>
    </div>
  </nav>

    <?php

    // Get current category object

    $thisCat = get_category(get_query_var( 'cat' ));
    $thisCatImage = category_image_src( array( 'term_id'=>$thisCat->cat_ID, 'size'=>'medium' ) , false );
    // Take arguments for child categories
    
    $args = array(
      'orderby' => 'name',
      'parent' => $thisCat->cat_ID,
      'hide_empty' => 0,
      'exclude' => '1',
      'depth' => 1
    );

    // Get child categories

    $categories = get_categories( $args );

    // Get priority for each child category and add priority property for each category object

    foreach ($categories as $category) {
      $priority = get_option( "taxonomy_$category->term_id" );
      if(isset($priority['priority'])) {
        $category->priority = $priority['priority'];
      }
    }

    // Arguments for posts query

    $args = array( 'post_type' => 'product', 'category__in' => $thisCat->term_id, 'numberposts' => -1 );

    // Get child posts

    $posts = get_posts($args);

    // Get priority for each child post and add priority property for each post object

    foreach ($posts as $post) {
      $priority = get_post_meta( get_the_ID(), 'product_data', true );
      if(isset($priority['priority'])) {
        $post->priority = $priority['priority'];
      }
    }

    // Merge categories and posts arrays in one terms array

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

    // Sort terms array comparing their priority
    
    usort($terms, 'compare');

    ?>
    
    <div class="row">
      <div class="col s10 m8 l8 offset-s1 offset-m2 offset-l2 card zero-padding">
          <div class="card-image col s4 card-image-col">
            <div class="category-descr-img-container">
              <img class="responsive-img" src="<?php echo $thisCatImage; ?>">
            </div>
          </div>
          <div class="card-content col s8">
            <?php echo category_description(); ?>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="text-align-center divider-category">
        <h1 class="h1-for-categories"><?php echo $thisCat->cat_name; ?></h1>
        <span>_______________</span>
      </div>
    </div>
    <div class="row">
    <?php

    foreach ($terms as $term) {

      // If term is category - process it like category object

      if( $term->taxonomy == 'category') {
        // Get id
        $term_id = $term->term_id;
        // Get image for category
        $image = category_image_src( array( 'term_id'=>$term_id, 'size'=>'thumbnail' ) , false );
        // Render category card
        ?>
          <div class="minicard animate-fadein">
            <a href="<?php echo get_category_link( $term->term_id ); ?>">
              <div class="card hoverable category-card" title="<?php echo $term->name;?>">
                <?php
                  if ($image) {
                    ?>
                    <div class="card-image card-image-padding">
                      <img class="responsive-img card-img-border" src="<?php echo $image; ?>" alt="<?php echo $term->name; ?>">
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

        // if term is post of type product
        // Get attachment image

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $term->ID ), 'thumbnail' );

        // Render Product card

        ?>
      <div class="minicard animate-fadein">
        <a href="<?php echo get_permalink($term); ?>">
          <div class="card hoverable category-card">
            <?php
              if ( $image ) {
                ?>
                <div class="card-image card-image-padding">
                  <img class="responsive-img card-img-border" src="<?php echo $image[0]; ?>" alt="<?php echo $term->post_title; ?>">
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
</div>

<?php get_footer(); ?>