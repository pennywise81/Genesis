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
add_action('after_switch_theme', function() {
  global $wpdb;

  $query = "SELECT meta_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%genesis-page-background.jpg%'";
  $count = intval($wpdb->get_var($query));

  if ($count !== 0) {
    return;
  }
  else {
    $file = get_template_directory() . '/img/genesis-page-background.jpg';
    $filename = basename($file);

    $upload_file = wp_upload_bits($filename, null, file_get_contents($file));

    if (!$upload_file['error']) {
      $wp_filetype = wp_check_filetype($filename, null );
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => 'Landscape black and white',
        'post_excerpt' => 'Photo by <a href="https://unsplash.com/photos/z6Quzi5HXV0?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Jonathan Bean</a> on <a href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>',
        'post_content' => 'Photo by Jonathan Bean on Unsplash',
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
          echo "Image has been added to media library.";
          echo '</p></div>';
        });
      }
      else {
        // couldn't upload image
      }
    }
    else {
      // couldn't upload image
    }
  }
});