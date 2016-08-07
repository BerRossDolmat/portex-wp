<?php get_header(); ?>

<!-- Top Slider -->

<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="my-slider">
      	<ul>
      		<li>
            <img class="slider-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider-placeholder1.jpg">
          </li>
          <li>
            <img class="slider-img slider-no-display" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider-placeholder2.jpg">
          </li>
          <li>
            <img class="slider-img slider-no-display" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider-placeholder3.jpg">
          </li>
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

      $term_id = $category->term_id;
      $image   = category_image_src( array('term_id'=>$term_id) , false );

      ?>
        <div class="width-20p animate-fadein">
          <a href="<?php echo get_category_link( $category->term_id ); ?>">
            <div class="card hoverable category-card" title="<?php echo $category->category_description;?>">
              <?php
                if ( $image ) {
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
  <!-- Products loop -->
  <?php

  $args = array( 'post_type' => 'product', 'cat' => 1);
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
