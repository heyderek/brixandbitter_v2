<?php
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