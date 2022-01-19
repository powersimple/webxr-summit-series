<?php
add_filter( 'rwmb_meta_boxes', 'awards_meta' );

function awards_meta( $meta_boxes ) {
    $prefix = '';
   
    $meta_boxes[] = [
        'title'   => esc_html__( 'Entity Postioning', 'online-generator' ),
        'id'      => 'entitiy_positioning',
        'context' => 'side',
        'priority' => 'high',
        'post_types' => array( 'resource'),
		'autosave' => true,
        'post_types' => array( 'event' ),
        'fields'  => [
            [
                'type' => 'textarea',
                'name' => esc_html__( 'About', 'online-generator' ),
                'id'   => $prefix . 'award_about',
                'size' => 1,
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Criteria', 'online-generator' ),
                'id'   => $prefix . 'award_former',
                'desc' => esc_html__( '(overides x y & z)', 'online-generator' ),
                'size' => 1,
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Formerly', 'online-generator' ),
                'id'   => $prefix . 'pos_x',
                'size' => 1,
            ],


            
        ],
    ];

    return $meta_boxes;
}

?>