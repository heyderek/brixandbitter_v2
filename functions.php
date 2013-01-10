<?php

//Load Javascript Animation for the front page only.
if ( ! is_admin() ) {
  function brixnbitter_load_scripts() {
    wp_register_script('slide', get_bloginfo('template_directory') . '/js/slide.js','jquery', false, true );
    if (is_front_page()) {
      wp_enqueue_script('slide');
    }
  }
add_action( 'wp_enqueue_scripts', 'brixnbitter_load_scripts' );
}

//Add editor-style.css
function add_admin_styles() {
  add_editor_style(); 
}
add_action( 'after_setup_theme', 'add_admin_styles' ); 

//Add theme support for...
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
add_theme_support('post-thumbnails');
add_image_size( 'featured', 1000, 375, true );
add_image_size( 'gallery_thumb', 350, 350, true );

//Add Sidebar Widget Area
function bnb_widgets() {
  register_sidebar( array(
    'name' => __( 'Sidebar Posts', 'bnb' ),
    'id' => 'sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
  ) );
  register_sidebar( array(
    'name' => __( 'Sidebar Pages', 'bnb' ),
    'id' => 'sidebar-pages',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
  ) );
}
add_action( 'init', 'bnb_widgets' );

//Add Home to Menu Item
function bnb_home_menu( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'bnb_home_menu' );

//Change the excerpt and make it pretty.
function readmore_excerpt($more) {
  global $post;
  return '&nbsp;<a class="excerpt-link" href="' . get_permalink($post->ID) . '">Read More About ' . get_the_title($post->ID) . '&raquo;</a>';
}

add_filter('excerpt_more', 'readmore_excerpt');

//Add Primary Menu Area
register_nav_menus( array(
  'primary' => __( 'Primary Menu', 'bnb' ),
  ) 
);
register_nav_menus( array(
  'sitemap' => __( 'Footer Sitemap', 'bnb' ),
  ) );

//Itineraries Post Type
require_once('admin/itineraries.php');

//Destinations Post Type
require_once('admin/destinations.php');

//Add Comments
require_once('admin/comments.php');

require_once('admin/metaboxes.php');

//Post Navigation Functionality
if ( ! function_exists( 'brixnbitter_content_nav' ) ):
function brixnbitter_content_nav( $nav_id ) {
  global $wp_query; ?>
  <?php if ( is_single() ) : // navigation links for single posts ?>
    <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'brixnbitter' ) . '</span> %title' ); ?>
    <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'brixnbitter' ) . '</span>' ); ?>
  <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
    <?php if ( get_next_posts_link() ) : ?>
    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 'brixnbitter' ) ); ?></div>
    <?php endif; ?>
    <?php if ( get_previous_posts_link() ) : ?>
    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'brixnbitter' ) ); ?></div>
    <?php endif; ?>
  <?php endif; ?>
  </nav><!-- #<?php echo $nav_id; ?> -->
  <?php
}
endif; 

//Initialize Options Framework
if ( !function_exists( 'optionsframework_init' ) ) {
  define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
  require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}

//Returns true if blog has more than one category.
function toolbox_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so toolbox_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so toolbox_categorized_blog should return false
		return false;
	}
}

//Flush out the transients.
function toolbox_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'toolbox_category_transient_flusher' );
add_action( 'save_post', 'toolbox_category_transient_flusher' );