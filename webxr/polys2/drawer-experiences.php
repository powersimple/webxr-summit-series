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
<div class="sidedrawer vh"> 

    <div id="menuclose"></div>
    
    <div id="nominations">
    <span class="experiences-header webxrawards">Nominees and Winners</span>
        <?php
            
            $awards = get_nominations('polys2');
            nomineeAccordion($awards);
   

   
          
      ?>
      
    </div>





            <div id="experiences">
            <span class="experiences-header">NOMINATED EXPERIENCES</span>
                <ul>
                    
                    <?php
//var_dump($nominees);
                        foreach($experiences as $n => $experience){

                          
                           
                            
                    ?>
                    <li>
                        <?php
                         
                      
                    
                       $href=@$experience['meta']['resource_url'][0];
                        
                       if($href!=""){
                        ?>
                        <a href="<?=$href?>" target="_blank">
                            <?php
                          //  print $experience['title'];
                                if($src= getThumbnail(@$experience['meta']['_thumbnail_id'][0])){?>
                                <img src="<?=$src?>" alt=""><span>
                                <?=@$experience['title']?>
                                </span>
                        </a>
<?php }?>

         
         
                           
                        
                    
                    <?php
                    } else {
                        print "BLANK".$experience['title'];
                    }
                    ?>
                    </li>
                    <?php
                        }
                    ?>
                </ul>

            </div>
            

    </div>

