<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genesis
 */

?>

    </main><!-- .site-content -->

    <footer class="site-footer">
      <div class="container">

        <?php

        if (is_active_sidebar('footer-widgets-1')) {
          dynamic_sidebar('footer-widgets-1');
        }

        $footer_content .= '<section class="widget site-info">';
        $footer_content .= '  <a href="' . esc_url(__('https://wordpress.org/', 'genesis')) . '">';
        $footer_content .= '    ' . sprintf(esc_html__('Proudly powered by %s', 'genesis'), 'WordPress');
        $footer_content .= '  </a>';
        $footer_content .= '  <span class="sep"> | </span>';
        $footer_content .= '  ' . sprintf(esc_html__('Theme: %1$s by %2$s.', 'genesis'), $themeString, $themeAuthorString);
        $footer_content .= '</section>';

        ?>
      </div>

      <?php get_template_part('template-parts/partials/footer', 'additional_content'); ?>

    </footer><!-- .footer -->
  </div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
