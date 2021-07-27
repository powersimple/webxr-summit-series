<?php
require_once "scraper.class.php";//DOM PARSER IS HERE.
 
use diversen\meta;
function getMeta($url){
	
	
	$meta_data = array(
		'description'=>'',
		'og:image'=>'',
						
	);

	$m = new meta();


	// With more params
	$meta_tags = $m->getMeta($url);
	//var_dump($meta_tags);
	$meta_data = array(
		'description'=>@$meta_tags['description'],
		'og:image'=>@$meta_tags['og:image'],
						
	);

	if(@$_GET['savecontent']){
		 $update = array(
			'ID'           =>@$_GET['post'],
			'post_excerpt'   => @$meta_data['description'],
			'post_content' => @$meta_data['description'],
		);
		
		wp_update_post( $update );
		@$meta_data['description']  .="SAVED"; 
	}
	if(@$_GET['saveimage']){
		 featuredImageFromURL(@$_GET['post'],@$meta_data['og:image']);
	
	
	}
	//@$meta_data['description']  .="SAVED"; 
	return $meta_tags;

}

function scrapeMetaLink($url=''){
	//$url = '';
	//$url = @get_post_meta(@$_GET['post'],"url",TRUE);
	$thisLink= "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$meta_results = '';
	if(@$_GET['scrape']==1){
		$meta = getMeta($url);
		
		if($meta['description'] != ''){
			
			$meta_results .= $meta['description'];
			
			$meta_results .= '<br><a href="'.$thisLink.'&scrape=1&savecontent=1&url='.$url.'">Save Description as Content</a><br><br>';
		}
		if($meta['og:image']!=''){
			$meta_results .= '<img style="max-width:100%" src="'.$meta['og:image'].'">';
			$meta_results .= '<br><a href="'.$thisLink.'&scrape=1&saveimage=1&url='.$url.'">Save as Featured Image</a><br><br>';
			
			
		}
		
		
	}

	
	$scrape = '<a href="'.$thisLink.'&scrape=1&url='.$url.'">Scrape</a><br>';
	
	$scrape .= '<div id="scrape-results"|'.$meta_results.'|</div>';

	return $scrape;

}

function scrapeLink($url=''){
	//$url = '';
	//$url = @get_post_meta(@$_GET['post'],"url",TRUE);
	$thisLink= "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$meta_results = '';
	if(@$_GET['scrape']==1){
		$meta = getMeta($url);
		return $meta;
		if($meta['description'] != ''){
			
			$meta_results .= $meta['description'];
			
			$meta_results .= '<br><a href="'.$thisLink.'&scrape=1&savecontent=1&url='.$url.'">Save Description as Content</a><br><br>';
		}
		if($meta['og:image']!=''){
			$meta_results .= '<img style="max-width:100%" src="'.$meta['og:image'].'">';
			$meta_results .= '<br><a href="'.$thisLink.'&scrape=1&saveimage=1&url='.$url.'">Save as Featured Image</a><br><br>';
			
			
		}
		
		
	}

	
	$scrape = '<a href="'.$thisLink.'&scrape=1&url='.$url.'">Scrape</a><br>';
	
	$scrape .= '<div id="scrape-results"|'.$meta_results.'|</div>';

	return $meta;

}

function Scraper( $meta_boxes ) {
	$prefix = '';
	$data = '';

	$meta_boxes[] = array(
		'id' => 'scraper',
		'title' => esc_html__( 'Scraper', 'scrape' ),
		'post_types' => array( 'post', 'project' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'url',
				'type' => 'url',
				'name' => esc_html__( 'URL', 'scrape' ),
				'desc' =>scrapeMetaLink(@get_post_meta(@$_GET['post'],"url",TRUE)),
				'placeholder' => esc_html__( 'Enter URL', 'scrape' ),
				'size' => 30,
			),
		),
	);
	
	return $meta_boxes;
}


function parseLinks($data){
	$links = array();
	foreach($data as $key =>$value){
            if (strpos($value['url'], 'twitter.com') !== false && strpos($value['url'], 'share?')  != true) {

//Twitter
                $links['twitter'] = $value['url'];//basename($value['url']);
			} else if(strpos($value['url'], 'facebook.com') !== false //facebook good
			 && strpos($value['url'], 'sharer') != true){ // share url bad
//Facebook
				$links['facebook'] = $value['url'];
				
            } else if(strpos($value['url'], 'instagram.com') !== false){
//Instagram
                $links['instagram'] = basename($value['url']);
            } else if(strpos($value['url'], 'youtube.com') !== false){
 //YouTube
                $links['youtube'] = $value['url'];
            } else if(strpos($value['url'], 'vimeo.com') !== false){
 //Vimeo
                $links['vimeo'] = basename($value['url']);
			} else if(strpos($value['url'], 'linkedin.com') !== false  //linked in good
				&& strpos($value['url'], 'shareArticle') != true){// share url bad
//LinkedIn
                $links['linkedin'] = $value['url'];
            } else if(strpos($value['url'], '.xml') !== false){
//RSS               
				if(!strpos($value['url'],"http:")){ 
				$links['rss'] = $_GET['url'] . "/". basename($value['url']);
				} else {
					$links['rss'] = $value['url'];
				}
            } else if(strpos($value['url'], 'tumblr.com') !== false){
//Tumblr
                $links['tumblr'] = $value['url'];
            } else if(strpos($value['url'], 'plus.google') !== false  && strpos($value['url'], 'share?')  != true){
//Tumblr
                $links['google_plus'] = $value['url'];
            }  else if(strpos($value['url'], 'medium.com') !== false){
//Medium
                $links['medium'] = $value['url'];
            } else if(strpos($value['url'], 't.me') !== false){
//Telegram
                $links['telegram'] = $value['url'];
            } else if(strpos($value['url'], 'pinterest.com') !== false){
//Pinterest
                $links['pinterest'] = $value['url'];
            } else if(strpos($value['url'], 'github.com') !== false){
//Github
                $links['github'] = $value['url'];

            } else if(strpos($value['url'], 'slack') !== false){
//Slack
                $links['slack'] = $value['url'];
            } else if(strpos($value['url'], 'skype.com') !== false){
//Skype
				$links['skype'] = $value['url'];
				} else if(strpos($value['url'], 'dribbble.com') !== false){
//Skype
                $links['dribbble'] = $value['url'];
            } else if(strpos($value['url'], 'behance.net') !== false){
//Behance
                $links['behance'] = $value['url'];
			} else if(strpos($value['url'], 'flickr.com') !== false){
//Behance
                $links['flickr'] = $value['url'];
			} else if(strpos($value['url'], 'tel:') !== false){
//Phone
                $links['telephone'] = clean(str_replace("tel:","",$value['url']));
            } else if(strpos($value['text'], '@') != false && strpos($value['text'], '.') != false ){
//Email Address
                $links['email'] = $value['text'];
            }  else if(strpos($value['url'], 'mailto:') !== false ){
//Email
                $links['email'] = str_replace("mailto:","",$value['url']);


            } else {

//other
                @$links['other_links'].="<Br><em>".$value['url']." | ".$value['text']."</em>";

            }
        
		}
	return $links;
}

add_filter( 'rwmb_meta_boxes', 'Scraper' );
function cleanURL($url) {
   return $url;
}  
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function getLinkArray($sql){
	global $wpdb;
	 $sql = "select * from omni_data where $sql";
	$q = $wpdb->get_results($sql);
	$links = array();	
	foreach($q as $key => $value){
		array_push($links,(array)$value);
	//	var_dump($links); die();
	}
	return $links;

}

?>