<?php
     wp_head(); 

     global $wpdb;
     $q = $wpdb->get_results("select * from _metatraversal where id>5");
     foreach($q as $key =>$value){
        extract((array)$value);
        $event = [
            "post_title"=>$title,
            "post_content"=>"",
            "embed_video_url"=>"$embed_video_url",
            "video_url"=>"$video_url"
            
        ];
      //  insertNewEvent($event,"embed_video_url,video_url");
        print "$title<BR>";
     }
    




?>