<?php 

if(!@$show_player){
    $show_player = true;
}
if($show_player==true){
    $visibility = 'visible';
} else {
    $visibility = 'hidden';
}

if($default_video_url == ''){
    $default_video_url = $default_embed_video_url;
}

?>
<div class="video-position" style="visibility:<?=$visibility?>">
    <div class="video-wrap">
        <div id="video-wrap-header"></div>
        <div class="video-wrap">
            <iframe id="video-player" src="<?=$default_video_url?>"  frameborder="0" allowfullscreen></iframe>
                
        </div> 

            <div id="video-wrap-footer"></div>
            
        
    </div><div id="appearances"></div>
        <?php

        if(@$video_playlist){
            $menu = get_menu_array($video_playlist);
        
            print "<div class='video-playlist'>
            <ul>";
           
            foreach($menu as $key=>$session){
                extract((array)$session);
              
                print '<li class="video-listing">';
                
                if(@$meta['_thumbnail_id'][0]){
                    $src = getThumbnail($meta['_thumbnail_id'][0],"mediumLarge");
                    print "<div class='video-thumbnail'>";
                    print "<a href='/$slug' title='$title'>";
                    print "<img src='$src'>";
                    print "</a></div>";

                }
                print "<a class='video-link' href='/$slug' title='$title'>$title</a><br>";
                //   
             
               
                print "</a>";
               
            }

            print "</ul>
            </div>";
        }
        ?>
    
</div>
<script>

function changeVideo(title,url){
    document.getElementById('video-player').src = url;
}
</script>