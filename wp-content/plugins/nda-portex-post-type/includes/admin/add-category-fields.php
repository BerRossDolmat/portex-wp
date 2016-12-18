<?php

// Add ability to use meta information with categories taxonomy

function nda_category_add_new_meta_field($term) {
  
  // Get category id
  if(isset($term->term_id)){
    $t_id = $term->term_id;
    $category_data = get_option( "taxonomy_$t_id" );
  }

  // Meta data existence check
  if(!isset($category_data['meta_title'])) {
    $category_data['meta_title'] = '';
  }
  if(!isset($category_data['meta_description'])) {
    $category_data['meta_description'] = '';
  }
  if(!isset($category_data['meta_keywords'])) {
    $category_data['meta_keywords'] = '';
  }

  // Priority existence check
  if(!isset($category_data['priority'])) {
    $category_data['priority'] = 10;
  }

  // Breadcrumb existence check
  if(!isset($category_data['breadcrumb'])) {
    $category_data['breadcrumb'] = '';
  }

  // Title existence check
  if(!isset($category_data['title'])) {
    $category_data['title'] = '';
  }

  if(!isset($category_data['description'])) {
    $category_data['description'] = '';
  }

  
  ?>
  <!-- Metabox template -->
  <h4>Тайтл</h4>
  <div class="form-group">
    <label>Тайтл страницы категории</label>
    <input class="form-control" type="text" name="nda_category_title" value="<?php echo $category_data['title']; ?>">
  </div>
  
  <h4>Хлебные крошки</h4>
  <div class="form-group">
    <label>Имя в хлебных крошках</label>
    <input class="form-control" type="text" name="nda_category_breadcrumb" value="<?php echo $category_data['breadcrumb']; ?>">
  </div>

  <h4>Метаданные</h4>
  <div class="form-group">
    <label>Meta Title</label>
    <input class="form-control" type="text" name="nda_category_meta_title" value="<?php echo $category_data['meta_title']; ?>">
  </div>
  <div class="form-group">
    <label>Meta Description</label>
    <textarea class="form-control" rows="10" name="nda_category_meta_description" value="<?php echo $category_data['meta_description']; ?>"></textarea>
  </div>
  <div class="form-group">
    <label>Meta Keywords</label>
    <textarea class="form-control" rows="10" name="nda_category_meta_keywords" value="<?php echo $category_data['meta_keywords']; ?>"></textarea>
  </div>
  <div class="form-group">
    <label>Приоритет</label>
    <input class="form-control" type="number" name="nda_category_priority" value="<?php echo $category_data['priority']; ?>">
  </div>

  <?php
}
