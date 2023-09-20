<?php
    function publishEvent($menu_array){
        

    }
    function publishThis($slug,$data,$path=''){
        
        $json = json_encode($data,true);
        $server_path = get_template_directory()."/data/".$path;
        writeJSON($server_path."$slug.json",$json);

    
    }
    function publishProfiles($slug,$data){
   
        foreach($data['profile_sort'] as $key => $value){
           if($value['id'] == 54){
         //      print_r($value['events']);
           }
           publishThis('profile-'.$value['id'],$value,'profiles/');
           
        }

    
    }
    
    


?>