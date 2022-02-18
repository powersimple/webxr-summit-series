<?php
function insertEvent($post_title,$post_content,$post_excerpt,$post_parent){
        $table = "wp_posts";
       
        $new_post = array(
            
           
            'post_parent' => "$post_parent",
            'post_title' => "$post_title",
            'post_content' => "$post_content",
            'post_excerpt' => "$post_excerpt",
            
            'post_status' => 'publish',
            'post_type' => 'event',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        global $wpdb;
     
       // $wpdb->query($sql);

        return $new_post;
    }
    function insertProfile($post_title,$post_content,$parent){
        $table = "wp_posts";
       
        $new_post = array(
            
            'post_content' => "$post_content",
          
            'post_title' => "$post_title",
            'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'profile',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        
       // $wpdb->query($sql);

        return $new_post;
    }

    function get_eventsFromTable($parent){
        global $wpdb;
        $q= $wpdb->get_results("select * from _events where parent = parent limit 0,20");
    //   var_dump($q);
        foreach($q as $key=>$value){
            extract((array) $value);
            print "$value->name<br>";
       $i = insertEvent($value->name,$value->content,$value->content,$parent);

      
        }
    }

    function get_profilesFromTable($parent){
        global $wpdb;
        $q= $wpdb->get_results("select * from _profiles limit 4,30");
        $meta_fields = "email,title,company,twitter,website,twitter,github,discord,blurb,resources";
        foreach($q as $key=>$value){
            extract((array) $value);
            print "$value->name<br>";
     //  $i = insertProfile($name,$bio,$parent);

            foreach(explode(",",$meta_fields) as $k => $f){
             print $value->$f;
                  add_post_meta($i,$f,$value->$f);
            }

        }
    }

    function insertResource($post_title){
        $table = "wp_posts";
       
        $new_post = array(
            
  //          'post_content' => "$post_content",
          
            'post_title' => "$post_title",
//            'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'resource',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        
       // $wpdb->query($sql);

        return $new_post;
    }
    
    function get_resourcesFromTable(){
        global $wpdb;
        $q= $wpdb->get_results("select * from _resources");
      
        foreach($q as $key=>$value){
            extract((array) $value);
            print "$value->name<br>";
           $i = insertResource($name);
        }
           
    }





    function getChildList($parent,$post_type,$sort='menu_order'){
        global $wpdb;
        $q= $wpdb->get_results("select ID, post_title, post_name, post_content, post_excerpt from wp_posts where post_status='publish' and post_parent = '$parent' and post_type='$post_type' order by $sort");
        $children=[];
        foreach($q as $key=>$value){
            extract((array) $value);
            //print "$value->ID | $value->post_title<br>";
     //  $i = insertProfile($name,$bio,$parent);
         array_push($children,(array) $value);

    
        }
        return $children;
    }

    function getEventMeta($event){

        $event_meta = [];
        $event_meta['utc_start'] = get_post_meta($event['ID'],"utc_start",true);
        $event_meta['embed_video_url'] = get_post_meta($event['ID'],"embed_video_url",true);
        
        return $event_meta;
    }
    function getEventID($id){
        global $wpdb;
        $parent = $wpdb->get_row("select ID, post_parent from wp_posts where ID = $id");
    
        if($parent->post_parent == 0){
            return $parent->ID;
        } else {
        
           getEventID($parent->post_parent);
        }
    }
    function wrapSocial($service,$url){
        $mail="";
        if($service=="email"){
            $mail="mailto:";
            if($url = ''){
                return "Confirme, Registration pending.";
            }
        }
        if($url != ''){
        $link = " <a target='_new' href='".$mail."".$url."'>";
        
        switch ($service){
            case "twitter":  
                $link.="Twitter";
                break;
                case "linkedin":  
                    $link.="LinkedIn";
                    break;
                case "github":  
                    $link.="GitHub";
                    break;
                case "website":
                    $link.=$url;
                    break;
                case "email":
                    $link.=$url;
                    break;
        
                    
    
        }
        $link .= "</a> |";
        return $link;
        }
    }
    function showEmails(){
        global $wpdb;
        $sql="select m.meta_value as email, p.ID, p.post_title as name from wp_posts p, wp_postmeta m where p.ID = m.post_id and meta_key = 'email' and p.post_status = 'publish' order by post_title";
        $q=$wpdb->get_results($sql);
        foreach($q as $key=>$value){
            print "$value->name | $value->email<br>";
        }
    }


  function personalizeScript($script,$session,$name,$green_room_url,$start_time,$end_time,$green_room_time,$moderation="",$with=""){
    $script = str_replace('[SESSION]','"'.$session.'"',$script);
    $name = explode(" ",$name);
    $script = str_replace('[NAME]',$name[0],$script);
    $script = str_replace('[START_TIME]',date("H:i",$start_time),$script);
    $script = str_replace('[END_TIME]',date("H:i",$end_time),$script);
    
    $script = str_replace('[GREEN_ROOM_URL]',$green_room_url,$script);
    $script = str_replace('[GREEN_ROOM_TIME]',date("H:i",$green_room_time),$script);
    $script = str_replace('[MODERATION]',$moderation,$script);
    $script = str_replace('[WITH]',$with,$script);
    
    
    

    return $script;

}

function get_pedestals($menu){
    $awards = get_menu_array($menu);
      $pedestals = [];
      
     foreach($awards as $key =>$award){
    

        if($award['coords'] !=''){
          array_push($pedestals,[
              
              
              "title"=>@$award['title'],
              "content"=>@$award['content'],
              "slug"=>@str_replace("2021-","",$award['slug']),
              "classes"=>$award['classes'],
              "coords"=>$award['coords'],              
              "nominees" => $award['children'],
              "meta" => $award['meta']
              
          ]);
        }
      }// var_dump($pedestals); die();
      return $pedestals;
  }

  
function get_nominations($menu){
    $awards = get_menu_array($menu);
      $pedestals = [];
     
     foreach($awards as $key =>$award){
         if($award['classes'] != null){
        $class_array = $award['classes'];
         


                array_push($pedestals,[
                    
                    "id"=>@$award['ID'],
                    "title"=>@$award['title'],
                    "content"=>@$award['content'],
                    "slug"=>@str_replace("2021-","",$award['slug']),
                    "classes"=>$award['classes'],
                    "coords"=>$award['coords'],
                    "duration"=>$award['duration'],
                    
                    "nominees" => $award['children'],
                    "meta" => $award['meta']
                    
                ]);
          
        }
      }// var_dump($pedestals); die();
      return $pedestals;
  }

  function getIcalDate($time, $inclTime = true)
{
    return date('Ymd' . ($inclTime ? '\THis' : ''), $time);
}
function getGLB($id){
	if(strpos(get_post($id)->guid,"/wp-content")){
	  return '/wp-content'.explode('/wp-content',get_post($id)->guid)[1];
	}
	
  }

  
function getNomineeImage($thumbnail_id,$class){
    $src = getThumbnail($thumbnail_id);
    

}
function getMetaLink($data,$field,$wrap='span'){
    $prefix ='';
    $link = '';
    $label = '';
    $value = trim(@$data[$field][0]);
   
    if($value){

        if($field == 'email'){
          
            $link = "mailto:$value";
            $label = $value;
        } else if($field == 'twitter'){
            $link = $value;
            $label = str_replace("https://twitter.com/","@",$value);
        }else if($field == 'linkedin'){
            $link = $value;
            $label = str_replace("	https://www.linkedin.com/in/","/",$value);
        }
        
        else {
            $link = $value;
            $label = $value;
        }



        print "<$wrap class='meta'><a href='$link'>$label</a></$wrap>";
    } else {

     //   print " <span class='alert'>no $field</span>";
    }

}
function getPostMeta($meta_key){
    global $wpdb;
    $q= $wpdb->get_results("select distinct meta_value, post_id from wp_postmeta where meta_key = '$meta_key'");
    $children=[];

    foreach($q as $key=>$value){
        extract((array) $value);
        //print "$value->ID | $value->post_title<br>";
 //  $i = insertProfile($name,$bio,$parent);
     array_push($children,(array) $value);


    }
    return $children;
}