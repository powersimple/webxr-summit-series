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
    <a-entity id="label-created" troika-text="value:<?=$agenda['track']->post_title?>;color:#fff; fontSize:.6;align:left;anchor:left;" material="shader: standard;" position="<?=$x?> <?=$y_counter?> <?=$z?>" rotation="0 0 0" scale=".2 .2 .2"></a-entity>
    <?php
    
    foreach($agenda['sessions'] as $k => $a){
        $x_counter = $x_counter+$x_offset;
        $y_counter = $y_counter+$y_offset;
        $x_counter = $z_counter+$z_offset;
        
        extract((array) $a);
        ob_start();
        ?>
    
    <a-entity id="label-created" troika-text="value:<?=$post_title?>;color:#fff; fontSize:.4;align:left;anchor:left;" material="shader: standard;" position="<?=$x_offset?> <?=$y_counter?> <?=$z?>" rotation="0 0 0" scale=".2 .2 .2"></a-entity>
    <?php
    }
    return ob_clean();
}
?>