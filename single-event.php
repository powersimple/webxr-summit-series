<?php

get_header(); 
$default_video_url = get_post_meta($post->ID,"embed_video_url",true);
$session_type = get_post_meta($post->ID,"session_type",true);

$honorees = get_post_meta($post->ID,"event_honoree");    
$moderator = get_post_meta($post->ID,"event_moderator");    
$guests = get_post_meta($post->ID,"event_guest");    

$profiles = array_merge($honorees,$moderator,$guests);


if($hero=get_post_meta($post->ID,'hero',true)){
   $hero_image = getThumbnail($hero);
   /*
if($post->post_parent==0){

    print "<div id='section-heading'>";
    $parent_post = get_post($post->post_parent);
    $parent_post_title = $parent_post->post_title;
    echo $parent_post_title;
    print "</div>";
}
*/
?>

<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=$hero_image?>) center center no-repeat">
    
    </section>

<?php
}

?>






<main class="main" role="main">
<div class="title-bar">
    <h1 class="title"><?=$post->post_title?></h1>
    <?php
    if(@$post->post_excerpt){
      
    ?>
    <h2 class="featuring">
        <?=$post->post_excerpt?></h1>
    
    <?php
    }
 
    ?>
</div>
    <div class="row">
    <div class="event-content order-sm-12 col-sm-7 col-md-8 col-lg-9 col-xl-10">
     


     <div class="row">
     <div class="col-md-12  col-xl-8 col-xxl-7">
             <div class="video-wrap"> 
             <?php
           
             ?>
             <iframe id="session-video" src="<?=$default_video_url?>"></iframe>
             </div>
         </div>
         <div class="order-xs-1 col-sm-12  col-xl-4 col-xxl-5" >
         <?=do_blocks($post->post_content)?>


         <?=displayProfiles($profiles,$post->ID,"event_guest",$session_type);?>


         </div>
        
     
     </div>
 </div>

        <div class="event-list order-sm-1 col-sm-5 col-md-4 col-lg-3 col-xl-2">
<?php

if($post->post_parent == 0){
    $event_id = $post->ID;
} else {
    $event_id = get_post($post->ID)->post_parent;
    if(get_post($event_id)->post_parent != 0){
      //  $event_id = get_post($post->ID)->post_parent;
    }

}

$utc_start =  get_post_meta($event_id,"utc_start",true); 
$tense = null;
if(is_date($utc_start)){
   print $now = date("Y-m-d");
    print $then = date("Y-m-d", $utc_start);
    if($now > $then){
print         $tense = "past";
    } else {
       print $tense = "future";
    }
}


$events = getChildList($event_id,$post_type,$sort='menu_order');



 if(count($events)){
    print "<ul>". $tense;
    foreach($events as $key => $event){
        extract($event);
        $embed_video_url = '';
        
        extract( $event_meta = getEventMeta($event));
        $link = get_permalink($ID);
        $children = getChildList($event['ID'],$post_type,$sort='menu_order');
        //if($utc_start)
       
        print "<li>";
      
        print "<a href='$link'>";

        if($embed_video_url == ''){
    //        print "<a href='$link'>";
        } else {

            //        print "<a href='#' onclick=\"document.getElementById('session-video').setAttribute('src','$embed_video_url')\">";
        }
            print $post_title;
          

            print "</a>";
          
       
       
        foreach($children as $c =>$child) {
            
            $embed_video_url = '';
            $link = get_permalink($child['ID']);
            extract( $event_meta = getEventMeta($child));
        
            print "<ul><li>$tense";
            print "<a href='$link'>"; 
        if($embed_video_url == ''){
            print "<a href='$link'>";

        } else {
      //      print "<a href='#' onclick=\"setVideo('$embed_video_url');>";
        }

            print $child['post_title'];
            
       

            print "</a>";
            print "</li>
            </ul>";
            }
//       if(count($children)){  }

        print "</li>";
       

   
   
    } print "</ul>";
} else {

}
    ?>
    </div>
</div>    
  </main>
  <?php get_footer(); ?>