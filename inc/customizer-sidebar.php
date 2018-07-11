<?php

/**
 * Add a section and setting to the customizer
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 * @link https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
 */
function genesis_customizer($wp_customize) {
  $wp_customize->add_section(
    'genesis_sidebar', array(
      'title' => __('Sidebar', 'genesis'),
      'priority' => 30,
    )
  );

  $wp_customize->add_setting(
    'genesis_sidebar_side',
    array(
      'default' => 'right'
    )
  );

  $wp_customize->add_control(
    'genesis_sidebar_side',
    array(
      'type' => 'radio',
      'section' => 'genesis_sidebar',
      'label' => __('Position'),
      'choices' => array(
        'right' => __('Right'),
        'left' => __('Left'),
      ),
    )
  );
}

add_action('customize_register', 'genesis_customizer');