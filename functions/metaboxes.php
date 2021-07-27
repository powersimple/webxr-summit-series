<?php

function selectScreenImage( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'slides',
		'title' => esc_html__( 'Slider', 'metabox-online-generator' ),
		'post_types' => array( 'post', 'page','project' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => 'video_embed_url',
				'type' => 'url',
				'name' => esc_html__( 'Video Embed URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'top_slider',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Slides', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Appears in header if home page', 'metabox-online-generator' ),
				'force_delete' => false,
				'max_file_uploads' => '10',
				'options' => array(),
				'attributes' => array(),
			),
			array(
				'id' => 'section_foot',
				'type' => 'image_advanced',
				'name' => esc_html__( 'section-foot-bg', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Appears at bottom of section', 'metabox-online-generator' ),
				'force_delete' => false,
				'max_file_uploads' => '1',
				'options' => array(),
				'attributes' => array(),
			),
		),
	);

	return $meta_boxes;
}


function selectHeroImage( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'hero',
		'title' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
		'post_types' => array('post', 'page','resource','profile','guide'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'hero',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Size to 1920x1280', 'metabox-online-generator' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectHeroImage' );

function setSessionDetails( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'slides',
		'title' => esc_html__( 'Session Details', 'metabox-online-generator' ),
		'post_types' => array( 'conference' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'session_start',
				'type' => 'datetime',
				'name' => esc_html__( 'Session Start', 'metabox-online-generator' ),
				'std' => '1540540800',
				'desc' => esc_html__( 'Set the date and time for the session start', 'metabox-online-generator' ),
				'timestamp' => 'true',
			),
			array(
				'id' => $prefix . 'session_end',
				'name' => esc_html__( 'Session Ends', 'metabox-online-generator' ),
				'type' => 'time',
			),
			array(
				'id' => 'video_embed_url',
				'type' => 'url',
				'name' => esc_html__( 'Video Embed URL', 'metabox-online-generator' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setSessionDetails' );





function setSessionSpeakers( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'session-speakers',
		'title' => esc_html__( 'Speakers', 'metabox-online-generator' ),
		'post_types' => array('conference' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'speakers',
				'type' => 'post',
				'name' => esc_html__( 'Speakers', 'metabox-online-generator' ),
				'post_type' => 'speaker',
				'field_type' => 'checkbox_list',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setSessionSpeakers' );


function setSubNav( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'session-speakers',
		'title' => esc_html__( 'Speakers', 'metabox-online-generator' ),
		'post_types' => array('post', 'page','resource','award','profile'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'subnav',
				'name' => esc_html__( 'Select Subnav', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					'children' => 'Page Children',
					'siblings' => 'Siblings',
					'award' => 'Awards',
					'conference' => 'Conferences',
					'resources' => 'Resources',
					
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setSubnav' );



function speaker_info( $meta_boxes ) {
	$prefix = 'prefix-';

	$meta_boxes[] = array(
		'id' => 'speaker_info',
		'title' => esc_html__( 'Speaker Info', 'metabox-online-generator' ),
		'post_types' => array('speaker' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'speaker_title',
				'type' => 'text',
				'name' => esc_html__( 'Title', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_company',
				'type' => 'text',
				'name' => esc_html__( 'Organization', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_website',
				'type' => 'url',
				'name' => esc_html__( 'Website', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_wikipedia',
				'type' => 'url',
				'name' => esc_html__( 'Wikipedia URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_linkedin',
				'type' => 'url',
				'name' => esc_html__( 'LinkedIn URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_twitter',
				'type' => 'url',
				'name' => esc_html__( 'Twitter URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_facebook',
				'type' => 'url',
				'name' => esc_html__( 'Facebook URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_flickr',
				'type' => 'url',
				'name' => esc_html__( 'Flickr URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'speaker_instagram',
				'type' => 'url',
				'name' => esc_html__( 'Instagram URL', 'metabox-online-generator' ),
			),
			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'speaker_info' );

function setSessionSponsors( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'session-sponsors',
		'title' => esc_html__( 'Sponsors', 'metabox-online-generator' ),
		'post_types' => array('conference' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' =>  'sponsors',
				'type' => 'post',
				'name' => esc_html__( 'Sponsors', 'metabox-online-generator' ),
				'post_type' => 'sponsor',
				'field_type' => 'checkbox_list',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setSessionSponsors' );



function book_info( $meta_boxes ) {
	$prefix = 'prefix-';

	$meta_boxes[] = array(
		'id' => 'books',
		'title' => esc_html__( 'Book URL', 'metabox-online-generator' ),
		'post_types' => array('book' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'amazon_url',
				'type' => 'text',
				'name' => esc_html__( 'Amazon URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'ibooks_url',
				'type' => 'text',
				'name' => esc_html__( 'iBooks URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'bn_url',
				'type' => 'url',
				'name' => esc_html__( 'Barnes and Noble URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'kobo_url',
				'type' => 'url',
				'name' => esc_html__( 'Kobo URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'googleplay_url',
				'type' => 'url',
				'name' => esc_html__( 'Google Play URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'goodreads_url',
				'type' => 'url',
				'name' => esc_html__( 'Goodreads URL', 'metabox-online-generator' ),
			),
		
			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'book_info' );


function setSponsors( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'sponsors',
		'title' => esc_html__( 'Sponsor Info', 'metabox-online-generator' ),
		'post_types' => array('sponsor' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'sponsor-url',
				'type' => 'url',
				'name' => esc_html__( 'Sponsor URL', 'metabox-online-generator' ),
				'post_type' => 'sponsor'
			),
			array(
				'id' => $prefix . 'sponsor_level',
				'name' => esc_html__( 'Sponsorship Level', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select Level', 'metabox-online-generator' ),
				'options' => array(
					'Terrabit' => 'Terrabyte Sponsor',
					'Gigabit' => 'Gigabit',
					'Megabit' => 'Megabit',
					'Community' => 'Community Stakeholder',
					'After Party' => 'After Party',
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setSponsors' );



function setAppearanceInfo( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'sponsors',
		'title' => esc_html__( 'Appearance Info', 'metabox-online-generator' ),
		'post_types' => array('appearance' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'appearance',
				'type' => 'text',
				'name' => esc_html__( 'Venue', 'metabox-online-generator' ),
				'desc' => esc_html__( 'What was the forum' ),
			),
			array(
				'id' => $prefix . 'external_url',
				'type' => 'url',
				'name' => esc_html__( 'External URL', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Use this if the user leaves the page, and set the featured image as thumbnail', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'embed_url',
				'type' => 'url',
				'name' => esc_html__( 'Embed URL', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Use this if the media is embeded in an iframe and has its own poster image' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setAppearanceInfo' );





function setReviewInfo( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'review_info',
		'title' => esc_html__( 'Review Info', 'metabox-online-generator' ),
		'post_types' => array('review' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		
		'fields' => array(
			array(
				'id' => 'st',
				'type' => 'review_url',
				'name' => esc_html__( 'Review URL', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'stars',
				'name' => esc_html__( 'Review Stars', 'metabox-online-generator' ),
				'type' => 'radio',
				'placeholder' => esc_html__( 'Select Stars', 'metabox-online-generator' ),
				'options' => array(
					'5-stars' => '5 Stars',
					'4-stars' => '4 Stars',
					'3-stars' => '3 Stars',
					'2-stars' => '2 Stars',
					'1-stars' => '1 Stars',
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setReviewInfo' );

function setResourceInfo( $meta_boxes ) {
	$prefix = '';
//$scrape_link= "<a href='#' onclick='scrapeResourceURL()'>Scrape</a>";
	$meta_boxes[] = array(
		'id' => 'resource_info',
		'title' => esc_html__( "Resource Info", 'metabox-online-generator' ),
		'post_types' => array('resource' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		
		'fields' => array(
			array(
				'id' => $prefix . 'resource_type',
				'name' => esc_html__( 'Resource Type', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					'article' => 'Article',
					'video' => 'Video',
					'podcast' => 'Podcast',
					'website' => 'Website',
					'picture_book' => 'Picture Book',
					'book' => 'Book',
				),
			),
			array(
				'id' => $prefix . 'link',
				'type' => 'url',
				'name' => esc_html__( "Resource URL  ", 'metabox-online-generator' ),
				'desc' => esc_html__( "", 'metabox-online-generator' ),
				'placeholder' => esc_html__( 'https://', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'ombed',
				'type' => 'oembed',
				'name' => esc_html__( 'oEmbed', 'metabox-online-generator' ),
			)
		
		

		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setResourceInfo' );

function resourceProfiles( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profile',
		'title' => esc_html__( 'Profiles', 'metabox-online-generator' ),
		'post_types' => array('resource' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'profile',
				'type' => 'post',
				'name' => esc_html__( 'Profiles', 'metabox-online-generator' ),
				'post_type' => 'profile',
				'field_type' => 'checkbox_list',
				'orderby' => 'menu_order',
				'order' => 'ASC',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'resourceProfiles' );


function sdgPosts( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'SDG',
		'title' => esc_html__( 'SDGs', 'metabox-online-generator' ),
		'post_types' => array('post', 'page','resource','award','profile' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'sdg',
				'type' => 'post',
				'name' => esc_html__( 'SDG', 'metabox-online-generator' ),
				'post_type' => 'sdg',
				'field_type' => 'checkbox_list',
				'orderby' => 'menu_order',
				'order' => 'ASC',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'sdgPosts' );

function typeSubnav( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'type_subnav',
		'title' => esc_html__( 'Type Subnav', 'metabox-online-generator' ),
		'post_types' => array('page' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'postype_subnav',
				'name' => esc_html__( 'Post Type Subnav', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					'children' => 'Post Children',
					
					'conference' => 'Conferences',
					'award' => 'Awards',
					'resource' => 'Resources',
					
					'speaker' => 'speaker',
					'sdg' => 'SDGs',
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'typeSubnav' );



function profileInfo( $meta_boxes ) {
	$prefix = 'profile_';

	$meta_boxes[] = array(
		'id' => 'untitled',
		'title' => esc_html__( 'Speaker Links', 'metabox-online-generator' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
				array(
					'id' => 'name',
					'type' => 'text',
					'name' => esc_html__( 'name', 'metabox-online-generator' ),
				),
				array(
					'id' => 'acronym',
					'type' => 'text',
					'name' => esc_html__( 'Official Acronym', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'description',
					'type' => 'text',
					'name' => esc_html__( 'Description', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'location',
					'type' => 'text',
					'name' => esc_html__( 'location', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'website',
					'type' => 'url',
					'name' => esc_html__( 'Website', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'rss',
					'type' => 'url',
					'name' => esc_html__( 'RSS Feed URL', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'email',
					'type' => 'email',
					'name' => esc_html__( 'Email Address', 'metabox-online-generator' ),
				),
		
				array(
					'id' =>  'wikipedia',
					'type' => 'url',
					'name' => esc_html__( 'Wikipedia URL', 'metabox-online-generator' ),
				),




				array(
					'id' =>  'linkedin',
					'type' => 'url',
					'name' => esc_html__( 'LinkedIn URL', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'twitter',
					'type' => 'url',
					'name' => esc_html__( 'Twitter URL', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'facebook',
					'type' => 'url',
					'name' => esc_html__( 'Facebook URL', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'flickr',
					'type' => 'url',
					'name' => esc_html__( 'Flickr URL', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'instagram',
					'type' => 'url',
					'name' => esc_html__( 'Instagram URL', 'metabox-online-generator' ),
				),

			
				array(
					'id' =>  'Tumblr',
					'type' => 'url',
					'name' => esc_html__( 'Tumblr', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'google_plus',
					'type' => 'url',
					'name' => esc_html__( 'Google Plus', 'metabox-online-generator' ),
				),

				array(
					'id' =>  'pinterest',
					'type' => 'url',
					'name' => esc_html__( 'Pinterest', 'metabox-online-generator' ),
				),


					array(
					'id' =>  'GitHub',
					'type' => 'url',
					'name' => esc_html__( 'Github', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'medium',
					'type' => 'url',
					'name' => esc_html__( 'Medium', 'metabox-online-generator' ),
				),

				//comms
				array(
					'id' =>  'telegram',
					'type' => 'url',
					'name' => esc_html__( 'Telegram ', 'metabox-online-generator' ),
				),



				array(
					'id' =>  'slack',
					'type' => 'url',
					'name' => esc_html__( 'Slack', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'skype',
					'type' => 'url',
					'name' => esc_html__( 'Skype', 'metabox-online-generator' ),
				),

				//video
				array(
					'id' =>  'youtube',
					'type' => 'url',
					'name' => esc_html__( 'YouTube Channel', 'metabox-online-generator' ),
				),
				array(
					'id' =>  'vimeo',
					'type' => 'url',
					'name' => esc_html__( 'Vimeo', 'metabox-online-generator' ),
				),



// URLs
			array(
				'id' => 'logo_url',
				'type' => 'text',
				'name' => esc_html__( 'Logo URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'logo_svgtag',
				'type' => 'text',
				'name' => esc_html__( 'Logo SVG', 'metabox-online-generator' ),
			),
			array(
				'id' =>  'contact_url',
				'type' => 'url',
				'name' => esc_html__( 'Contact URL', 'metabox-online-generator' ),
			),
			array(
				'id' =>  'blog_url',
				'type' => 'url',
				'name' => esc_html__( 'Blog URL', 'metabox-online-generator' ),
			),
			array(
				'id' =>  'apply_url',
				'type' => 'url',
				'name' => esc_html__( 'Apply URL', 'metabox-online-generator' ),
			),
			array(
				'id' =>  'jobs_url',
				'type' => 'url',
				'name' => esc_html__( 'Jobs URL', 'metabox-online-generator' ),
			),
			array(
				'id' =>  'events_url',
				'type' => 'url',
				'name' => esc_html__( 'Events URL', 'metabox-online-generator' ),
			),
			array(
				'id' =>  'conference_url',
				'type' => 'url',
				'name' => esc_html__( 'Conference URL', 'metabox-online-generator' ),
			),


			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'profileInfo' );



function getProperties( $meta_boxes ) {
	$prefix = 'sdg_';

	$meta_boxes[] = array(
		'id' => 'sdg',
		'title' => esc_html__( 'Properties', 'metabox-online-generator' ),
		'post_types' => array('page','sdg' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(

			array(
					'id' =>  'sdg-class',
					'type' => 'text',
					'name' => esc_html__( 'class', 'metabox-online-generator' ),
				),
			/*array(
				'id' => $prefix . 'color',
				'name' => esc_html__( 'SDG Color', 'metabox-online-generator' ),
				'type' => 'color',
			),*/
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'getProperties' );



function eventMeta( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'sdg',
		'title' => esc_html__( 'Event Data', 'metabox-online-generator' ),
		'post_types' => array('event' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'event_type',
				'name' => esc_html__( 'event_type', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					'Symposium' => 'Symposium',
					'Neetup' => 'Meetup',
					'Conference' => 'Conference',
					'International Day' => 'International Day',
					
				),
			),
			array(
				'id' => $prefix . 'event_url',
				'type' => 'url',
				'name' => esc_html__( 'Event URL', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'register_url',
				'type' => 'url',
				'name' => esc_html__( 'Registration URL', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'event_cost',
				'type' => 'text',
				'name' => esc_html__( 'Ticket Price', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'event_location',
				'type' => 'text',
				'name' => esc_html__( 'Event Location', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'event_date_start',
				'type' => 'date',
				'name' => esc_html__( 'Start Date', 'metabox-online-generator' ),
				'timestamp' => 'true',
			),
			array(
				'id' => $prefix . 'end_date',
				'type' => 'date',
				'name' => esc_html__( 'End Date', 'metabox-online-generator' ),
				'timestamp' => 'true',
			),
			array(
				'id' => $prefix . 'start_time',
				'name' => esc_html__( 'Start Time', 'metabox-online-generator' ),
				'type' => 'time',
			),
			array(
				'id' => $prefix . 'end_time',
				'name' => esc_html__( 'End Time', 'metabox-online-generator' ),
				'type' => 'time',
			),
			array(
				'id' => $prefix . 'recurs',
				'name' => esc_html__( 'Recurs Every Year On Same Day', 'metabox-online-generator' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Default Description', 'metabox-online-generator' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'eventMeta' );


?>