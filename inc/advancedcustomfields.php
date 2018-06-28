<?php
/**
 * Advanced Custom Fields Compatibility File
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package Genesis
 */

/**
 * Check if plugin is installed and offer a link to installation page
 */
add_action('admin_notices', function () {
  if(!class_exists('acf')) {
    add_thickbox();

    $string = sprintf(
      __('Please install and activate the plugin <em><a href="%1$s" class="thickbox open-plugin-details-modal">%2$s</a></em>.', 'genesis'),
      admin_url('plugin-install.php?tab=plugin-information&plugin=advanced-custom-fields&TB_iframe=true&width=772&height=887'),
      __('Advanced Custom Fields', 'genesis')
    );

    echo '<div class="notice notice-warning"><p>' . $string . '</p></div>';
  }
});