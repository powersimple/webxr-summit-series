<?php 


function selectLayoutTemplate( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'layout_template',
		'title' => esc_html__( 'Layout Template', 'metabox-online-generator' ),
		'post_types' => array('guide','hardware'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
		array(
				'id' => $prefix . 'page_layout_template',
				'name' => esc_html__( 'Page Layout Template', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'metabox-online-generator' ),
                    'two_column' => esc_html__( 'Two Column', 'metabox-online-generator' ),
                    'front_page' => esc_html__( 'Front Page', 'metabox-online-generator' ),
				),
				'std' => 'default',
            ),
            	array(
				'id' => $prefix . 'full_bleed',
				'name' => esc_html__( 'Full Bleed', 'metabox-online-generator' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Page has no margins', 'metabox-online-generator' ),
			),
			array(
				'id' => 'page_break_after',
				'name' => esc_html__( 'Checkbox', 'metabox-online-generator' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Page Break After', 'metabox-online-generator' )
			)
                
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectLayoutTemplate' );

function selectHeroImage( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'hero',
		'title' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
		'post_types' => array('post', 'page','resource','profile','guide' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'hero',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
				'desc' => esc_html__( '', 'metabox-online-generator' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectHeroImage' );


    function video_meta( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'featured_video',
            'title' => esc_html__( 'Featured Video', 'ps-video' ),
            'post_types' => array( 'page','post','project' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
                array(
                    'id' => 'featured_video',
                    'type' => 'video',
                    'name' => esc_html__( 'Video', 'ps-video' ),
                    'max_file_uploads' => 4,
                ),
                array(
                    'id' => $prefix . 'featured_video_url',
                    'type' => 'url',
                    'name' => esc_html__( 'Featured Video URL', 'ps-video' ),
                ),
                array(
                    'id' => $prefix . 'video_aspect',
                    'name' => esc_html__( 'Video Aspect', 'ps-video' ),
                    'type' => 'select',
                    'placeholder' => esc_html__( 'Select an Item', 'ps-video' ),
                    'options' => array(
                        'hd' => '16:9',
                        'sd' => '4:3',
                    ),
                    'std' => 'hd',
                ),
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'video_meta' );


    function section_class( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'section',
            'title' => esc_html__( 'SECTION', 'section_class' ),
            'post_types' => array( 'page','event' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
               
                array(
                    'id' => $prefix . 'section_class',
                    'type' => 'text',
                    'name' => esc_html__( 'section-class', 'ps-social' ),
                ),

				
                
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'section_class' );



    function social_meta( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'social_url',
            'title' => esc_html__( 'Social', 'ps-social' ),
            'post_types' => array( 'social' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
               
                array(
                    'id' => $prefix . 'social_url',
                    'type' => 'url',
                    'name' => esc_html__( 'URL', 'ps-social' ),
                ),
                
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'social_meta' );



    function ps_metabox( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'project_info',
            'title' => esc_html__( 'Project Info', 'ps_metabox' ),
            'post_types' => array( 'project' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
                array(
                    'id' => $prefix . 'project_url',
                    'type' => 'url',
                    'name' => esc_html__( 'Project URL', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_title',
                    'type' => 'text',
                    'name' => esc_html__( 'Project Title', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_client',
                    'type' => 'text',
                    'name' => esc_html__( 'Client', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_agency',
                    'type' => 'text',
                    'name' => esc_html__( 'Agency', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_era',
                    'type' => 'text',
                    'name' => esc_html__( 'Era', 'ps_metabox' ),
                ),
            
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'ps_metabox' );
            
function selectScreenImage( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'screen_image',
		'title' => esc_html__( 'Screen Image', 'metabox-online-generator' ),
		'post_types' => array( 'post', 'page','project' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => 'screen_image',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Screen Image', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Appears in Screen', 'metabox-online-generator' ),
				'force_delete' => false,
				'max_file_uploads' => '10',
				'options' => array(),
				'attributes' => array(),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectScreenImage' );

function profile_info( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profile_info',
		'title' => esc_html__( 'Profile Info', 'metabox-online-generator' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'profile_title',
				'type' => 'text',
				'name' => esc_html__( 'Title', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_company',
				'type' => 'text',
				'name' => esc_html__( 'Organization', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_website',
				'type' => 'url',
				'name' => esc_html__( 'Website', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_wikipedia',
				'type' => 'url',
				'name' => esc_html__( 'Wikipedia URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_linkedin',
				'type' => 'url',
				'name' => esc_html__( 'LinkedIn URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_twitter',
				'type' => 'url',
				'name' => esc_html__( 'Twitter URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_facebook',
				'type' => 'url',
				'name' => esc_html__( 'Facebook URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_flickr',
				'type' => 'url',
				'name' => esc_html__( 'Flickr URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_instagram',
				'type' => 'url',
				'name' => esc_html__( 'Instagram URL', 'metabox-online-generator' ),
			),
			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'profile_info' );

function eventProperties( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'event_Properties',
		'title' => esc_html__( 'Event Properties', 'metabox-online-generator' ),
		'post_types' => array('event'),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => [
			[
                'type'      => 'datetime',
                'name'      => esc_html__( 'Event Start Time UTC', 'online-generator' ),
                'id'        => 'utc_start',
                'timestamp' => 'false',
            ],
			[
                'type' => 'url',
                'name' => esc_html__( 'Embed Video URL', 'online-generator' ),
                'id'   => $prefix . 'embed_video_url',
            ],
	
			[
                'type'    => 'select',
                'name'    => esc_html__( 'Session Type', 'online-generator' ),
                'id'      => $prefix . 'session_type',
                'options' => [
                    'panel' => esc_html__( 'Panel', 'online-generator' ),				
                    'presenation'    => esc_html__( 'Presentation','online-generator' ),
                    'feature'        => esc_html__( 'Feature','online-generator' ),
                    'fireside_chat'  => esc_html__( 'Fireside Chat','online-generator' ),
                    'award_category' => esc_html__( 'Award Category','online-generator' ),
                    'honor_category' => esc_html__( 'Honor Category','online-generator' ),
					'welcome' => esc_html__( 'Welcome','online-generator' ),
					'keynote' => esc_html__( 'Keynote','online-generator' ),
					'summit' => esc_html__( 'Summit','online-generator' ),
					'town_hall' => esc_html__( 'Town Hall','online-generator' ),
                ],
            ],
			array(
				'id' => 'hero',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
				'desc' => esc_html__( '', 'metabox-online-generator' ),
			),
		
        ],
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'eventProperties' );

function eventResources( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'event_resources',
		'title' => esc_html__( 'Resources', 'metabox-online-generator' ),
		'post_types' => array('event'),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => [

			[
                'type'       => 'post',
                'name'       => esc_html__( '', 'online-generator' ),
                'id'         => 'event_resource',
                'post_type'  => 'resource',
                'field_type' => 'checkbox_tree',
                'query_args' => [
                    '' => '',
                ],
            ],
			
        ],
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'eventResources' );

function eventGuest( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'presenter',
		'title' => esc_html__( 'Guests | Nominees', 'metabox-online-generator' ),
		'post_types' => array('event'),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => [

			[
                'type'       => 'post',
                'name'       => esc_html__( '', 'online-generator' ),
                'id'         => 'event_guest',
                'post_type'  => 'profile',
                'field_type' => 'checkbox_tree',
                'query_args' => [
                    '' => '',
                ],
            ],
			
        ],
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'eventGuest' );
function eventModerator( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'event_moderator',
		'title' => esc_html__( 'Moderator', 'metabox-online-generator' ),
		'post_types' => array('event'),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => [

			[
                'type'       => 'post',
                'name'       => esc_html__( '', 'online-generator' ),
                'id'         => 'event_moderator',
                'post_type'  => 'profile',
                'field_type' => 'checkbox_tree',
				'parent' => 'true',
                'query_args' => [
                    '' => '',
                ],
            ],
			
        ],
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'eventModerator' );
function eventHonoree( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'event_honoree',
		'title' => esc_html__( 'Honorees', 'metabox-online-generator' ),
		'post_types' => array('event'),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => [

			[
                'type'       => 'post',
                'name'       => esc_html__( '', 'online-generator' ),
                'id'         => 'event_honoree',
                'post_type'  => 'profile',
                'field_type' => 'checkbox_tree',
                'query_args' => [
                    '' => '',
                ],
            ],
			
        ],
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'eventHonoree' );






// PROFILE METABOXES
// PROFILE METABOXES

function setProfileContactInfo( $meta_boxes ) { // this shows the box were 
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'contact_info',
		'title' => esc_html__( 'CONTACT INFO', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'low',
		'autosave' => 'false',
		'fields' => array(
			
			array(
				'id' => 'solution_name',
				'type' => 'text',
				'name' => esc_html__( 'Solution Name', 'metabox-online-generator' ),
			),
			array(
				'id' => 'contact_name',
				'type' => 'text',
				'name' => esc_html__( 'Contact Name', 'metabox-online-generator' ),
			),	array(
				'id' => 'company',
				'type' => 'text',
				'name' => esc_html__( 'Company', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_title',
				'type' => 'text',
				'name' => esc_html__( 'Contact Title', 'metabox-online-generator' ),
			),
			array(
				'id' => 'contact_email',
				'type' => 'text',
				'name' => esc_html__( '(private) Contact Email', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_email',
				'type' => 'email',
				'name' => esc_html__( '(public) Email Address', 'metabox-online-generator' ),
			),
			array(
				'id' => 'phone',
				'type' => 'text',
				'name' => esc_html__( 'Phone Number', 'metabox-online-generator' ),
			),
			array(
				'id' => 'address',
				'type' => 'text',
				'name' => esc_html__( 'Address', 'metabox-online-generator' ),
			),
			array(
				'id' => 'address2',
				'type' => 'text',
				'name' => esc_html__( 'Address 2', 'metabox-online-generator' ),
			),
			array(
				'id' => 'city',
				'type' => 'text',
				'name' => esc_html__( 'City', 'metabox-online-generator' ),
			),
			array(
				'id' => 'state',
				'type' => 'text',
				'name' => esc_html__( 'State / Province', 'metabox-online-generator' ),
			),
			array(
				'id' => 'postal_code',
				'type' => 'text',
				'name' => esc_html__( 'Postal Code', 'metabox-online-generator' ),
			),
			array(
				'id' => 'country',
				'type' => 'text',
				'name' => esc_html__( 'Country', 'metabox-online-generator' ),
			),
		
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileContactInfo' );



function setProfileURL( $meta_boxes ) { // this shows the box were 
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profile_info',
		'title' => esc_html__( 'PROFILE INFO', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'company',
				'type' => 'text',
				'name' => esc_html__( 'Company', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_title',
				'type' => 'text',
				'name' => esc_html__( 'Contact Title', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'website',
				'type' => 'website',
				'name' => esc_html__( 'Website', 'omniscience-profiler' ),
				'desc' => esc_html__( 'Enter URL for the Resource to Profile', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'linkedin',
				'type' => 'url',
				'name' => esc_html__( 'LinkedIn URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'twitter',
				'type' => 'url',
				'name' => esc_html__( 'Twitter URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'facebook',
				'type' => 'url',
				'name' => esc_html__( 'Facebook URL', 'omniscience-profiler' ),
			),
			
			array(
				'id' =>  'instagram',
				'type' => 'url',
				'name' => esc_html__( 'Instagram URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'discord',
				'type' => 'text',
				'name' => esc_html__( 'Discord Handle', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'youtube',
				'type' => 'url',
				'name' => esc_html__( 'YouTube Channel', 'omniscience-profiler' ),
			),
			[
                'type' => 'textarea',
                'name' => esc_html__( 'blurb', 'online-generator' ),
                'id'   => $prefix . 'blurb',
            ],
			[
                'type' => 'textarea',
                'name' => esc_html__( 'resources', 'online-generator' ),
                'id'   => $prefix . 'blurb',
            ],
			array(
				'id' => $prefix . 'logo',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Logo', 'omniscience-profiler' ),
				//'desc' => esc_html__( 'Size to 1920x1280', 'metabox-online-generator' ),
			),
			array(
				'id' => 'screenshot',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Screenshots', 'metabox-online-generator' ),
				'desc' => esc_html__( 'submitted with', 'metabox-online-generator' ),
				'force_delete' => false,
				'max_file_uploads' => '10',
				'options' => array(),
				'attributes' => array(),
			),

					array(
					'id' =>  'demo_video',
					'type' => 'url',
					'name' => esc_html__( 'Demo Video', 'omniscience-profiler' ),
				),



           				array(
					'id' =>  'wikipedia',
					'type' => 'url',
					'name' => esc_html__( 'Wikipedia URL', 'omniscience-profiler' ),
				),

				
				array(
					'id' =>  'flickr',
					'type' => 'url',
					'name' => esc_html__( 'Flickr URL', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'Tumblr',
					'type' => 'url',
					'name' => esc_html__( 'Tumblr', 'omniscience-profiler' ),
				),
			

				array(
					'id' =>  'pinterest',
					'type' => 'url',
					'name' => esc_html__( 'Pinterest', 'omniscience-profiler' ),
				),


					array(
					'id' =>  'GitHub',
					'type' => 'url',
					'name' => esc_html__( 'Github', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'medium',
					'type' => 'url',
					'name' => esc_html__( 'Medium', 'omniscience-profiler' ),
				),

				//comms
				array(
					'id' =>  'telegram',
					'type' => 'url',
					'name' => esc_html__( 'Telegram ', 'omniscience-profiler' ),
				),



				array(
					'id' =>  'slack',
					'type' => 'url',
					'name' => esc_html__( 'Slack', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'skype',
					'type' => 'url',
					'name' => esc_html__( 'Skype', 'omniscience-profiler' ),
				),

				//video
				array(
					'id' =>  'youtube',
					'type' => 'url',
					'name' => esc_html__( 'YouTube Channel', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'vimeo',
					'type' => 'url',
					'name' => esc_html__( 'Vimeo', 'omniscience-profiler' ),
				),

			array(
				'id' =>  'crunchbase',
				'type' => 'url',
				'name' => esc_html__( 'crunchbase URL', 'omniscience-profiler' ),
			),
							array(
					'id' =>  'rss',
					'type' => 'url',
					'name' => esc_html__( 'RSS Feed URL', 'omniscience-profiler' ),
				),
		
				



// URLs
			array(
				'id' => 'logo_url',
				'type' => 'text',
				'name' => esc_html__( 'Logo URL', 'omniscience-profiler' ),
			),
			array(
				'id' => 'logo_svgtag',
				'type' => 'text',
				'name' => esc_html__( 'Logo SVG', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'contact_url',
				'type' => 'url',
				'name' => esc_html__( 'Contact URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'blog_url',
				'type' => 'url',
				'name' => esc_html__( 'Blog URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'apply_url',
				'type' => 'url',
				'name' => esc_html__( 'Apply URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'jobs_url',
				'type' => 'url',
				'name' => esc_html__( 'Jobs URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'events_url',
				'type' => 'url',
				'name' => esc_html__( 'Events URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'conference_url',
				'type' => 'url',
				'name' => esc_html__( 'Conference URL', 'omniscience-profiler' ),
			),
				array(
				'id' =>  'developers_url',
				'type' => 'url',
				'name' => esc_html__( 'Developers URL', 'omniscience-profiler' ),
			),
			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileURL' );


function setProfileEvents( $meta_boxes ) { // this shows the box where the scrape and search results
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profile_events',
		'title' => esc_html__( 'Profile Events', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'true',
		'fields' => array(
			[
                'type'       => 'post',
                'name'       => esc_html__( 'Events', 'online-generator' ),
                'id'         => 'profile_event',
                'post_type'  => 'event',
                'field_type' => 'checkbox_tree',
                'query_args' => [
                    '' => '',
                ],
            ],
          
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileEvents' );

function setProfileResearch( $meta_boxes ) { // this shows the box where the scrape and search results
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profiler',
		'title' => esc_html__( 'PROFILE RESEARCH', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'advanced',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'card',
				'type' => 'custom_html',
				 //'std'  => '<div class="alert alert-warning">This is a custom HTML content</div>',
				 'callback' => 'profile_menu',
			),
            array(
				'id' => $prefix . 'profile_results',
				'type' => 'custom_html',
				 //'std'  => '<div class="alert alert-warning">This is a custom HTML content</div>',
				 'callback' => 'profiler',
			),
			array(
				'id' => 'search_content',
				'type' => 'textarea',
				'name' => esc_html__( 'Saved Search', 'metabox-online-generator' ),
			),
			array(
				'id' => 'scraped_content',
				'type' => 'textarea',
				'name' => esc_html__( 'Saved Scrape', 'metabox-online-generator' ),
			),
			array(
				'id' => 'lang',
				'type' => 'text',
				'name' => esc_html__( 'Language', 'metabox-online-generator' ),
				'size' => 5,
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileResearch' );


function setResourceProperties( $meta_boxes ) { // this shows the box where the scrape and search results
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'resource_properties',
		'title' => esc_html__( 'Resource Properties', 'omniscience-profiler' ),
		'post_types' => array('resource' ),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => [
            [
                'type' => 'url',
                'name' => esc_html__( 'Resource URL', 'online-generator' ),
                'id'   => $prefix . 'resource_url',
            ],
        ],
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setResourceProperties' );

?>