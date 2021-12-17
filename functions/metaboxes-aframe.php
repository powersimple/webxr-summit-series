<?php
add_filter( 'rwmb_meta_boxes', 'entity_positioning' );

function entity_positioning( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'   => esc_html__( 'Entity Postioning', 'online-generator' ),
        'id'      => 'entitiy_positioning',
        'context' => 'side',
        'priority' => 'high',
		'autosave' => true,
        'post_types' => array( 'event' ),
        'fields'  => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Position Lock', 'online-generator' ),
                'id'   => $prefix . 'pos_lock',
                'desc' => esc_html__( '(overides x y & z)', 'online-generator' ),
                'size' => 1,
                'std'=>''
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Position X', 'online-generator' ),
                'id'   => $prefix . 'pos_X',
                'size' => 1,
                'std'=>'0'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Position Y', 'online-generator' ),
                'id'   => $prefix . 'pos_y',
                'size' => 1,
                'std'=>'0'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Position Z', 'online-generator' ),
                'id'   => $prefix . 'pos_z',
                'size' => 1,
                'std'=>'0'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Rotation Lock', 'online-generator' ),
                'id'   => $prefix . 'rot_lock',
                'desc' => esc_html__( '(overides x y & z)', 'online-generator' ),
                'size' => 1,
                'std'=> ''
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Rotation X', 'online-generator' ),
                'id'   => $prefix . 'rot_X',
                'size' => 1,
                'std'=>'0'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Rotation Y', 'online-generator' ),
                'id'   => $prefix . 'rot_y',
                'size' => 1,
                'std'=>'0'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Rotation Z', 'online-generator' ),
                'id'   => $prefix . 'rot_z',
                'size' => 1,
                'std'=>'0'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'scale Lock', 'online-generator' ),
                'id'   => $prefix . 'scale_lock',
                'desc' => esc_html__( '(overides x y & z)', 'online-generator' ),
                'size' => 1,
                'std'=>''
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Scale X', 'online-generator' ),
                'id'   => $prefix . 'scale_X',
                'size' => 1,
                'std'=>'1'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( '  Position Y', 'online-generator' ),
                'id'   => $prefix . 'scale_y',
                'size' => 1,
                'std'=>'1'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Position Z', 'online-generator' ),
                'id'   => $prefix . 'scale_z',
                'size' => 1,
                'std'=>'1'
            ],

            
        ],
    ];

    return $meta_boxes;
}

?>