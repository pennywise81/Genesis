<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Genesis
 */

the_content();

if (get_edit_post_link()) {

?>

  <footer class="entry-footer">
    <?php
    edit_post_link(
      sprintf(
        wp_kses(
          '<i class="fas fa-pencil-alt"></i> ' . __('Edit <span class="screen-reader-text">%s</span>', 'genesis'),
          array(
            'span' => array('class' => array()),
            'i' => array('class' => array()),
          )
        ),
        get_the_title()
      ),
      '<span class="edit-link">',
      '</span>',
      null,
      'btn btn-secondary btn-sm btn-edit-page'
    );
    ?>
  </footer><!-- .entry-footer -->

<?php

}

?>