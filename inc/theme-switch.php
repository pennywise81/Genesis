<?php
/**
 * Theme switch setup
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/after_switch_theme
 *
 * @package Genesis
 */

/**
 * Adds file(s) to media library after the theme has been switched to
 */
function genesis_upload_images() {
  global $wpdb;

  $files = array(
    array(
      'file' => 'genesis-page-background-2.jpg',
      'title' => 'Blue mountain silhouettes',
      'excerpt' => 'Photo by <a href="https://unsplash.com/photos/MDgRcuGYu58?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">bady qb</a> on <a href="/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a>',
      'content' => 'Photo by bady qb on Unsplash',
    ),
    array(
      'file' => 'genesis-page-header.jpg',
      'title' => 'Lake under heavy rain',
      'excerpt' => 'Photo by <a href="https://unsplash.com/photos/rcAOIMSDfyc?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Oskars Sylwan</a> on <a href="/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a>',
      'content' => 'Photo by Oskars Sylwan on Unsplash',
    ),
  );

  foreach ($files as $f) {
    $query = "SELECT meta_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . $f['file'] . "%'";

    $count = intval($wpdb->get_var($query));

    if ($count !== 0) {
      continue;
    }
    else {
      $file = get_template_directory() . '/img/' . $f['file'];
      $filename = basename($file);

      $upload_file = wp_upload_bits($filename, null, file_get_contents($file));

      if (!$upload_file['error']) {
        $wp_filetype = wp_check_filetype($filename, null );
        $attachment = array(
          'post_mime_type' => $wp_filetype['type'],
          'post_title' => $f['title'],
          'post_excerpt' => $f['excerpt'],
          'post_content' => $f['content'],
          'post_status' => 'inherit'
        );

        $attachment_id = wp_insert_attachment($attachment, $upload_file['file']);

        if (!is_wp_error($attachment_id)) {
          require_once(ABSPATH . "wp-admin" . '/includes/image.php');
          $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
          wp_update_attachment_metadata($attachment_id,  $attachment_data);

          // create admin notice
          add_action('admin_notices', function () {
            echo '<div class="notice notice-info is-dismissible"><p>';
            printf(esc_html__('Image %1$s has been added to media library.', 'genesis'), $f['title']);
            echo '</p></div>';
          });
        }
      }
    }
  }

};

// add_action('after_switch_theme', 'genesis_upload_images');

/**
 * Adds a HTML widget to the footer
 */
function genesis_footer_add_widget() {
  $active_widgets = get_option('sidebars_widgets');

  if (empty($active_widgets['footer-widgets-1'])) {
    $active_widgets['footer-widgets-1'][] = 'custom_html-0';

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

    $footer_content = '';

    $footer_content .= '<section class="widget site-info">';
    $footer_content .= '  <a href="' . esc_url(__('https://wordpress.org/', 'genesis')) . '">';
    $footer_content .= '    ' . sprintf(esc_html__('Proudly powered by %s', 'genesis'), 'WordPress');
    $footer_content .= '  </a>';
    $footer_content .= '  <span class="sep"> | </span>';
    $footer_content .= '  ' . sprintf(esc_html__('Theme: %1$s by %2$s.', 'genesis'), $themeString, $themeAuthorString);
    $footer_content .= '</section>';

    $text_content[0] = array (
      'content' => $footer_content,
    );

    update_option('widget_custom_html', $text_content);
    update_option('sidebars_widgets', $active_widgets);
  }
}

add_action('after_switch_theme', 'genesis_footer_add_widget');