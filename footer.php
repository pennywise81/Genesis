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

        $theme = wp_get_theme();

        $themeAuthorURI = $theme->get('AuthorURI') != '' ? esc_html($theme->get('AuthorURI')) : '';
        $themeAuthor = $theme->get('Author') != '' ? esc_html($theme->get('Author')) : '';
        $themeName = $theme->get('Name') != '' ? esc_html($theme->get('Name')) : '';
        $themeURI = $theme->get('ThemeURI') != '' ? esc_html($theme->get('ThemeURI')) : '';

        $themeAuthorString = '';
        $themeString = '';

        if ($themeAuthorURI != '' && $themeAuthor != '') {
          $themeAuthorString = "<a href=\"$themeAuthorURI\">$themeAuthor</a>";
        }
        elseif ($themeAuthor != '') {
          $themeAuthorString = $themeAuthor;
        }

        if ($themeURI != '') {
          $themeString = "<a href=\"$themeURI\">$themeName</a>";
        }
        else {
          $themeString = $themeName;
        }

        ?>
        <section class="widget site-info">
          <a href="<?php echo esc_url(__('https://wordpress.org/', 'genesis')); ?>">
            <?php printf(esc_html__('Proudly powered by %s', 'genesis'), 'WordPress'); ?>
          </a>
          <span class="sep"> | </span>
          <?php printf(esc_html__('Theme: %1$s by %2$s.', 'genesis'), $themeString, $themeAuthorString); ?>
        </section>

        <?php

        if (is_active_sidebar('footer-widgets-1')) {
          dynamic_sidebar('footer-widgets-1');
        }

        ?>
      </div>

    </footer><!-- .footer -->
  </div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
