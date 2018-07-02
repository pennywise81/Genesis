<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genesis
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="site">
    <header class="site-header">

      <!--
      <div class="site-branding">
        <?php

        if (is_front_page() && is_home()) {
          ?>
          <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
          <?php
        }
        else {
          ?>
          <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
          <?php
        }

        $genesis_description = get_bloginfo('description', 'display');

        if ($genesis_description || is_customize_preview()) {
          ?>
          <p class="site-description"><?php echo $genesis_description; /* WPCS: xss ok. */ ?></p>
        <?php } ?>
      </div>
      -->

      <?php get_template_part('template-parts/navbar'); ?>

    </header><!-- .site-header -->

    <main class="site-content">
