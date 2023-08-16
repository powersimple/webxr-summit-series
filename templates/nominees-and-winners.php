<div id='top'></div>
<?php
    // included from winners pages

   foreach($awards as $key => $award){// outer menu loop
    print "<ul class='awards-list'>";
    foreach($award['children'] as $c =>$child){// EVENTS
        if($child['classes'][0] == 'nomination' || $child['classes'][0] == 'honor'){
          
            if(strpos($child['title'],"–") !== false){
                $label = explode("–",$child['title']);
                $label = $label[1];
            } else {
                $label = $child['title'];
            }
           
          
   
        ?>
<li><a href="#<?=$child['slug']?>" title="<?=$child['title']?>"><?=$label?></a></li>
        <?php
        }
       
    } print "</ul>";
   foreach($award['children'] as $c =>$child){// EVENTS loop
     ?>
              
  
   <?php
     if($child['classes'][0] == 'nomination' || $child['classes'][0] == 'honor'){
       $link = get_permalink($child['ID']);
       ?>
       <div class="row justify-content-center">
      <h3 class="nomination-category"  id="<?=$child['slug']?>"><a href="<?=$link?>" title="<?=$child['title']?>"><?=$child['title']?></a></h3>

 
       <div class="col-12 col-sm-10 col-md-8 col-lg-6">
       <?php
       

       print "<ul class='nominee-list'>";
       get_nominees_and_winners($child['children'],0);//recursive nominees loop
       ?>
      </ul>

       <a href="#top" class="back-to-top">Back to top ↥</a>
       </div>      
       </div><hr>
       <?php
     }
    
   }
  
 
 }

?>