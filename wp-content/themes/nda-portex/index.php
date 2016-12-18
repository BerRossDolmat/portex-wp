<?php get_header();

// Get img_urls array for slider
$slider_imgs = json_decode(get_option('main_slider_urls'));

// Compare function to filter priority
function compare($elm1, $elm2) {
  if ($elm1->priority === $elm2->priority) {
       return 0;
  }

  return ($elm1->priority < $elm2->priority) ? -1 : 1;
}

?>

<!-- Top Slider -->

<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="my-slider">
      	<ul>
          <?php
            $first_slide = '';
            $i = 1;
            foreach ($slider_imgs as $img) {
              ?>
              <li>
                <img alt="Slide №<?php echo $i;?>" class="slider-img <?php echo $first_slide; ?>" src="<?php echo $img; ?>">
              </li>
              <?php
              $i++;
              $first_slide = ' slider-no-display';
            }
            ?>
      	</ul>
      </div>
    </div>
  </div>
</div>

<div class="container">

  <div class="text-align-center divider-index">
    <h1 class="h1-for-index">ИЗДЕЛИЯ КОМПАНИИ PORTEX (SMITHS MEDICAL)</h1>
    <span>_______________</span>
  </div>

  <div class="row">

  <!-- Categories loop -->

  <?php
    $args = array(
      'orderby' => 'name',
      'parent' => 0,
      'hide_empty' => 0,
      'exclude' => '1',
    );

    // Get child categories

    $categories=get_categories($args);
    
    // Loop categories to set their priority

    foreach ($categories as $category) {
      $priority = get_option( "taxonomy_$category->term_id" );
      if(isset($priority['priority'])) {
        $category->priority = $priority['priority'];
      }
    }
    
    // Arguments to search child posts
    
    $args = array( 'post_type' => 'product', 'cat' => 1, 'numberposts' => -1);

    // Get posts by arguments

    $posts = get_posts($args);

    // Loop through posts to set their priority

    foreach ($posts as $post) {
      $priority = get_post_meta( get_the_ID(), 'product_data', true );
      if(isset($priority['priority'])) {
        $post->priority = $priority['priority'];
      }
    }

    // Merge posts and categories array

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
    
    // Sort merged array by priority

    usort($terms, 'compare');
    
    // Loop terms to render cards

    foreach ($terms as $term) {

      // Category term case

      if( $term->taxonomy == 'category') {
        $term_id = $term->term_id;
        $image   = category_image_src( array('term_id'=>$term_id, 'size'=>'thumbnail') , false );

      ?>
        <div class="minicard animate-fadein">
          <a href="<?php echo get_category_link( $term->term_id ); ?>">
            <!--<div class="card hoverable category-card" title="<?php echo $term->category_description;?>">-->
              <div class="card hoverable category-card" title="<?php echo $term->name;?>">
              <?php
                if ( $image ) {
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

        // Post term case 

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $term->ID ), 'thumbnail' );
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
        continue;
      }
    }

?>
    </div>
</div>

<?php get_footer(); ?>

