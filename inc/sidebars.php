<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function genesis_widgets_init() {
  register_sidebar(array(
    'name' => esc_html__('Sidebar', 'genesis'),
    'id' => 'genesis-sidebar-1',
    'description' => esc_html__('Add widgets here.', 'genesis'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));

  register_sidebar(array(
    'name' => esc_html__('Footer', 'genesis'),
    'id' => 'genesis-footer-widgets-1',
    'description' => esc_html__('Add widgets here.', 'genesis'),
    'before_widget' => '<section id="%1$s" class="col-sm widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
}
add_action('widgets_init', 'genesis_widgets_init');

/**
 * Adds flex-breaking elements to widgets in footer.
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
function genesis_filter_sidebar_params($params){
  global $number_of_widgets;

  if (isset($params[0]['id']) && $params[0]['id'] == 'genesis-footer-widgets-1') {
    $number_of_widgets++;

    if ($number_of_widgets % 2 == 0) {
      $params[0]['after_widget'] = $params[0]['after_widget'] .
        '<div class="w-100 d-none d-sm-block d-md-none d-lg-none d-xl-none"></div>';
    }

    if ($number_of_widgets % 3 == 0) {
      $params[0]['after_widget'] = $params[0]['after_widget'] .
        '<div class="w-100 d-none d-sm-none d-md-block d-lg-none d-xl-none"></div>';
    }

    if ($number_of_widgets % 4 == 0) {
      $params[0]['after_widget'] = $params[0]['after_widget'] .
        '<div class="w-100 d-none d-sm-none d-md-none d-lg-block d-xl-none"></div>';
    }

    if ($number_of_widgets % 5 == 0) {
      $params[0]['after_widget'] = $params[0]['after_widget'] .
        '<div class="w-100 d-none d-sm-none d-md-none d-lg-none d-xl-block"></div>';
    }
  }

  return $params;
}

add_filter('dynamic_sidebar_params', 'genesis_filter_sidebar_params');
