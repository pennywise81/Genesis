<nav class="navbar navbar-expand-md navbar-light" role="navigation">

  <button class="navbar-toggler"
    type="button" data-toggle="collapse" data-target="#site-primary-menu"
    aria-controls="site-primary-menu" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- <a class="navbar-brand" href="#"><?php esc_html_e('Primary Menu', 'genesis'); ?></a> -->

  <?php

  // the_custom_logo();

  ?>

  <?php

  wp_nav_menu(array(
    'theme_location' => 'menu-1',
    'menu_id' => 'primary-menu',
    'depth' => 2,
    'container' => 'div',
    'container_class' => 'collapse navbar-collapse justify-content-end',
    'container_id' => 'site-primary-menu',
    'menu_class' => 'nav navbar-nav',
    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
    'walker' => new WP_Bootstrap_Navwalker(),
  ));

  ?>

</nav>