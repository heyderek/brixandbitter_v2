<?php
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
	$options_pages_obj = get_posts( array('post_type' => 'destinations', 'posts_per_page'=> -1));
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