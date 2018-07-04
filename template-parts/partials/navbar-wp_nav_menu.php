  <?php

  wp_nav_menu(array(
    'theme_location' => 'menu-1',
    'menu_id' => 'primary-menu',
    'depth' => 2,
    'container' => 'div',
    // 'container_class' => 'collapse navbar-collapse justify-content-end', // for right aligned menu
    'container_class' => 'collapse navbar-collapse',
    'container_id' => 'site-primary-menu',
    'menu_class' => 'nav navbar-nav',
    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
    'walker' => new WP_Bootstrap_Navwalker(),
  ));