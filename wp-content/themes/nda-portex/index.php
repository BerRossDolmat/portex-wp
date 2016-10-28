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

            foreach ($slider_imgs as $img) {
              ?>
              <li>
                <img class="slider-img <?php echo $first_slide; ?>" src="<?php echo $img; ?>">
              </li>
              <?php
              $first_slide = ' slider-no-display';
            }
            ?>
      	</ul>
      </div>
    </div>
  </div>
</div>

<div class="container">

  <div class="text-align-center devider">
    <h1 class="h1-for-groups-index">ИЗДЕЛИЯ КОМПАНИИ PORTEX (SMITHS MEDICAL)</h1>
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

    $categories=get_categories($args);

    foreach ($categories as $category) {
      $priority = get_option( "taxonomy_$category->term_id" );
      if(isset($priority['priority'])) {
        $category->priority = $priority['priority'];
      }
    }
    $args = array( 'post_type' => 'product', 'cat' => 1, 'numberposts' => -1);

    $posts = get_posts($args);
    // print_r($posts);
    // die();
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
    
    foreach ($terms as $term) {
      if( $term->taxonomy == 'category') {
        $term_id = $term->term_id;
        $image   = category_image_src( array('term_id'=>$term_id, 'size'=>'thumbnail') , false );

      ?>
        <div class="minicard animate-fadein">
          <a href="<?php echo get_category_link( $term->term_id ); ?>">
            <div class="card hoverable category-card" title="<?php echo $term->category_description;?>">
              <?php
                if ( $image ) {
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
        continue;
      }
    }

?>
    </div>
</div>

<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/index-category.js"></script>

