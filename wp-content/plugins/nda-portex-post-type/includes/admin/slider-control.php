<?php

function my_load_wp_media_files() {
  wp_enqueue_media();
}

function nda_slider_control() {
  add_options_page( 'Управление слайдером главной страницы', 'Управление слайдером', 'manage_options', 'nda_slider_control', 'nda_slider_options' );
}

function nda_slider_options() {

$options = get_option('main_slider_titles');

?>
<form method="post" action="options.php">
  <?php
  settings_fields( 'nda_options' );
  do_settings_sections( 'nda_options' );
  ?>
  <h4>Выберите изображения для слайдера главной страницы</h4>
  <div id="main-slider-button">
    <button>Выберите изображения для слайдера</button>
    <div id="imgTitlesBlock" <?php if(!$options) echo 'hidden'; ?>>
      <h4>Выбранные файлы</h4>
      <ul class="list-group" id="imgTitles">
        <?php
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
