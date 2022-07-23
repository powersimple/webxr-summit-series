<?php
    function getCreditsArray($credits_menu){
        $credits = [];
        foreach($credits_menu as $key => $credit){


            array_push($credits,getCreditItem($credit));
          
        }

     //   var_dump($credits);
        return $credits;
    }
    function getCreditItem($credit){
        extract($credit);
        //print @$attr;
        
       // print $title;
        
       // print "<BR>";
      //  var_dump($credit);

        $credit = [
            
            
            'title'=>$title,
            'slug'=>$slug,
            'attr'=>@$attr,
            'classes'=>@$classes,
            
            'logo'=>@$meta['logo'],
            'logo3D'=>@$meta['logo_3D'],
            'logo3D_src'=>getGLB(@$meta['logo3D']),
            
           'children'=>[],
            
        ];
      
        if(count($children)){
            foreach($children as $key =>$child){
                array_push($credit['children'],getCreditItem($child));
                
            }
        }
        return $credit;

      

    }

  

    function menu3DAssets($var,$menu){
        $assets = [];
       
       
        foreach($menu as $key => $menu_item){
            if(@$menu_item[$var]){
          
                array_push($assets,
                               ['slug'=>@$menu_item['slug'],
                               'asset'=>@$menu_item[$var]]); 
               } 
               $child_array = [];
               if(@$menu_item['children']){
                    $child_array = get3DAssets($var,$menu_item['children']); 
                    foreach($child_array as $key =>$value){
                        array_push($assets,['slug'=>$value['slug'],'asset'=>$value['asset']]);
                    }
                }

        //    array_push($assets,get3DAssets($var,$menu_item));
            //  var_dump($menu_item);
          
        }
        //var_dump($assets);
        return $assets;


    }

    function get3DAssets($var,$array){
        $assets = [];
       
        foreach($array as $key => $item){

            if(@$item[$var]){
                array_push($assets,
                        ['slug'=>@$item['slug'],
                        'asset'=>@$item[$var]]);        
            }
            $child_array = [];
            if(@$item['children']){
                 $child_array = get3DAssets($var,$item['children']); 
                 foreach($child_array as $key =>$value){
                     array_push($assets,['slug'=>$value['slug'],'asset'=>$value['asset']]);
                 }
             }
            

        }
        return $assets;


    }




/*
    function getCoords($coords,$counter=0){
    
    
    
        //defaults
        $coordinates = [
                   "position"=>["x"=>0,"y"=>0,"z"=>0],
                   "rotation"=>["x"=>0,"y"=>0,"z"=>0],
                   "scale"=>["x"=>1,"y"=>1,"z"=>1]
                   ];
   
                   //$classes is already an array
     
      if(is_array($coords)){
       foreach($coords as $key => $class){
           
           $coordinates = setCoord($coordinates,$class);
         
        }
       }
        $position =  $coordinates['position']['x']." ".$coordinates['position']['y']." ".$coordinates['position']['z'];
        $rotation =  $coordinates['rotation']['x'] ." ". $coordinates['rotation']['y'] ." ". $coordinates['rotation']['z'];
        $scale =  $coordinates['scale']['x'] ." ". $coordinates['scale']['y'] ." ". $coordinates['scale']['z'];
   
   
   
   
        return " position='$position' rotation='$rotation' scale='$scale'";
   
   
   
   
    }


    function setCoord($coords,$class){
       $class = explode("_",$class);//single class parsed with _
     
       switch($class[0]){//sets coord
           case "px":
               $coords['position']['x'] = $class[1];
               break;
           case "py":
               $coords['position']['y'] = $class[1];
               break;
           case "pz":
               $coords['position']['z'] = $class[1];
               break;
            case "rx":
               $coords['rotation']['x'] = $class[1];
               break;
           case "ry":
               $coords['rotation']['y'] = $class[1];
               break;
           case "rz":
               $coords['rotation']['z'] = $class[1];
               break;
           case "sx":
               $coords['scale']['x'] = $class[1];
               break;
           case "sy":
               $coords['scale']['y'] = $class[1];
               break;
           case "sz":
               $coords['scale']['z'] = $class[1];
               break;
   
           }
       return $coords;
    }
    
   function setCardCoords($count){
       $coords = [];
       if($count){
          // print $count."SHOWCOUNT";
           if($count == 4){
               $offset = 1.25;
           } else if($count == 4){
               $offset = 2;
            } else {
               $offset = 3;
           }
   
           $x=(0-(($count/2)*2));
               for($i=0;$i<$count;$i++){
                   $coords[$i] = $x;
                $x=$x+3;   
               }
   
           
           
   
       }
       return $coords;
   
   }
   */
   function getCredit($credit,$z_offset){
    extract($credit);
    
    ?>
     <a-entity id="<?=$slug?>-wrap" visible="true" scale="2 2 2" 
position="0 0 -<?=$z_offset?>"
        rotation="0 0 0"
        scale="2 2 2" 
        >
    
        <a-entity troika-text='value:<?=$attr?>; color:#f5f5f5; align:center; color:#fff; fontSize:.5;align:center;maxWidth:10; strokeColor:#000;strokeWidth:.008'
        font="/wp-content/themes/metatraversal/font/Goldman-Regular.ttf"

            material="shader: standard; metalness: 0.8;" position="0 1 0" rotation="0 0 0">
        </a-entity>

        <?php if(@$logo3D_src){
            ?>
<a-entity id="<?=$slug?>-model" class="clickable center-obj-zone" static-body 
    position="0 0 0" mixin="obj" rotation="0 0 0" scale="75 75 75" gltf-model="#<?=$slug?>-logo3D"></a-entity>
            <?php
        } else {
        ?>

        <a-entity troika-text='value:<?=$title?>; color:#f5f5f5; align:center; color:#fff; fontSize:.08;align:center;maxWidth:0.8'
            material="shader: standard; metalness: 0.8;" position="0 0 0" rotation="0 0 0">
        </a-entity>

        <?php
        }
        ?>
    </a-entity>
        <?php
}


?>