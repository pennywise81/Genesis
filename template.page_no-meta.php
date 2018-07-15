<?php

/* Template Name: Page without meta */

/**
 * A Template for pages without any meta information (title, author, etc.)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Genesis
 */

get_header();

while (have_posts()) {
  the_post();

  get_template_part('template-parts/content', 'page_no-wrapper');
}

get_sidebar();
get_footer();
