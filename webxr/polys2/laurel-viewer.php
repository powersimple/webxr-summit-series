<?php
    function get_experiences($menu){
        $awards = get_menu_array($menu);
          $pedestals = [];
          
         foreach($awards as $key =>$award){
        


              array_push($pedestals,[
                  "title"=>@$award['title'],
                  "content"=>@$award['content'],
                  
                  "slug"=>@str_replace("2021-","",$award['slug']),
                  "classes"=>$award['classes'],
                  "coords"=>$award['coords'],
                  
                  "nominees" => $award['children'],
                  "meta" => $award['meta']
                  
              ]);
              
          }
          return $pedestals;
      }
     
    $experiences = get_experiences('experiences');
     //var_dump($experiences); die();
?>
    <style>
    
      #laurel-viewer a:visited{
          color:#999;
      }

    </style>
<div class="sidedrawer vh"> 

    <div id="menuclose"></div>
    
         <div id="laurel-viewer">
            
<?php
$dir    = '/Users/benerwin/Clients/WebXR/SummitSeries/dev/assets/models/laurels/unminted/';
$files1 = scandir($dir);


foreach($files1 as $key =>$value){
    $laurel_file=str_replace(".glb","",$value);
    print "<a href='?disappear=1&laurel=$laurel_file'>.$laurel_file</a><BR>";
}


?>

         </div>

    </div>
    </div>

