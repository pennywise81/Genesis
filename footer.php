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

      </div>
    </main><!-- .site-content -->

    <footer class="site-footer">
      <div class="container">
        <div class="row justify-content-between">

          <?php

          if (is_active_sidebar('genesis-footer-widgets-1')) {
            dynamic_sidebar('genesis-footer-widgets-1');
          }

          ?>
        </div>
      </div>

      <?php get_template_part('template-parts/partials/footer', 'additional_content'); ?>

    </footer><!-- .footer -->
  </div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
