<?php 

get_header(); 

// Get img_urls array for slider
$slider_imgs = json_decode(get_option('main_slider_urls'));
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

  <div class="text-align-center divider-404">
    <h1 class="h1-404">Запрошенная Вами страница не найдена, попробуйте ещё раз</h1>
    <span>_______________</span>
  </div>

</div>

<?php get_footer(); ?>
