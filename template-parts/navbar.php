<?php get_template_part('template-parts/partials/navbar', 'top'); ?>

  <div class="container">

    <?php get_template_part('template-parts/partials/navbar', 'toggler'); ?>

    <?php


    if (has_custom_logo()) {
      $custom_logo_id = get_theme_mod('custom_logo');
      $image = wp_get_attachment_image_src($custom_logo_id , 'full');

      ?>

      <a class="navbar-brand m-0 p-0 mr-sm-3 custom-logo-link" href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo esc_url($image[0]); ?>" class="my-2 custom-logo">
      </a>

      <?php
    }

    ?>

    <?php get_template_part('template-parts/partials/navbar', 'wp_nav_menu'); ?>

  </div>

</nav>