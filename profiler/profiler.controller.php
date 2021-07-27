<?php




function taxes(){ /* THIS GETS THE LIST OF TERMS and RETURNS LIST GROUPT BY WHICH TAXONOMY */
  
    global $wpdb;
    $sql = "SELECT t.term_id, t.name, t.slug, tt.taxonomy, tt.description, tt.parent FROM `wp_terms` t, wp_term_taxonomy tt where t.term_id = tt.term_id";
    $q = $wpdb->get_results($sql);
    $tax = array();
    foreach($q as $key=>$value){
        
        $tax[$value->taxonomy][] = array("id"=>$value->term_id,"name"=>$value->name,"desc"=>$value->description,"p"=>$value->parent);
    }
    return $tax;

}
function tax_rel(){ /*GETS THS RELATIONSHIPS FOR THE CURRENT POST */
    global $post;
    global $wpdb;
    $sql = "SELECT t.term_id, t.name, t.slug, tt.taxonomy FROM wp_term_relationships tr, `wp_terms` t, wp_term_taxonomy tt where tr.object_id = $post->ID and tr.term_taxonomy_id = tt.term_taxonomy_id and t.term_id = tt.term_id";
    $q = $wpdb->get_results($sql);
    $tax_rel = array();
    foreach($q as $key=>$value){
        
        $tax_rel[$value->taxonomy][] = array("id"=>$value->term_id,"name"=>$value->name,);
    }
    return $tax_rel;

}
function tax_search($term){ /*GETS THS RELATIONSHIPS FOR THE CURRENT POST */
    global $post;
    global $wpdb;
    $sql = "SELECT t.term_id, t.name, t.slug, tt.taxonomy, tt.description FROM `wp_terms` t, wp_term_taxonomy tt where t.term_id = tt.term_id and (t.name like '%$term%' or tt.description like '%$term%')";
    $q = $wpdb->get_results($sql);
    $tax_rel = array();
    foreach($q as $key=>$value){
        
        $tax_rel[$value->taxonomy][] = array("id"=>$value->term_id,"name"=>$value->name,);
    }
    return $q;

}
function httpify($src){


        if(strpos($src, 'http') !== false){
        
        } else {
            $src = $_GET['scrape'].$src;
        }
        $src = str_replace("://",":|",$src);
        $src = str_replace("//","/",$src);
        $src = str_replace(":|","://",$src);
        
        return $src;
    }



function detectURL($url){
	global $post;
	if(strpos($url,$post->post_title) !==false){
		print "<br><a href='#' onclick=\"setMeta('url','$url');\" class='set-meta'>Set $url as <strong> URL </strong></a>";

	}

    global $field_list;
    
	foreach(explode(",",$field_list) as $key => $field){
		if(strpos($url,$field) !==false){
			print "<br><a href='#' onclick=\"setMeta('$field','$url');\" class='set-meta'>Set $url as <strong>$field</strong></a><br>";

		}
	}

}
function detectMedia($pagemap){
	foreach($pagemap as $key =>$value){
		if($key == 'cse_image'){
			if(@$value[0]->src){
			print "<img src='".$value[0]->src."' class='meta-image-preview'>";

			}
		}
	}
}


function parseSocialLinks($data){
	$links = array();
	foreach($data as $key =>$value){

		
            if (strpos($value['url'], 'twitter.com') !== false && strpos($value['url'], 'share?')  != true) {

//Twitter
                $links['twitter'] = $value['url'];
			} else if(strpos($value['url'], 'facebook.com') !== false //facebook good
			 && strpos($value['url'], 'sharer') != true){ // share url bad
//Facebook
				$links['facebook'] = $value['url'];
				
            } else if(strpos($value['url'], 'instagram.com') !== false){
//Instagram
                $links['instagram'] = $value['url'];
            } else if(strpos($value['url'], 'youtube.com') !== false){
 //YouTube
                $links['youtube'] = $value['url'];
            } else if(strpos($value['url'], 'vimeo.com') !== false){
 //Vimeo
                $links['vimeo'] = $value['url'];
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
                $links['medium'][] = $value['url'];
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
            } else if(strpos($value['url'], 'behance.net') !== false){
//Behance
                $links['behance'] = $value['url'];
			} else if(strpos($value['url'], 'flickr.com') !== false){
//Behance
                $links['flickr'] = $value['url'];
			}
			else if(strpos($value['url'], 'snapchat.com') !== false){
//Behance
                $links['snapchat'] = $value['url'];
			} else if(strpos($value['url'], 'foursquare.com') !== false){
//Behance
                $links['foursquare'] = $value['url'];
			}
			 else if(strpos($value['url'], 'tel:') !== false){
//Phone
                $links['telephone'] = clean(str_replace("tel:","",$value['url']));
            } else if(strpos($value['text'], '@') != false && strpos($value['text'], '.') != false ){
//Email Address
				$links['email'] = $value['text'];
				
            }  else if(strpos($value['url'], 'mailto:') !== false ){
//Email
                $links['email'] = str_replace("mailto:","",$value['url']);
			} else if(strpos($value['url'], 'about') !== false){
			//Behance

				 if(strpos($value['url'], 'http') !== false){
				
				}

							$links['about'] = $value['url'];

            } else {

//other
                @$links['other_links'][]= $value['url']." | ".$value['text']."</em>";

            }
        
		}
	return $links;
}

/*
            if(strpos(strtolower($this_link),"contact") || strpos(strtolower("contact"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['contact_url'] = $this_link;
                
            }

            if(strpos(strtolower($this_link),"blog") || strpos(strtolower("blog"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['blog_url'] = $this_link;
                
            }


            if(strpos(strtolower($this_link),"jobs") || strpos(strtolower("careers"),$this_text) || strpos(strtolower($this_link),"jobs") || strpos(strtolower("careers"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['jobs_url'] = $this_link;
                
            }

            if(strpos(strtolower($this_link),"apply") || strpos(strtolower("apply"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['apply_url'] = $this_link;
                
            }


            if(strpos(strtolower($this_link),"events") || strpos(strtolower("events"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['events_url'] = $this_link;
                
            }


            if(strpos(strtolower($this_link),"conference") || strpos(strtolower("conference"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['conference_url'] = $this_link;
                
            }
             if(strpos(strtolower($this_link),"developers") || strpos(strtolower("developers"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['developers_url'] = $this_link;
                
            }


        }
*/