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
add_action('after_switch_theme', 'genesis_after_switch_theme');

function genesis_after_switch_theme() {
  global $wpdb;

  $files = array(
    array(
      'file' => 'genesis-page-background.jpg',
      'title' => 'Lake under heavy rain',
      'excerpt' => 'Photo by <a href="https://unsplash.com/photos/z6Quzi5HXV0?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Jonathan Bean</a> on <a href="/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a>',
      'content' => 'Photo by Jonathan Bean on Unsplash',
    ),
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