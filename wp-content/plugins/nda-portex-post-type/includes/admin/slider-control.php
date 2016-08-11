<?php

  // Add media files javascript support for page

function my_load_wp_media_files() {
  wp_enqueue_media();
}

  // Add option for slider control

function nda_slider_control() {
  add_options_page( 'Управление слайдером главной страницы', 'Управление слайдером', 'manage_options', 'nda_slider_control', 'nda_slider_options' );
}

function nda_slider_options() {

  // Get slider imgs titles from option

  $options = get_option('main_slider_titles');

?>

  <!-- Meta data template for main slider -->

  <form method="post" action="options.php">
    <?php

    // Add settings for main slider form

    settings_fields( 'nda_options' );

    // Connect form inputs to options datatable

    do_settings_sections( 'nda_options' );
    ?>

    <!-- Main slider control form -->

    <h4>Выберите изображения для слайдера главной страницы</h4>
    <div id="main-slider-button">
      <button>Выберите изображения для слайдера</button>
      <div id="imgTitlesBlock" <?php if(!$options) echo 'hidden'; ?>>
        <h4>Выбранные файлы</h4>
        <ul class="list-group" id="imgTitles">
          <?php

          // Chosen imgs title list creation

          if ($options) {
            $titles = json_decode($options);
            foreach($titles as $title) {
              echo '<li class="list-group-item">' . $title . '</li>';
            }
          }
          ?>
        </ul>
      </div>
      <input type="hidden" name="main_slider_urls" id="main_slider_img_urls" value="<?php echo get_option('main_slider_urls'); ?>">
      <input type="hidden" name="main_slider_titles" id="main_slider_img_titles" value="<?php echo get_option('main_slider_titles'); ?>">
    </div>
    <?php submit_button('Сохранить изменения'); ?>
  </form>

<?php

}
