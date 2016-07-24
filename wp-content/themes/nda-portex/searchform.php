<form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>" class="search-form search-wrapper cf">
  <input name="s" id="s" value="<?php echo wp_specialchars($s, 1); ?>" type="search" placeholder="Что Вы ищете?" required="">
  <button type="submit"><i class="search-btn material-icons">search</i></button>
</form>
