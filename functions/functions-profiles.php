<?php

    function displayProfiles($profile_array,$event,$profile_context,$session_type){

        $profiles_count = count($profile_array);
        if($profile_context == 'about'){
            $cols = ['col-sm-4'];
        } else {
            if($profiles_count == 2){
                $cols = ['col-sm-12','col-md-6'];
            } else if($profiles_count == 3){
                $cols = ['col-sm-12','col-md-4'];

            } else if($profiles_count == 4){
                $cols = ['col-sm-6','col-md-3','col-xl-6'];
            } else{
                $cols = ['col-sm-6','col-md-3','col-lg-3','col-xl-2'];
            }
        }
        $grid= implode(" ",@$cols);

        print "<div class='row'>";


        foreach($profile_array as $key => $profile_id){
            
            ?>
            
            <div class="profile <?=$grid?>"><?=displayProfile($profile_id,$profile_context);?></div>
            
            <?php
        
        }
        print "</div>";
        return ob_get_clean();
    }
    function displayProfile($profile_id,$profile_context){
        $profile_post = get_post($profile_id);
        $profile_meta = get_post_meta($profile_id);
     
        $profile_name = $profile_post->post_title;
        $profile_about = $profile_post->post_content;
        $profile_excerpt = $profile_post->post_excerpt;

        ob_start();
        $thumbnail = getThumbnail(get_post_meta($profile_id,"_thumbnail_id",true),"medium");   
        ?>
        <div class="speaker-thumbnail">
        <?php
        if($thumbnail != ''){
            print "<img src='$thumbnail' alt='$profile_name' title='$profile_name'>";
        }
        ?>

        </div>
        <h4><?=$profile_post->post_title?></h4>
        <div class="speaker-meta">
        <?= wrapMeta($profile_meta,'profile_title','h5');?>
        <?= wrapMeta($profile_meta,'company','h5');?>
        <?= wrapMeta($profile_meta,'twitter','a');?>
        <?= wrapMeta($profile_meta,'linkedin','a');?>
        <?= wrapMeta($profile_meta,'github','a');?>
        <?= wrapMeta($profile_meta,'website','a');?>
        <?php 
        if($profile_context == 'about'){?>
        <p class="profile-excerpt"><?=nl2br($profile_excerpt)?></p>
        <?php } ?>
        </div>

<?php

return ob_get_clean();


    }

    function wrapMeta($array,$var,$tag,$target="_blank"){
        if(@$array[$var]){
        
          
            $value = $array[$var][0];
            if($tag == 'a'){
                return wrapLink($var,$value,$target);
            } else {
                return "<$tag>".$value."</$tag>";
            }
        }
    }
    function wrapLink($var,$link,$target){
        $use_font_awesome = false;
        if($var == 'twitter'
        || $var == 'linkedin'
        || $var == 'github'
        || $var == 'website'){
            $use_font_awesome = true;

        }    
        if($use_font_awesome == true){
            $label = "<i class='fa fa-$var social-icon'></i>";
        } else {
            $label = '$var';
        }
        
        return "<a href='$link' target='$target'>$label</a>";
    }
    function getProfileChildrenIDs($id){
        global $wpdb;
        $q = $wpdb->get_results("select ID from wp_posts where post_status = 'publish' and post_type='profile' and post_parent = $id order by menu_order");
        $profile_children = array();
        foreach($q as $key=>$value){
            array_push($profile_children,$value->ID);
        }
        return $profile_children;
    }

?>