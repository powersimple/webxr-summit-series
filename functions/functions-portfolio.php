<?php 
/*


function get_portfolio_categories(){
	
	$portfolios = get_portfolios();
	$portfolio_categories = array();
	$portfolio_categories["all"] = array();
	
	foreach($portfolios as $key => $portfolio){
		extract( $portfolio);
	
		 $categories = get_the_category( $id);
		// $portfolio['portfolioship_level'] = get_post_meta($id,"portfolioship_level",true);
		
	
		foreach ( $categories  as $key => $value ) {
			
			$value = (array) $value;
		  extract($value);
		 	 
			 if(!array_key_exists($slug,$portfolio_categories)){
			 	$portfolio_categories[$slug]  = array();
             }
             
			 $portfolioship_level=
			array_push($portfolio_categories[$slug],$portfolio);
            //var_dump($value);
           // print "<BR><BR>";
			
		}
		
		
	}
    //	var_dump($portfolio_categories);

    return $portfolio_categories;
	
	
	
}
//PREDATES RESTAPI REGISTRATION
function display_portfolio_links($portfolios){
	
		ob_start();
		print '<ul class="portfolio-category">';
	
	
		foreach($portfolios as $key => $value){
			extract((array) $value);
				print $key;
			$portfolio_url = get_post_meta($id,"portfolio_url",true);
				print "<li class='portfolio'><a href=\"$portfolio_url\" target=\"_blank\">
				<img src=\"$src\" title\"$title\">$title</a>
				<span class=\"portfolioship-level\">$portfolioship_level</span>
				</li>
				
				";
		}
		print "<ul>";
	
	return ob_get_clean();
}
function display_portfolio_categories($portfolios){
	
		ob_start();
		print '<ul class="portfolio-category">';
	
		foreach(@$portfolios as $key => $value){
			
			extract((array) $value);
			
				print "<li class='portfolio'><a href=\"$link\">
				<img src=\"$src\" title\"$title\"></a>
				
				</li>
				";
		}
		print "<ul>";
	
	return ob_get_clean();
}
function display_portfolios($cols,$use="thumbnail"){
	$padding = $cols-1;
	$width = intval((100-($cols+1))/$cols);
	
	
	$portfolios = get_portfolios($use);
	ob_start();
		print "<ul style='padding-left:1%'>";
		foreach($portfolios as $key => $value){
			extract($value);
				print "<li class='portfolio' style='margin-right:1%;width:$width%;padding-bottom:$width%;' title='$title'><a href=\"$link\">
				<img src=\"$src\" title\"$title\"></a></li>
				";
		}
		print "<ul>";
	return ob_get_clean();
}
function get_portfolio_media($slug){
	$attachments = array();
	$attachments['videos'] = array();
	ob_start();
	 $args = array(
      'post_type' => 'video',
      "category_media" => $slug,
      'post_status' => 'publish',
	  'orderby' => 'menu_order',
	  'order' => 'ASC'
    );
	
	$videos = get_posts($args);
	foreach ($videos as $key =>  $value){
		
		extract( (array) $value);
		$post_fields = array();
		$post_fields['ID'] = $ID;
		$post_fields['post_title'] = $post_title;
		$post_fields['post_content'] = $post_content;
		$post_fields['video_url'] = get_post_meta($ID,"video_url",true);
		
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $ID), "thumb");
		$post_fields['src'] = $img[0];
		array_push($attachments['videos'],$post_fields);
	}
	
	
	
	
	 $ids = mcm_get_attachment_ids(array("category"=>"$slug"));
	 //var_dump($ids);
	$attachments['case_studies'] = array();
	$attachments['white_papers'] = array();
	$attachments['brochures'] = array();
	$upload_dir = wp_upload_dir();
	//var_dump($upload_dir);
	$upload_path = $upload_dir['baseurl'];
	foreach(explode(",",$ids) as $key=>$value){ 
		$post_fields = array();
		$this_post = get_post($value,ARRAY_A);
		$post_fields['ID'] = $value;
		$post_fields['post_title'] = $this_post['post_title'];
		$post_fields['post_excerpt'] = $this_post['post_excerpt'];
		$post_fields['post_mime_type'] = $this_post['post_mime_type'];
		$post_fields['url'] = $upload_path . "/". get_post_meta($value,"_wp_attached_file",true);
		
		if(has_term( "case-study", "category_media", $value )){
			array_push($attachments['case_studies'],$post_fields);
			
		} else if (has_term( "white-paper", "category_media", $value )) {
			array_push($attachments['white_papers'],$post_fields);
		} else if (has_term( "brochure", "category_media", $value )) {
			array_push($attachments['brochures'],$post_fields);
		}
		
	
	}
	return $attachments;
}
function display_attachment_list($attachments){
	
	
	ob_start();
		print "<ul>";
		foreach($attachments as $key => $value){
			extract($value);
			if($post_mime_type == 'application/pdf'){
				$class = "pdf";
			}
			$title_clean = str_replace('"','',$post_title);
			
			print "<li class=\"pdf\">
				 	<a class=\"iframe\" href=\"$url\" title=\"$title_clean\">$post_title</a><br>
					<span>$post_excerpt</span>
			</li>";	
			
		}
	
	
		print "</ul>";	
	return ob_get_clean();
	
}
if ( function_exists('register_sidebars') ){
    register_sidebar( array(
        'name' => __( 'portfolios Menu', 'theme-slug' ),
        'id' => 'portfolios-menu',
        'description' => __( '', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}
*/
?>