<?php
    function featuredImageFromURL($post_id,$url){
        // Add Featured Image to Post
        $image_url        = $url; // Define the image URL here
        $image_name       = basename($url);
        $upload_dir       = wp_upload_dir(); // Set upload folder
        $image_data       = file_get_contents($image_url); // Get image data
        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
        $filename         = basename( $unique_file_name ); // Create image file name

        // Check folder permission and define file location
        if( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        // Create the image  file on the server
        file_put_contents( $file, $image_data );

        // Check image file type
        $wp_filetype = wp_check_filetype( $filename, null );

        // Set attachment data
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Create the attachment
        $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

        // Include image.php
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Define attachment metadata
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

        // Assign metadata to attachment
        wp_update_attachment_metadata( $attach_id, $attach_data );

        // And finally assign featured image to post
        set_post_thumbnail( $post_id, $attach_id );
    }

    function project_meta_fields($field_list){
        $fields = array();
       
        foreach(explode(",",$field_list) as $key=>$field){
            $label = ucfirst($field);
            array_push(
                $fields,
                array(
                    'id' => $field,
                    'type' => 'text',
                    'name' => esc_html__( $label, 'civictech' ),
                    'placeholder' => esc_html__( '', 'civictech' ),
                )
            );
 
        }


        return $fields;


    
}    


function project_social_meta( $meta_boxes ) {
	$prefix = '';
 $field_list = "URL,twitter,facebook,linkedin,github,tumblr,google_plus,tumblr,medium,telegram,slack,skype,instagram,youtube,vimeo,pinterest,behance,rss";
	$meta_boxes[] = array(
		'id' => 'social_meta',
		'title' => esc_html__( 'Social', 'civictech' ),
		'post_types' => array( 'project' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => project_meta_fields($field_list) // instead of manually creating this array, used a function instead.

	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'project_social_meta' );

function project_contact_meta( $meta_boxes ) {
	$prefix = '';
 $field_list = "email,telphone,address,address2,city,state,postal_code,country";
	$meta_boxes[] = array(
		'id' => 'contact_meta',
		'title' => esc_html__( 'Contact', 'civictech' ),
		'post_types' => array( 'project' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => project_meta_fields($field_list) // instead of manually creating this array, used a function instead.

	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'project_contact_meta' );


    function writeJSON($data,$file_path){
        $handle = fopen($file_path, 'w') or die('Cannot open file:  '.$file_path);
        fwrite($handle, $data);
        fclose($handle);
    }
?>