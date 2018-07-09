<?php

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 * @link https://make.wordpress.org/core/2016/03/10/custom-logo/
 */
function genesis_custom_logo() {
  add_theme_support('custom-logo', array(
    'height' => 50,
    'width' => 185,
    'flex-width' => false,
    'flex-height' => false,
  ));
}

add_action('after_setup_theme', 'genesis_custom_logo');

function genesis_set_default_custom_logo() {
  global $wpdb;

  $files = array(
    array(
      'file' => 'genesis-logo.png',
      'title' => 'Genesis default site logo',
      'excerpt' => '',
      'content' => '',
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

  $query = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE 'genesis-logo.png'";
  $default_logo_id = $wpdb->get_var($query);
  $custom_logo_id = get_theme_mod('custom_logo');

  if ($custom_logo_id == '' && $default_logo_id != '') {
    set_theme_mod('custom_logo', $default_logo_id);
  }
}

add_action('after_switch_theme', 'genesis_set_default_custom_logo');