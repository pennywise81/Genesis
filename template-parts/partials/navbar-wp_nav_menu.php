  <?php

if (has_nav_menu('genesis-menu-1')) {
  wp_nav_menu(
    array(
      'theme_location' => 'genesis-menu-1',
      'menu_id' => 'primary-menu',
      'depth' => 2,
      'container' => 'div',
      // 'container_class' => 'collapse navbar-collapse justify-content-end', // for right aligned menu
      'container_class' => 'collapse navbar-collapse',
      'container_id' => 'site-primary-menu',
      'menu_class' => 'nav navbar-nav',
      'walker' => new WP_Bootstrap_Navwalker(),
    )
  );
}
else {
  $id = get_the_id();
  $all_pages = get_pages(
    array(
      'sort_column' => 'post_date'
    )
  );

  $menu_pages = array(
    array(
      'title' => __('Homepage', 'genesis'),
      'link' => esc_url(home_url('/')),
      'active' => is_home()
    )
  );

  foreach ($all_pages as $p) {
    $menu_pages[] = array(
      'title' => $p->post_title,
      'link' => esc_url(get_permalink($p->ID)),
      'active' => ($p->ID == $id) ? true : false
    );
  }

  ?>

  <div id="site-primary-menu" class="collapse navbar-collapse">
    <ul id="primary-menu" class="nav navbar-nav">
      <?php

      foreach ($menu_pages as $m) {

        ?>

        <li class="menu-item <?php echo $m['active'] ? 'current-menu-item current_page_item active' : ''; ?>">
          <a title="<?php echo $m['title']; ?>" href="<?php echo $m['link']; ?>" class="nav-link">
            <?php echo $m['title']; ?>
          </a>
        </li>

        <?php

      }

      ?>
    </ul>
  </div>

  <?php

}