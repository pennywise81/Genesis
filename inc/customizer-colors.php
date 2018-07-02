<?php

add_action('customize_register','genesis_customizer_options');

function genesis_customizer_options($wp_customize) {
  /*
  * Removing default color values
  */
  $wp_customize->remove_control('header_textcolor');
  $wp_customize->remove_control('background_color');

  $wp_customize->add_setting(
    'genesis_text_color',
    array(
      'default' => '#727272',
    )
  );

  $wp_customize->add_control(
   new WP_Customize_Color_Control(
     $wp_customize,
     'genesis_custom_text_color',
     array(
       'label' => __('Body Text Color', 'genesis'),
       'section' => 'colors',
       'settings' => 'genesis_text_color'
     )
   )
  );

  $wp_customize->add_setting(
    'genesis_link_color',
    array(
      'default' => '#007bff',
    )
  );

  $wp_customize->add_control(
   new WP_Customize_Color_Control(
     $wp_customize,
     'genesis_custom_link_color',
     array(
       'label' => __('Body Link Color', 'genesis'),
       'section' => 'colors',
       'settings' => 'genesis_link_color'
     )
   )
  );
}

add_action('wp_enqueue_scripts', 'genesis_customizer_css');

function genesis_customizer_css() {
  $handle = 'genesis-style';
  $css = '';
  $genesis_text_color = get_theme_mod('genesis_text_color', '#727272');
  $genesis_link_color = get_theme_mod('genesis_link_color', '#007bff');

  if ($genesis_text_color !== '') {
    $css .= '.site-content { color: ' . $genesis_text_color . '; }';
  }

  if ($genesis_link_color !== '') {
    $css .= '.site-content a { color: ' . $genesis_link_color . '; }';
  }

  if ($css !== '') {
    wp_add_inline_style($handle  , $css);
  }
}
