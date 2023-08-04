<?php
function get_ros_data($ros_data,$children){

    foreach($children as $c =>$child){
        if($child['post']->post_type == 'profile'){
            print("<pre>".print_r($ros_data,true)."</pre>");
           
        }

    }

    return $ros_data;

}


?>