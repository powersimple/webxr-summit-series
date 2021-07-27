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