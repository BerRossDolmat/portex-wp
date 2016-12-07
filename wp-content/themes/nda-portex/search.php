<?php
/*
Template Name: Search Page
*/
?>
<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

if( strlen($query_string) > 0 ) {
	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach
} //if

$search = new WP_Query($search_query);

get_header();

// Get img_urls array for slider
$slider_imgs = json_decode(get_option('main_slider_urls'));
?>
<!-- Slider -->

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
    <h1 class="h1-for-search-page">Результаты поиска по запросу</h1>
    <h3><?php the_search_query(); ?></h3>
    <span>_______________</span>
  </div>

  <div class="row">
  <?php
    global $wp_query;
    $total_results = $wp_query->found_posts;

  ?>

  <?php
    if(!$total_results) {
      ?>
        <div class="col s12 text-align-center">
          <h6>К сожалению по Вашему запросу ничего не найдено, попробуйте уточнить свой запрос</h6>
        </div>
      <?php
    };
    foreach($wp_query->posts as $post) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
      ?>
      <div class="minicard animate-fadein">
        <a href="<?php echo get_permalink($post->ID); ?>">
          <div class="card hoverable category-card">
            <?php
              if ( $image ) {
                ?>
                <div class="card-image image-padding">
                  <img class="responsive-img img-border" src="<?php echo $image[0]; ?>" alt="<?php echo $post->post_title; ?>">
                </div>
                <?php
              }
            ?>
            <div class="card-content-text-container">
              <span><?php echo $post->post_title; ?></span>
            </div>
          </div>
        </a>
      </div>
      <?php
    }
    
  ?>

  </div>
</div>

<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/index-category.js"></script>
