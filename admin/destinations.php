<?php
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

function create_dest_regions(){
   $labels = array(
    'name' => _x( 'Regions', 'taxonomy general name' ),
    'singular_name' => _x( 'Region', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Regions' ),
    'all_items' => __( 'All Regions' ),
    'parent_item' => __( 'Parent Region' ),
    'parent_item_colon' => __( 'Parent Region:' ),
    'edit_item' => __( 'Edit Regions' ), 
    'update_item' => __( 'Update Region' ),
    'add_new_item' => __( 'Add New Region' ),
    'new_item_name' => __( 'New Region Name' ),
    'menu_name' => __( 'Regions' ),
  ); 	

  register_taxonomy('region',array('destinations'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'region' ),
  ));
}

add_action('init', 'create_dest_regions');