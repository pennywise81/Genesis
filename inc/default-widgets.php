<?php
/**
 * Adding default widgets
 *
 * @link https://wordpress.stackexchange.com/questions/26557/programmatically-add-widgets-to-sidebars
 *
 * @package Genesis
 */

function genesis_add_default_widgets() {
  $active_widgets = get_option('sidebars_widgets');
  $widget_content = array();

  if (!empty($active_widgets['genesis-sidebar-1']) ||
    !empty($active_widgets['genesis-footer-widgets-1'])) {
    return;
  }

  $widget_counter = 1;

/*
  // <!-- repeat for every widget you want to add
  $active_widgets['genesis-footer-widgets-1'][] = 'text-' . $widget_counter;
  $widget_content[$widget_counter] = array(
    'title' => 'Widget ' . $widget_counter,
    'text' => "I'm an awesome widget!",
  );
  update_option('widget_text', $widget_content);
  $widget_counter++;
  // repeat for every widget you want to add -->

  // <!-- repeat for every widget you want to add
  $active_widgets['genesis-sidebar-1'][] = 'text-' . $widget_counter;
  $widget_content[$widget_counter] = array(
    'title' => 'Widget ' . $widget_counter,
    'text' => 'Sidebar Widget',
  );
  update_option('widget_text', $widget_content);
  $widget_counter++;
  // repeat for every widget you want to add -->
*/

  /* ADDING HTML WIDGET START */
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
  $footer_content .= '  <a href="' . esc_url(__('https://wordpress.org/', 'genesis')) . '">';
  $footer_content .= '    ' . sprintf(esc_html__('Proudly powered by %s', 'genesis'), 'WordPress');
  $footer_content .= '  </a>';
  $footer_content .= '  <span class="sep"> | </span>';
  $footer_content .= '  ' . sprintf(esc_html__('Theme: %1$s by %2$s.', 'genesis'), $themeString, $themeAuthorString);

  /* <!-- repeat for every widget you want to add */
  $active_widgets['genesis-footer-widgets-1'][] = 'custom_html-' . $widget_counter;
  $widget_content[$widget_counter] = array(
    'content' => $footer_content,
  );
  update_option('widget_custom_html', $widget_content);
  $widget_counter++;
  /* repeat for every widget you want to add --> */
  /* ADDING HTML WIDGET END */

  // SEARCH START
    // <!-- repeat for every widget you want to add
  $active_widgets['genesis-sidebar-1'][] = 'search-' . $widget_counter;
  $widget_content[$widget_counter] = array(
    'title' => __('Site search', 'genesis')
  );
  update_option('widget_search', $widget_content);
  $widget_counter++;
  // repeat for every widget you want to add -->
  // SEARCH END

  // RECENT POSTS START
    // <!-- repeat for every widget you want to add
  $active_widgets['genesis-sidebar-1'][] = 'recent-posts-' . $widget_counter;
  $widget_content[$widget_counter] = array(
    'title' => __('Recent Entries', 'genesis')
  );
  update_option('widget_recent-posts', $widget_content);
  $widget_counter++;
  // repeat for every widget you want to add -->
  // RECENT POSTS END

  // Meta START
    // <!-- repeat for every widget you want to add
  $active_widgets['genesis-sidebar-1'][] = 'meta-' . $widget_counter;
  $widget_content[$widget_counter] = array(
    'title' => __('Meta', 'genesis')
  );
  update_option('widget_meta', $widget_content);
  $widget_counter++;
  // repeat for every widget you want to add -->
  // Meta END

  update_option('sidebars_widgets', $active_widgets);
}

add_action('after_switch_theme', 'genesis_add_default_widgets');