<?php

function entity_metabox( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'section',
		'title' => esc_html__( 'ENTITY', 'entity_metabox' ),
		'post_types' => array( 'page','event','resource','profile','scene' ),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => false,
		'fields' => array(
		   
			array(
				'id' => $prefix . 'title_position',
				'type' => 'text',
				'name' => esc_html__( 'title_position', 'entity' ),
			),

			
			
		),
	);

	return $meta_boxes;
}
    //add_filter( 'rwmb_meta_boxes', 'entity_metabox' );

?>