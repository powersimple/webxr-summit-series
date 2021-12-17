<?php


function getAwardsMenu($awards_menu){
    

    $awards = [];
   
    foreach($awards_menu as $key =>$award){
       
       
        
        array_push($awards,$this_award);

    }

    return $awards;


}


// located in functions-navigation.php

$menu = get_menu_array('polys2');
$awards = getAwardsMenu($menu);
var_dump($awards);




?>