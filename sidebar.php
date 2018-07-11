<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Genesis
 */

if (!is_active_sidebar('genesis-sidebar-1')) {
  return;
}

$sidebar_position = get_theme_mod('genesis_sidebar_side', 'right');
$sidebar_class = $sidebar_position == 'right' ? '' : 'order-first';

?>

<aside id="secondary" class="col-sm-3 <?php echo $sidebar_class; ?> widget-area">
  <?php dynamic_sidebar('genesis-sidebar-1'); ?>
</aside><!-- #secondary -->
