<?php

    function getProfileContactInfo(){

        global $wpdb;
        $sql = "select * from wp_posts where post_type = 'profile' and post_status = 'publish'";
        $q = $wpdb->get_results($sql);
        $contacts = [];
        foreach($q as $key => $value){
            extract((array) $value);
            $meta = get_post_meta($ID);
           // var_dump($meta);
            array_push($contacts,[
                "title"=>$post_title,
                "id"=>$ID,
                "email"=>@$meta['email'][0],
                "twitter"=>@$meta['twitter'][0],
                "linkedin"=>@$meta['linkedin'][0],
                "instagram"=>@$meta['instagram'][0], "website"=>@$meta['website'][0],
            ]);
                



        }
    
    
        return $contacts;

    }




?>