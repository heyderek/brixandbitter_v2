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

//Add Primary Menu Area
register_nav_menus( array(
  'primary' => __( 'Primary Menu', 'bnb' ),
  ) 
);
register_nav_menus( array(
  'sitemap' => __( 'Footer Sitemap', 'bnb' ),
  ) );

//Add Months taxonomy for use with the custom Itinerary.
function add_months() {
	$label = array(
		'name' => _x( 'Months' ),
		'singular_name' => _x( 'Month','' ),
		'search_items' => __( 'Search Months' ),
		'all_items' => __( 'All Months' ),
		'edit_item' => __( 'Edit Month' ),
		'update_item' => __( 'Update Month' ),
		'add_new_item' => __( 'Add New Month' ),
		'new_item_name' => __( 'New Month Name' ),
		'menu_name' => _x( 'Months' )
	);
	register_taxonomy( 'month', array( 'itinerary' ), array(
		'hierarchical' => true,
		'labels' => $label
	) );
}
add_action( 'init','add_months' );

//Add the Itinerary post type
function add_itinerary() {
  $label = array(
    'name' => _x( 'Itinerary' ),
    'singular_name' => _x( 'Itinerary' ),
    'edit_item' => __( 'Edit Itinerary' ),
  );
  $params = array(
    'labels' => $label,
    'public' => true,
    'show_in_menu' => true,
    'has_archive' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => 15,
    'supports' => array( 'title', 'editor', 'revisions', 'thumbnail' )
  );
  register_post_type( 'itinerary', $params );
}
add_action( 'init', 'add_itinerary' );

//Add Destinations post type
function add_dest() {
  $label = array(
    'name' => _x( 'Destinations' ),
    'singular_name' => _x( 'Destination' ),
    'edit_item' => __( 'Edit Destination' ),
  );
  $params = array(
    'labels' => $label,
    'public' => true,
    'show_in_menu' => true,
    'has_archive' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 15,
    'supports' => array( 'title', 'editor', 'revisions', 'thumbnail' )
  );
  register_post_type( 'destinations', $params );
}
add_action( 'init', 'add_dest' );

//Add Comment functionality
if ( ! function_exists( 'brixnbitter_comment' ) ) :
function brixnbitter_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
  case 'pingback' :
  case 'trackback' : ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'brixnbitter' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'bnb' ), ' ' ); ?></p>
  <?php
    break;
    default : ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer>
        <div class="comment-author vcard">
          <?php echo get_avatar( $comment, 40 ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em><?php _e( 'Your comment is awaiting moderation.', 'brixnbitter' ); ?></em>
        <br />
      <?php endif; ?>
      </footer>
      <?php printf( __( '%s <span class="says">says:</span>', 'brixnbitter' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
      <div class="comment-meta commentmetadata">
        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
        <?php printf( __( '%1$s at %2$s', 'brixnbitter' ), get_comment_date(), get_comment_time() ); ?>
        </time></a>
        <?php edit_comment_link( __( '(Edit)', 'brixnbitter' ), ' ' );
        ?>
      </div><!-- .comment-meta .commentmetadata -->
      <div class="comment-content"><?php comment_text(); ?></div>
      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
  </article><!-- #comment-## -->
  <?php
  break;
  endswitch;
}
endif; // ends check for brixnbitter_comment()

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

//Add metaboxes for date and time for custom itineraries.
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	$ittime = array(
				'name' => 'Time',
				'desc' => 'Time',
				'id'   => $prefix . 'first_timestamp',
				'type' => 'text_datetime_timestamp',
			);
	$options_pages = array();
	$options_pages_obj = get_posts( array('post_type' => 'destinations'));
		foreach ($options_pages_obj as $page) {
			$options_pages[$page->ID] = $page->post_title;
	}

	$meta_boxes[] = array(
		'id'         => 'test_metabox',
		'title'      => 'Custom Itinerary',
		'pages'      => array( 'itinerary', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Time/Date',
				'desc' => 'Time and date',
				'id'   => $prefix . 'test_datetime_timestamp',
				'type' => 'text_datetime_timestamp'
			),
			array(
				'name'    => 'Itinerary Items for Attachment',
				'desc'    => 'A list of items to attach to a itinerary.',
				'id'      => $prefix . 'test_multicheckbox',
				'type'    => 'multicheck',
				'options' => $options_pages			
			)
		)
	);

	// Add other metaboxes as needed
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

$return_pages = array();
$return_pages_obj = get_posts( array('post_type' => 'destinations'));
	foreach ($return_pages_obj as $page) {
		$return_pages[$page->ID] = $page->post_title;
}

add_action( 'cmb_render_text_email', 'rrh_cmb_render_text_email', 10, 2 );

function rrh_cmb_render_text_email( $field, $meta ) {
					echo '<ul>';
					$i = 1;
					foreach ( $field['options'] as $value => $name ) {
						// Append `[]` to the name to get multiple values
						// Use in_array() to check whether the current option should be checked
						echo '<li><input type="checkbox" name="', $field['id'], '[]" id="', $field['id'], $i, '" value="', $value, '"', in_array( $value, $meta ) ? ' checked="checked"' : '', ' /><label for="', $field['id'], $i, '">', $name, '</label></li>';	
						$i++;
					}
					echo '</ul>';
					echo '<span class="cmb_metabox_description">', $field['desc'], '</span>';				
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