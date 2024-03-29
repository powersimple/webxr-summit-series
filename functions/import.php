<?php

    function listProjects($var_name,$where){
         global $wpdb;
        $sql="select * from omni_data where $where";
        $q = $wpdb->get_results($sql);
        $counter = 1;
        print "<table>";
        foreach($q as $key => $value){
            extract((array) $value);
            print "<tr>";
            print "<td>$id</td>";
            print "<td><a href=\"?$var_name=$id\">$name</a></td>";

            print "</tr>";

        }

        print "</table>";
        
    }
    function listResource($resource){
         global $wpdb;
        $sql="select * from omni_data where id = $resource";
        $q = $wpdb->get_results($sql);
        $counter = 1;

	$fields = "URL,title,description,keywords,language,logo_url,share_image_url,contact_url,blog_url,twitter,facebook,linkedin,github,tumblr,google_plus,medium,telegram,slack,skype,instagram,youtube,vimeo,pinterest,behance,rss,email,phone,address,address2,city,state,postal_code,country,url_content,wp_post_id";

        print "<table>";
        foreach($q as $key =>  $value){
            $value = (array)$value;
           extract($value);
            foreach(explode(",",$fields) as $f => $field){
            print "<tr>";
            print "<td>$field</td>";
            print "<td>".$value[$field]."</td>";
            print "</tr>";
            }
          

        }

        print "</table>";
        return $value;
    }
    function insertPost($id,$post_title,$post_content){
        $table = "wp_posts";
       
        $new_post = array(
            
            'post_content' => "$post_content",
           
            'post_title' => "$post_title",
            'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'project',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        global $wpdb;
        $sql = "UPDATE `omni_data` SET `wp_post_id` = '$new_post' WHERE `omni_data`.`id` = $id;";
        $wpdb->query($sql);

        return $new_post;
    }
    function insertNewProfile($profile,$fields){
        extract( $profile);
        $table = "wp_posts";
       
        $new_post = array(
            
            'post_content' => "$post_content",
           
            'post_title' => "$post_title",
            //'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'profile',
        );
        $fields = explode(",",$fields);
        $new_post = wp_insert_post( $new_post,$wp_error = false );
//      
        foreach($fields as $k =>$v){
           add_post_meta($new_post,$v,$profile[$v]);
        }


      /*  $new_post = wp_insert_post( $new_post,$wp_error = false );
        global $wpdb;
        $sql = "UPDATE `omni_data` SET `wp_post_id` = '$new_post' WHERE `omni_data`.`id` = $id;";
        $wpdb->query($sql);*/

        return $new_post;
    }
    function insertNewEvent($event,$fields){
        extract( $event);
        $table = "wp_posts";
       
        $new_post = array(
            
            'post_content' => "$post_content",
           
            'post_title' => "$post_title",
            //'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'event',
        );
        $fields = explode(",",$fields);
     
        $new_post = wp_insert_post( $new_post,$wp_error = false );
//      
        foreach($fields as $k =>$v){
         //var_dump()
              add_post_meta($new_post,$v,$event[$v]);
        }

      /*  $new_post = wp_insert_post( $new_post,$wp_error = false );
        global $wpdb;
        $sql = "UPDATE `omni_data` SET `wp_post_id` = '$new_post' WHERE `omni_data`.`id` = $id;";
        $wpdb->query($sql);*/

        return $new_post;
        die();
    }
    function get_profiles_for_import(){
        global $wpdb;
        $sql = "select * from _profiles where id>1";
        $q = $wpdb->get_results($sql);
        foreach($q as $key => $value){
            extract ((array) $value);
           $profile = array("post_title"=>$name,"post_content"=>$bio,"profile_title"=>$title);
           
           $profile = array_merge($profile,(array)$value);
       //    var_dump($profile);
          insertNewProfile($profile,"profile_title,company,linkedin");
        }



    }
    function get_profiles_for_event_import($parent){
        global $wpdb;
        $sql = "select * from _profiles where id=2";
        $q = $wpdb->get_results($sql);
        foreach($q as $key => $value){
            extract ((array) $value);
           $profile = array("post_title"=>$name,"post_content"=>$description,"post_parent"=>$parent);
           
           $event = array_merge($profile,(array)$value);
          // var_dump($profile);
        //   die();
         insertNewEvent($event,"duration");
        }



    }
 //   get_profiles_for_event_import(1317);


?>