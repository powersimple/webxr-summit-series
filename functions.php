<?php
 require_once "functions/functions-aframe.php";
//enqueues scripts and styles
require_once("functions/functions-enqueue.php");
require_once("functions/functions-ballot.php");
require_once("functions/metaboxes-aframe.php");

require_once("functions/functions-metabox.php");

	//enqueues scripts and styles
	require_once("functions/functions-rest-endpoints.php");
	// special class to register the restapi

	require_once("functions/functions-post-types.php");
	require_once("functions/functions-profiles.php");
	require_once("functions/functions-events.php");
	require_once("functions/functions-awards.php");
	require_once("functions/functions-virtual-production.php");
	require_once("functions/functions-rest-menus.php");
	// custom functions to register fields into the restapi
	require_once("functions/functions-rest-register.php");
	require_once("functions/functions-rest-taxonomy.php");
	require_once("functions/functions-navigation.php");
	require_once("functions/functions-custom-menu-admin.php");
	require_once("functions/functions-entities.php");	
	require_once("functions/functions-publish.php");   
	require_once("functions/parsers.php");
	require_once("functions/import.php");
	require_once("profiler/profiler.php");

	require_once("scraper/simple_html_dom.php");
	require_once("functions/functions-print.php");
	require_once("functions/functions-post-access.php");
	
	add_post_type_support( 'page', 'excerpt' );

	add_action('admin_notices', 'show_content_url');
	function show_content_url() {
		echo '<div class="notice notice-info is-dismissible">';
		echo '<p>Content URL: ' . content_url() . '</p>';
		echo '</div>';
	}

function featured_image_support(){
	add_theme_support('post-thumbnails', array(
		'post',
		'page',
		'social',
		'profile',
		'resource',
		'sponsor',
		'event'
		));
}

// former field filtration plugin,
//require_once('functions/rest-api-filter-fields.class.php');
 
  
add_action('after_setup_theme', 'featured_image_support');







function add_mimes($mime_types){
	$mime_types['gltf'] = 'model/gltf+json';
	$mime_types['usdz'] = 'model/vnd.usdz+zip';
	$mime_types['glb'] = 'model/gltf-binary'; 
	return $mime_types;
}
add_filter('upload_mimes', 'add_mimes');


function is_gutenberg() {
    
    global $post;
    
    if ( function_exists( 'has_blocks' ) && has_blocks( $post->ID ) ){
        return true;    
    } else {
        return false;
    }
}
function stripURL($path){
	
	return parse_url($path, PHP_URL_PATH);

}


		/* OLD RELIABLE!
        HASN'T CHANGED IN YEARS
            RETURNS URL BY ID, AND OPTIONAL SIZE */
		function getThumbnail($id,$use="full"){
			global $post;
			
			
			$img = wp_get_attachment_image_src(  $id, $use);
			if(is_array($img)){
				if($img[0] !=""){
					return stripURL($img[0]);
				} 
			}
			return $img;//$img[0];
			
		}
	

	
		/* 	PASS ID AND IT RETURNS OBJECT OF SIZES BY URL */
		function getThumbnailVersions($id){
				global $post;
				$thumbnail_versions = array(); //creates the array of size by url
				foreach(get_intermediate_image_sizes() as $key => $size){//loop through sizes
					$img = wp_get_attachment_image_src($id,$size);//get the url 
					
					if(@$img[0] !=""){
						$version = str_replace('https://'.$_SERVER['HTTP_HOST'],'',$img[0]);
						$version = str_replace('https://'.$_SERVER['HTTP_HOST'],'',$img[0]);
						
						$thumbnail_versions[$size]=$version;//sets size by url
					} 
				}
				return $thumbnail_versions;
			
		}
	function my_wpcf7_form_elements($html) {
    $text = 'Select Option';
    $html = str_replace('Select Primary Industry',  $text , $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');
	
	
	 function get_slides( $id ) {
		return get_post_meta($id,"screen_image") ;//from functions.php,
		}
		//Embed Video  Shortcode
	
		function video_shortcode( $atts, $content = null ) {
			//set default attributes and values
			$atts = shortcode_atts( array(
				'url'   	=> '#',
				'className'	=> 'video-embed',
				'aspect' => '56.25%'
			), $atts );
			
			ob_start();
			?>
			<div class="video-wrapper">
				<iframe src="<?=$atts['url']?>" class="<?=$atts['className']?>"></iframe>
			</div> 
			<?php
		
			return ob_get_clean();
			//return '<a href="'. esc_attr($values['url']) .'"  target="'. esc_attr($values['target']) .'" class="btn btn-green">'. $content .'</a>';
		
		}
		add_shortcode( 'embed_video', 'video_shortcode' );



		function embed_video_file_shortcode($atts) {
			// Extract the media_id and className parameters from the shortcode
			$atts = shortcode_atts(array(
				'media_id' => '',
				'className' => '',
			), $atts);
		
			// Check if a media ID is provided
			if (!empty($atts['media_id'])) {
				// Get the media URL by media ID
				$media_url = wp_get_attachment_url($atts['media_id']);
		
				// Check if the media URL exists
				if ($media_url) {
					// Create a wrapper div with the specified class
					$output = '<div class="video-wrapper embed-video-file ' . esc_attr($atts['className']) . '">';
		
					// Create the video tag with the media URL

					$output .= '<video class="video-wrapper" controls>';
					$output .= '<source src="' . esc_url($media_url) . '" type="video/mp4">';
					$output .= '</video>';
		
					// Close the wrapper div
					$output .= '</div>';
		
					// Return the HTML output
					return $output;
				} else {
					return 'Media not found.';
				}
			} else {
				return 'Please provide a media_id parameter.';
			}
		}
		
		// Register the shortcode
		add_shortcode('embed_video_file', 'embed_video_file_shortcode');
		

		function add_category_to_page() {  
			// Add tag metabox to page
			register_taxonomy_for_object_type('post_tag', 'page'); 
			// Add category metabox to page
			register_taxonomy_for_object_type('category', 'page');  
		}
		 // Add to the admin_init hook of your theme functions.php file 
		add_action( 'init', 'add_category_to_page' );

function buttonLink($id){
	ob_start();
	?>
		<div id="button-container">
			<div id="button_card" class="shadow">
				<div class="front face">
					<img src="/wp-content/uploads/2018/05/powersimple-emblem-01.svg"/>
				</div>
				<div class="back face">
					<h2>Home</h2>
					<p style="font-weight: 100; margin-top: -40px;">This isn't my logo, but it's a nice one to feature and show off this CSS!</p>
				</div>
			</div>
		</div>

	<?php
	return ob_get_clean();	

}


add_action( 'rest_api_init', 'register_video_meta' );
function register_video_meta() {
    register_rest_field( 'page',
        'video',
        array(
            'get_callback'    => 'get_featured_video',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function modify_post_title() {
	// Remove the specified strings from the title
$title = get_the_title();
	$strip = @get_post_meta(get_the_id(),"section_strip_from_label",true);
	$modified_title = str_replace($strip, "", $title);

	// Return the modified title
	return $modified_title;
  }



function get_attachment($id){
	$url = wp_upload_dir();
	
    $uploads_path =  $url['baseurl']."/";
	return  $uploads_path . get_post_meta($id,"_wp_attached_file",true);


}



function display_videos($videos){
		ob_start();
	$default_video = $videos[0]['video_url'];
	$default_video_title = $videos[0]['post_title'];
	
	?>
	<div id="videos">
			<div id="video-player">
			
				<iframe src="<?=$default_video?>?rel=0&fs=1" scrolling="no" frameborder="0" id="video"  allowfullscreen></iframe>
			</div>
		<p id="video-title-display"><?=$default_video_title?></p>
			<ul id="video-playlist">
		<?php
		foreach($videos as $key => $value){
			extract($value);
				$title_clean = str_replace('"','',$post_title);
				$title_clean = str_replace("'","\'",$title_clean);
				
			?>
              <li><a href="#" onMouseover="displayTitle('Watch: <?=$title_clean?>');" onMouseOut="" onClick="play('<?=$video_url?>?rel=0', '<?=$title_clean ?>'); return false;" title="<?=$title_clean ?>"><img src="<?=$src?>" alt="<?=$title_clean?>"></a><span class="video-label"><?=$post_title?></span></li>
		<?php
		}
		?>
		</ul>
	</div>
	<?php
	
	return ob_get_clean();	
}

function getHardwareProperties($hardware){
		extract($hardware);
		$thumbnail_id = get_post_meta($ID,"_thumbnail_id",true);
	return array("id"=>"$ID",
				"title" => $post_title,
				"content" => do_blocks($post_content),
				"excerpt" => $post_excerpt,
				"slug" => $post_name,
				"thumbnail"=>getThumbnail($thumbnail_id),
				"acccessories" => get_post_meta($ID,"acccessories",true),
				"connectivity" => get_post_meta($ID,"connectivity",true),
				"controllers" => get_post_meta($ID,"controllers",true),
				"device_name" => get_post_meta($ID,"device_name",true),
				"fov" => get_post_meta($ID,"fov",true),
				"gaze_tracking" => get_post_meta($ID,"gaze_tracking",true),
				"hand_tracking" => get_post_meta($ID,"hand_tracking",true),
				"MSRP" => get_post_meta($ID,"MSRP",true),
				"optics" => get_post_meta($ID,"optics",true),
				"os" => get_post_meta($ID,"os",true),
				"refresh_rate" => get_post_meta($ID,"refresh_rate",true),
				"resolution" => get_post_meta($ID,"resolution",true),
				"sensors" => wpautop(get_post_meta($ID,"sensors",true)),
				"spatail_audio" => get_post_meta($ID,"spatial_audio",true),
				"specs_url" => get_post_meta($ID,"specs_url",true),
				"system_requirements" => get_post_meta($ID,"acccessories",true),
				"untethered" => get_post_meta($ID,"untethered",true),
				"url" => get_post_meta($ID,"url",true),
				"weight" => get_post_meta($ID,"weight",true),



				
			
			);




}
function url_root(){
      
    $path= parse_url(get_stylesheet_directory_uri());
    $url_root= $path['scheme']."://".$path['host'];
    if(@$path['port']){
            $url_root.=":".$path['port'];
    }
    return $url_root;
}
function getHardwareListing($parent_id){
	
$children = get_children( array("post_parent"=>$parent_id,'post_type'=>'hardware','orderby' => 'menu_order ASC','order' => 'ASC') );
		$child_list = array();
		
        $counter = 0;
		foreach ($children as $key => $value) {
            
            $child_list[$counter] = getHardwareProperties((array) $value);
			$counter++;
		}
	//	var_dump($child_list);
		return $child_list;

}



function enqueue_glb_model_viewer_script() {
    // MODEL VIEWER IN WP-ADMIN
    $screen = get_current_screen();
    $is_media_library = $screen->id === 'upload';
    $is_metabox_page = $screen->id === 'post' && isset( $_GET['post'] ) && get_post_meta( $_GET['post'], 'logo_3D', true );

    // Enqueue the Model Viewer script only on the appropriate admin pages
    if ( $is_media_library || $is_metabox_page ) {
        add_action( 'admin_footer', 'print_model_viewer_script' );
    }
}
add_action('admin_enqueue_scripts', 'enqueue_glb_model_viewer_script');
function print_model_viewer_script() {
    if ( ! current_user_can( 'upload_files' ) ) {
        return;
    }

    echo '<style>
        .model-viewer-container {
            position: relative;
            height: 100%;
        }

        .model-viewer-container img.icon {
            display: none;
        }
    </style>';

    echo '<script>
        (function($
            $(document).ready(function() {
                function updateMediaTile(attachmentElement) {
                    const attachmentId = $(attachmentElement).data("id");

                    if (!wp.media || !wp.media.attachment) {
                        return;
                    }

                    const attachment = wp.media.attachment(attachmentId);

                    if (!attachment || !attachment.attributes || attachment.attributes.subtype !== "gltf-binary") {
                        return;
                    }
                }

                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === "childList" && mutation.addedNodes.length > 0) {
                            mutation.addedNodes.forEach(function(addedNode) {
                                if (addedNode.classList && addedNode.classList.contains("attachment")) {
                                    updateMediaTile(addedNode);
                                }
                            });
                        }
                    });
                });

                const mediaLibraryContainer = $(".attachments-browser .attachments");
                if (mediaLibraryContainer.length > 0) {
                    observer.observe(mediaLibraryContainer[0], { childList: true });
                }
                
                // Add a test message to each media item tile outside the function and observer
                $(".attachment .filename div").append("<span> Test message</span>");
            });
        })(jQuery);
    </script>';
}




function add_glb_model_viewer_code( $field, $meta, $object_id, $field_id ) {
	//MODEL VIEWER IN METABAX
    // Check if the field is for the logo_3D image_advanced field
    if ( $field_id === 'logo_3D' ) {
        // Get the selected image's URL
        $image_url = wp_get_attachment_url( $meta );

        // Check if the selected file is a .glb file
        $file_type = wp_check_filetype( $image_url );
        if ( $file_type['ext'] === 'glb' ) {
            // Define the Model Viewer code to display the .glb file
            $model_viewer_code = '<model-viewer src="' . esc_url( $image_url ) . '"
                                  alt="A 3D model"
                                  camera-controls
                                  background-color="#f8f8f8"></model-viewer>';

            // Output the Model Viewer code after the logo_3D field
            echo $model_viewer_code;
        }
    }
}
add_action( 'rwmb_frontend_after_field', 'add_glb_model_viewer_code', 10, 4 );

function add_model_viewer_column( $cols ) {
    $cols['model_viewer'] = 'Model Viewer';
    return $cols;
}
add_filter( 'manage_media_columns', 'add_model_viewer_column' );

function add_model_viewer_content( $column_name, $attachment_id ) {
    if ( $column_name === 'model_viewer' && get_post_mime_type( $attachment_id ) === 'model/gltf-binary' ) {
        $glb_file_url = wp_get_attachment_url( $attachment_id );
        $model_viewer_code = '<model-viewer src="' . $glb_file_url . '" alt="3D Model" camera-controls></model-viewer>';
        echo $model_viewer_code;
    }
}
add_action( 'manage_media_custom_column', 'add_model_viewer_content', 10, 2 );
function add_glb_mime_type( $mimes ) {
    $mimes['glb'] = 'model/gltf-binary';
    return $mimes;
}
add_filter( 'upload_mimes', 'add_glb_mime_type' );



?>
