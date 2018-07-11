<?php
/**
 * Genesis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Genesis
 */

if ( ! function_exists( 'genesis_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function genesis_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Genesis, use a find and replace
     * to change 'genesis' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'genesis', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'menu-1' => esc_html__( 'Primary', 'genesis' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('genesis_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => get_template_directory_uri() . '/img/genesis-page-background-2.jpg',
    )));

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
  }
endif;
add_action('after_setup_theme', 'genesis_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function genesis_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'genesis_content_width', 640 );
}
add_action( 'after_setup_theme', 'genesis_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function genesis_scripts() {

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  // wp_enqueue_script('jquery-slim', get_template_directory_uri() . '/js/jquery-3.3.1.slim.min.js', array(), '3.3.1', true);
  wp_enqueue_script('popper', get_template_directory_uri() . '/js/popper.min.js', array(), '1.14.3', true);
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery', 'popper'), '4.1.1', true);
  // wp_enqueue_script('fontawesome-svg', get_template_directory_uri() . '/js/fontawesome.all.min.js', array(), '5.1.0', true);
  wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1');
  wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/fontawesome.all.css', array(), '5.1.0');
  wp_enqueue_style('genesis-style', get_stylesheet_uri(), array('bootstrap-css'));
}
add_action( 'wp_enqueue_scripts', 'genesis_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
  require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load Advanced Custom Fields compatibility file.
 */
require get_template_directory() . '/inc/advancedcustomfields.php';

/**
 * Bootstrap Menu walker
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Extending the customizer colors
 */
require get_template_directory() . '/inc/customizer-colors.php';

/**
 * Custom logo support/default
 */
require get_template_directory() . '/inc/custom-logo.php';

/**
 * Adds some default widgets on theme switch
 */
require get_template_directory() . '/inc/default-widgets.php';

/**
 * Sidebar related stuff
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Sidebar Customization
 */
require get_template_directory() . '/inc/customizer-sidebar.php';