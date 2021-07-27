<?php

//ENQUE

    function admin_q() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/profiler/admin.css');
		wp_enqueue_style( 'font-awesome','https://use.fontawesome.com/releases/v5.6.3/css/all.css');

		wp_register_script('admin_js', get_template_directory_uri() . '/profiler/admin.js'); 
        wp_enqueue_script('admin_js');
		wp_register_script('ajax_js', get_template_directory_uri() . '/profiler/ajax.js'); 
        wp_enqueue_script('ajax_js');
    }
	add_action('admin_enqueue_scripts', 'admin_q');
	




function getImg($src){
	@$_GET['addImg'] = $src; // the php way. 
	return addImageToLibrary();
	
}




function addImageToLibrary($title,$path){ // THIS ADDS AN IMAGE TO THE MEDIA LIBRARY FROM A SRC URL.
	global $post;
	$image_url = $path;//strtok(@$_GET['addImg'],"?");

	$upload_dir = wp_upload_dir();

	$image_data = file_get_contents( $image_url );
	$ext = pathinfo($image_url, PATHINFO_EXTENSION);
	if($ext ==  ''){
		$filename = basename($image_url);
	} else {
		$filename = basename( sanitize_file_name($title).".".$ext );
	}
	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
	$file = $upload_dir['path'] . '/' . $filename;
	}
	else {
	$file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );
	
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => $title,
		'post_excerpt' => '',
		'post_content' => '',
		'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $file );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	update_post_meta($attach_id, '_wp_attachment_image_alt', $title);
	return $attach_id;
}


function profile_events() {
	if(@$_GET['addImg']){

		addImageToLibrary($_GET['addImg']);
	}

	//THIS IS A HACK, needs to be done right. 
	//Gutternberg doesn't update the dom
	if(@$_GET['updateExcerpt']){
		 $my_post = array(
      'ID'           => @$_GET['POST'],
	  
      'post_excerpt' => json_decode($_GET['updateExcerpt']),
		);

		// Update the post into the database
		wp_update_post( $my_post );
		
	}
	if(@$_GET['updateContent']){

	
	}
	if(@$_GET['updateTitle']){

	
	}


}
add_action( 'admin_init', 'profile_events' );