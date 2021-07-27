<?php

/***************
 * 
 * AT THE BOTTOM OF THE PAGE ARE TEMPATES TO REGISTER POSTS BY HIERARCHICAL AND NOT HIERARCHICAL CUSTOM TAXONOMIES
 * 
 */

/*

	hardware

*/


/*
    integration



add_action( 'rest_api_init', 'register_posts_by_integration' );
 
function register_posts_by_integration() {
 

	register_rest_field( 'integration', 'posts', array(
		'get_callback' => 'get_posts_by_integration',
		'schema' => null,
		)
	);
}
 
function get_posts_by_integration( $object ) {

	$args = array(
    'post_type'      => array('profile'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'integration',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}




/*
    collaboration_type

add_action( 'rest_api_init', 'register_posts_by_collaboration_type' );
 
function register_posts_by_collaboration_type() {
 

	register_rest_field( 'collaboration_type', 'posts', array(
		'get_callback' => 'get_posts_by_collaboration_type',
		'schema' => null,
		)
	);
}
 
function get_posts_by_collaboration_type( $object ) {

	$args = array(
    'post_type'      => array('profile'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'collaboration_type',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}


/*
    platform



add_action( 'rest_api_init', 'register_posts_by_platform' );
 
function register_posts_by_platform() {
 

	register_rest_field( 'platform', 'posts', array(
		'get_callback' => 'get_posts_by_platform',
		'schema' => null,
		)
	);
}
 
function get_posts_by_platform( $object ) {

	$args = array(
    'post_type'      => array('profile'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'platform',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}


/*

	feature


add_action( 'rest_api_init', 'register_posts_by_feature' );
 
function register_posts_by_feature() {
 

	register_rest_field( 'feature', 'posts', array(
		'get_callback' => 'get_posts_by_feature',
		'schema' => null,
		)
	);
}
 
function get_posts_by_feature( $object ) {

	$args = array(
    'post_type'      => array('profile'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'feature',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}


/*

	industry


add_action( 'rest_api_init', 'register_posts_by_industry' );
 
function register_posts_by_industry() {
 

	register_rest_field( 'industry', 'posts', array(
		'get_callback' => 'get_posts_by_industry',
		'schema' => null,
		)
	);
}
 
function get_posts_by_industry( $object ) {

	$args = array(
    'post_type'      => array('profile'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'industry',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}



/*

	feature

*/
/*
add_action( 'rest_api_init', 'register_posts_by_feature' );
 
function register_posts_by_feature() {
 
	register_rest_field( array('feature'), 'posts', array(
		'get_callback' => 'get_posts_by_feature',
		'schema' => null,
		)
	);
}
 

add_action( 'rest_api_init', 'register_feature_children' );
 
function register_feature_children() {
	//this registers the children field
	register_rest_field( array('feature'), 'children', array(
		'get_callback' => 'get_feature_children',
		'schema' => null,
		)
	);
}
function get_feature_children( $object ) {// this returns the child categories to the rest API

	$categories=get_categories(
		array( 'parent' => $object['id'],//sends feature parent
		'fields' => 'ids'//returns only the id fields
		)
	);
	
		
	return $categories; 
}




function get_posts_by_feature( $object ) {

	$args = array(
    'post_type'      => array('post'), // where post types are represented
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'feature',
				'field'    => 'term_id',
				'terms'    => $object['id']
			),
			
			
			
		)
	);
	
		
	return get_posts($args); 
}
*/




/*

	industry



add_action( 'rest_api_init', 'register_posts_by_industry' );
 
function register_posts_by_industry() {
 
	register_rest_field( array('industry'), 'posts', array(
		'get_callback' => 'get_posts_by_industry',
		'schema' => null,
		)
	);
}
 

add_action( 'rest_api_init', 'register_industry_children' );
 
function register_industry_children() {
	//this registers the children field
	register_rest_field( array('industry'), 'children', array(
		'get_callback' => 'get_industry_children',
		'schema' => null,
		)
	);
}
function get_industry_children( $object ) {// this returns the child categories to the rest API

	$categories=get_categories(
		array( 'parent' => $object['id'],//sends industry parent
		'fields' => 'ids'//returns only the id fields
		)
	);
	
		
	return $categories; 
}




function get_posts_by_industry( $object ) {

	$args = array(
    'post_type'      => array('post'), // where post types are represented
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'industry',
				'field'    => 'term_id',
				'terms'    => $object['id']
			),
			
			
			
		)
	);
	
		
	return get_posts($args); 
}
*/







/*

	TAGS

*/



add_action( 'rest_api_init', 'register_posts_by_tag' );
 
function register_posts_by_tag() {
 

	register_rest_field( 'tag', 'posts', array(
		'get_callback' => 'get_posts_by_tag',
		'schema' => null,
		)
	);
}
 
function get_posts_by_tag( $object ) {

	$args = array(
    'post_type'      => array('profile','post','page','resource','hardware'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}
function getPostsByTag(){
	$all_tags = get_tags();
	$tag_id = array();
	foreach( $all_tags as $tag ) {
		$tag_id[] = $tag->term_id;
	}

	$args = array(
		'numberposts' => 5,
		'tag__in' => $tag_id
	);
	$myposts = get_posts( $args );
}


/*

	CATEGORIES

*/
/*

	industry

*/

function get_posts_by_category( $object ) {

	$args = array(
    'post_type'      => array('post','page','profile','resource','hardware'), // where post types are represented
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_taxonomy_id',
				'terms'    => $object['id'],
				'include_children' => false
			),
			
			
			
		)
	);
	
		
	return get_posts($args); 
}

add_action( 'rest_api_init', 'register_posts_by_category' );
 
function register_posts_by_category() {
 
	register_rest_field( 'category', 'posts', array(
		'get_callback' => 'get_posts_by_category',
		'schema' => null,
		)
	);
}

/*
	THIS REQUIRES THE CATEGORY IMAGES PLUGIN
*/

add_action( 'rest_api_init', 'register_category_image' );
 
function register_category_image() { 
	register_rest_field( 'category', 'image', array(
		'get_callback' => 'get_category_image',
		'schema' => null,
		)
	);
}


function get_category_image( $object ) {
	 if (function_exists('z_taxonomy_image_url')){
		$image_path = z_taxonomy_image_url($object['id']);
		$upload_path = parse_url($image_path, PHP_URL_SCHEME)."://".parse_url($image_path, PHP_URL_HOST)."/";
		$file_path = str_replace($upload_path,'',$image_path);
		$file = basename($file_path);
		$path = "/".$file_path;


			return $path;
		} else {
			return "";
		}
}




 


add_action( 'rest_api_init', 'register_category_children' );
 
function register_category_children() {
	//this registers the children field
	register_rest_field( array('category'), 'children', array(
		'get_callback' => 'get_cat_children',
		'schema' => null,
		)
	);
}
function get_cat_children( $object ) {// this returns the child categories to the rest API

	$categories=get_categories(
		array( 'parent' => $object['id'],//sends category parent
		'fields' => 'ids'//returns only the id fields
		)
	);
	
		
	return $categories; 
}








/*
    notheirarchical

    REPLACE notheirarchical to add posts by custom taxonomy 

*/
/*

add_action( 'rest_api_init', 'register_posts_by_notheirarchical' );
 
function register_posts_by_notheirarchical() {
	register_rest_field( 'notheirarchical', 'posts', array(
		'get_callback' => 'get_posts_by_notheirarchical',
		'schema' => null,
		)
	);
}
 
function get_posts_by_notheirarchical( $object ) {
	$args = array(
    'post_type'      => array('profile','post','page'), 
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'notheirarchical',
				'field'    => 'term_id',
				'terms'    => $object['id']
			)
		)
	);
	
		
	return get_posts($args); 
}
*/






/*

    isHeirarchical
    REPLACE isHeirarchical for custom taxonomies with no children

*/
/*
add_action( 'rest_api_init', 'register_posts_by_isHeirarchical' );
 
function register_posts_by_isHeirarchical() {
 
	register_rest_field( array('isHeirarchical'), 'posts', array(
		'get_callback' => 'get_posts_by_isHeirarchical',
		'schema' => null,
		)
	);
}
 

add_action( 'rest_api_init', 'register_isHeirarchical_children' );
 
function register_isHeirarchical_children() {
	//this registers the children field
	register_rest_field( array('isHeirarchical'), 'children', array(
		'get_callback' => 'get_isHeirarchical_children',
		'schema' => null,
		)
	);
}
function get_isHeirarchical_children( $object ) {// this returns the child categories to the rest API

	$categories=get_categories(
		array( 'parent' => $object['id'],//sends isHeirarchical parent
		'fields' => 'ids'//returns only the id fields
		)
	);
	
		
	return $categories; 
}




function get_posts_by_isHeirarchical( $object ) {

	$args = array(
    'post_type'      => array('post','page','profile'), // where post types are represented
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields' => 'ids',
    'tax_query' => array(
			array(
				'taxonomy' => 'isHeirarchical',
				'field'    => 'term_id',
				'terms'    => $object['id']
			),
			
			
			
		)
	);
	
		
	return get_posts($args); 
}
*/
























?>