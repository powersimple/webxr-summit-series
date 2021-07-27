<?php

//enqueues scripts and styles
require_once("functions/functions-enqueue.php");
require_once("functions/functions-ballot.php");
require_once("functions/functions-metabox.php");
//enqueues scripts and styles
require_once("functions/functions-rest-endpoints.php");
// special class to register the restapi

//enqueues scripts and styles
require_once("functions/functions-post-types.php");
require_once("functions/functions-profiles.php");
require_once("functions/functions-events.php");
require_once("functions/functions-rest-menus.php");
// custom functions to register fields into the restapi
require_once("functions/functions-rest-register.php");
require_once("functions/functions-rest-taxonomy.php");
require_once("functions/functions-navigation.php");
	   
require_once("functions/parsers.php");
require_once("profiler/profiler.php");

require_once("scraper/simple_html_dom.php");
require_once("functions/functions-print.php");
	require_once("functions/functions-post-access.php");
	
	add_post_type_support( 'page', 'excerpt' );
add_theme_support('post-thumbnails', array(
'post',
'page',
'social',
'profile',
'resource',
'sponsor'
));



		/* OLD RELIABLE!
        HASN'T CHANGED IN YEARS
            RETURNS URL BY ID, AND OPTIONAL SIZE */
		function getThumbnail($id,$use="full"){
			global $post;
			
			
			$img = wp_get_attachment_image_src(  $id, $use);
			if(is_array($img)){
				if($img[0] !=""){
					return $img[0];
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
						$thumbnail_versions[$size]=$img[0];//sets size by url
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
		return get_post_meta($id,"top_slider") ;//from functions.php,
		}
		//Embed Video  Shortcode
	
		function video_shortcode( $atts, $content = null ) {
			//set default attributes and values
			$values = shortcode_atts( array(
				'url'   	=> '#',
				'className'	=> 'video-embed',
				'aspect' => '56.25%'
			), $atts );
			
			ob_start();
			?>
			<div class="video-wrapper">
				<iframe src="<?=$values['url']?>" class="<?=$values['className']?>"></iframe>
			</div> 
			<?php
			return ob_get_clean();
			//return '<a href="'. esc_attr($values['url']) .'"  target="'. esc_attr($values['target']) .'" class="btn btn-green">'. $content .'</a>';
		
		}
		add_shortcode( 'embed_video', 'video_shortcode' );

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

?>