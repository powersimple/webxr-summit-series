<?php




function displaySearchResults($search_results){
	
	if(is_array(@$search_results->items)){
		foreach($search_results->items as $key => $result){
		
			print "<li><a href='$result->link' target='_blank'>$result->title</a> ";
			detectURL($result->link);
			if(@$result->pagemap){
				print "<div class='img-options'>";
					detectMedia($result->pagemap);
				print "</div>";
			}	
			print "</li>";
		
		}
	}
}
function metaHandler($key,$value){
	global $post;
	
	//print "$key<BR>";
	if(is_array($value)){

		if ($key == 'link_array'){
			print "<hr><strong>LINKS</strong><br>";
			$links = parseSocialLinks($value);
			foreach($links as $key => $link){
				if(is_array($link)){ // more than one,
					print "<br>$key: $link_value<br>";
					print "<a href=\"#\" onclick=\"setMeta('$key','$link_value');\">Set as $key URL</a><BR>";
					

				} else {
					print "<br>$key: $link<br>";
					print "<a href=\"#\" onclick=\"setMeta('$key','$link');\">Set as $key URL</a><BR>";
				}

			}

			
		} else if ($key == 'image_array'){
			print "<hR>images<BR>";
			
			foreach($value as $imgkey => $img){
				
				print $src = httpify($img['src']);
				
				print "<img src='$src' class='meta-image-preview'><br>$img[alt]<br>";
				
				
				//imgProfileMenu($src,$img['alt']);
				
				print  "<a href='$_SERVER[REQUEST_URI]&addImg=$src'>Add 2 Library</a>";
				print "<BR><BR>";
			
					//print "<br>$key: $link<br>";
					//print "<a href=\"#\" onclick=\"setMeta('$key','$link');\">Set as $key URL</a><BR>";
			}

			
		}
		
		 //var_dump($value);
	} else {	
		$value = trim(str_replace("'","\'",$value));
			$val = urlencode($value);
		if($key == 'title'){
			print "<hr><strong>$key</strong>: $value";
			
			print "<br><a href='#' onclick=\"setMeta('post-title-0','$value');\">Set as Title</a>";
			print " | <a href=\"#\" setMeta('inspector-textarea-control-0','$value')>Set  Excerpt</a><BR><BR>";
		} else if($key == 'description' || $key == 'og:description'){
			print "<hr><strong>$key</strong>: $value";
			print "<br><a href=\"#\" onclick=\"setMeta('post-title-0','$value');\">Set as Content</a>";
			
			print " | <a href=\"$_SERVER[REQUEST_URI]&scrape=$_GET[scrape]&updateExcerpt=$val;\">Set as Excerpt</a><BR><BR>";
		} else if($key == 'twitter:image' || $key == 'og:image'){
			print "<hr><img src='$value' alt='$key' class='meta-image-preview'>";
			
			print  "<BR>$value<BR><a href='$_SERVER[REQUEST_URI]&scrape=$_GET[scrape]&addImg=$value'>Add to Library</a>";
		}else   {
			
		}
	}	

}
function getSearchURL(){
	 global $post;
	


	$start = 10;
	$api_key = "AIzaSyAS1V2NbsBFRQpC_AEuxeAVkSiyeNig6Os";
	$cx = "005354076002282767293:_ejv69cuyvk";
	$url = "https://www.googleapis.com/customsearch/v1?";

	
	
	if(!$search = @$GET['search']){
		 $search=urlencode($post->post_title); //URL ENCODING IT IS NECESSARY
	} 
	$url = $url."key=$api_key&cx=$cx&q=$search";
	return $url;

}
function profilerAction(){
 global $post;
https://console.developers.google.com/billing?project=497446706331
	if(!$search = @$GET['search']){
		$search=$post->post_title;
	} 

		$admin_url = "/wp-admin/post.php?post=$post->ID&action=edit";

	$search_url = getSearchURL();
print "<a href='$admin_url' class='refresh control title='refresh'>&#x21bb;</a> ";//REFRESH
	print "<a href='$admin_url&search=$search' title='$search_url'>🇬 $post->post_title</a> ";
	print "<a href='$search_url' target='_blank' title='Open JSON results in another tab'>JSON</a><br>";

	if($url = @get_post_meta($post->ID,"url",true)){ //can only scrape if url is set.
	



		print "<a href='$admin_url&scrape=$post->post_title&scrape=$url'>Scrape $url</a><BR>";
	}
	if($search_content = @get_post_meta($post->ID,"search_content",true)){ //can only scrape if url is set.
		?>
		<script>
			var search_results = <?=$search_content?>;
		</script>
		<?php

		print "<a href='#' onclick=\"processResults('".$search."',search_results)\">Process Saved Search</a><BR>";
	}

	if($scrape_content = @get_post_meta($post->ID,"scraped_content",true)){ // only if the json has been saved to scraped content.
		
		
?>
		<script>
			var scrape_results = <?=$scrape_content?>;
							var testdata = {
					'action': 'my_action',
					'whatever': 1234
				};


		</script>
		<?php

		print "<a href='#' onclick=\"processScrape()\">Process Saved Scrape</a><BR>";
		
		
	}


}

	function admin_card(){
		global $field_list;
		print $field_list;
		

	}
