<?php
function getAgenda($track_id){
    global $wpdb;
    $track = $wpdb->get_row("select post_title, post_content, post_name from wp_posts where ID = $track_id");

    $sessions = getChildList($track_id,'event'); 

    $session_array = [];
    $session_array['track'] = $track;
    $session_array['sessions'] = [];
    
    
    
    foreach($sessions as $key =>$session){
        array_push($session_array['sessions'],$session); 
    }
    return $session_array;


}

function displayAgendaList($agenda,$x,$y_offset,$z){
    $x_offset=$x;
    $z_offset=0;
    
    $start_x= 0;
    $x_counter = $start_x;

    $start_y= -.2;
    $y_counter = $start_y;
    
    $start_z= 0;
    $z_counter = $start_z;
   
    ?>
    <a-entity id="agenda-track" troika-text="value:<?=$agenda['track']->post_title?>;color:#fff; fontSize:.6;align:left;anchor:left;" material="shader: standard;" position="<?=$x?> <?=$y_counter?> <?=$z?>" rotation="0 0 0" scale=".2 .2 .2"></a-entity>
    <?php
    
    foreach($agenda['sessions'] as $k => $a){
        $x_counter = $x_counter+$x_offset;
        $y_counter = $y_counter+$y_offset;
        $x_counter = $z_counter+$z_offset;
        
        extract((array) $a);
       
        ?>
    
    <a-entity id="agenda-item" troika-text="value:<?=$post_title?>;color:#fff; fontSize:.4;align:left;anchor:left;" material="shader: standard;" position="<?=$x_offset?> <?=$y_counter?> <?=$z?>" rotation="0 0 0" scale=".2 .2 .2"></a-entity>
    <?php
    }
   
}

function displayTextSeries($label_array,$coords){
// this function renders in a series of text label with offsets
    extract($coords);



    
    
    print "<a-entity id='series' troika-text='value:;color:#fff; fontSize:1;align:left;anchor:center;' material='shader: standard;' position='$pos_x $pos_y $pos_z' rotation='$rot_x $rot_y $rot_z' scale='$scale $scale $scale'>";
    ?>
    
    <?php
    
    foreach($label_array as $k => $a){
     /*   $x_counter = $x_counter+$x_offset;
        $y_counter = $y_counter+$y_offset;
        $x_counter = $z_counter+$z_offset;*/
        
        extract((array) $a);
        ob_start();
     print "<a-entity id='series$k' troika-text='value:$a;color:#fff; fontSize:1;align:left;anchor:center;outlineWidth:0.05;baseline:bottom;' material='shader: standard;' position='$start_x $start_y $start_z' rotation='0 0 0' scale='1 1 1'></a-entity>";
     $start_x = $start_x+$offset_x;
     $start_y = $start_y+$offset_y;
     $start_z = $start_z+$offset_z;


    }

    print "</a-entity>";

    return ob_clean();


}





function displayModelSeries($model_series,$coords){
    // this function renders in a series of models label with offsets
        extract($coords);
    
      //  ob_start();
      
      
      $start_x= 0;
      $x_counter = $start_x;
  
      $start_y= -.2;
      $y_counter = $start_y;
      
      $start_z= 0;
      $z_counter = $start_z;
    
       
      print "<a-entity id='model_series' position='$pos_x $pos_y $pos_z' rotation='$rot_x $rot_y $rot_z' scale='$scale $scale $scale'>";
        
        print "<a-light id='series-spot1' type='spot' color='#fff'  intensity='10' distance='200'
        position='-37 1.5 66' angle='60' rotation='0 0 0'>
        </a-light>";
        print "<a-light id='series-spot2' type='spot' color='#365bba'  intensity='30' distance='600'
        position='-141 -1 72' angle='90' rotation='0 -45 0'>
        </a-light>";
        print "<a-light id='series-spot3' type='spot' color='#365bba'  intensity='10' distance='200'
        position='45 1 60' angle='45' rotation='0 45 0'>
        </a-light>";
        ?>
        
        <?php
        
        foreach($model_series as $k => $m){
           $x_counter = $x_counter+$offset_x;
            $y_counter = $y_counter+$offset_y;
            $x_counter = $z_counter+$offset_z;
            
            extract((array) $m);
            ob_start();
        print "<a-entity id='$k-wrap' class='center-obj-zone' static-body position='$start_x $start_y $start_z' rotation='0 45 0' 
             </a-entity>";
            if($m['model'] != ''){
         print "
         
         <a-entity id='$k-model' class='model-series' static-body position='$model_offset[x] $model_offset[y] $model_offset[z]'
            rotation='90 0 0' gltf-model='#$k' scale='$model_scale[x] $model_scale[y] $model_scale[z]' visible='true'></a-entity>
            ";
            print "<a-light id='$k-light' type='spot' color='#fff'  intensity='1' distance='10'
        position='-5 1 7' angle='45' rotation='0 0 0'>
        </a-light>";
        }

         print "<a-entity id='series-$k' troika-text='value:$text;color:#fff; fontSize:.5;align:center;anchor:center;outlineWidth:0.05;baseline:top;' material='shader: standard;' position='$text_offset[x] $text_offset[y] $text_offset[z]' rotation='0 0 0' scale='1 1 1'></a-entity>
         
         ";
         $start_x = $start_x+$offset_x;
         $start_y = $start_y+$offset_y;
         $start_z = $start_z+$offset_z;
         print "
         </a-entity><!--$k-wrap-->
         ";

        }
   
       
print "</a-entity><!--model-series-->
";
      
      ?>
        <!-- test -->
      <?php
    //    return ob_clean();
    
    
    }


    function get_camera(){
        $cam_x = 0;
        $cam_y = 1.6;
        $cam_z = 0;
        
        if(@$_GET['camera']){
          $cam_coords =  explode("~",$_GET['camera']);
          if(count($cam_coords) == 3){
            $cam_x = $cam_coords[0];
            $cam_y = $cam_coords[1];
            $cam_z = $cam_coords[2];
          }
        }
        return [$cam_x,$cam_y,$cam_z];
        
    }



?>