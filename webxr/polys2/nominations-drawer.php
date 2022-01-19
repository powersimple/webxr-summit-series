<div class="sidedrawer"> 
    <div id="menuclose"></div>
        <div id="nominees">
            <h2>THE POLYS WebXR Awards</h2>
            <h4>Nominations</h4>

        </div>
        <div id="accordion">
            <?php
               
                foreach($pedestals as $p => $pedestal){
                extract($pedestal);
         
                if($laurel_id = @$pedestal['meta']['3Dlogo']){
                    
                    $laurel =getGLB($laurel_id);          
                    
                    array_push($assets,["slug"=>$pedestal['slug']."-3Dlogo","path"=>$laurel]);
                }
                //var_dump($pedestal['slug']);
            ?>
            <h3><?=str_replace("2021 – ","",$title);?></h3>
            <div>

                <ul>
                    <?php
//var_dump($nominees);
                        foreach($nominees as $n => $nomination){

                            if($laurel_id = @$nomination['meta']['laurel']){
                                $laurel =getGLB($laurel_id);          
                                
                                array_push($assets,["slug"=>$nomination['slug']."-laurel","path"=>$laurel]);
                            } 
                           
                           
                            
                    ?>
                    <li>
                        <?php
                         
                      
                    
                         $href=@$nomination['meta']['resource_url'][0];
                        
                        ?>
                        <a href="<?=$href?>" target="_blank">
                            <?php
                                if($src= getThumbnail(@$nomination['meta']['_thumbnail_id'])){?>
                                <img src="<?=$src?>" alt="">
<?php }?>

         
         
                            <span class="nomination"><?=$nomination['title']?></span>
                            </a>
                            <?php
                        foreach($nomination['children'] as $o => $nominee){
                                
                            ?>
                            <span class="nominee"
                            ><?php
                                    print "<span class='nom'>$nominee[title]</span>";
                                    //var_dump($nominee);
                                ?>
                                        </span>
                                
                                <?php
                                    }
                                ?>
                        
                    </li>
                    <?php
                        }
                    ?>
                </ul>

            </div>
            <?php
                }
            ?>

        </div>

    </div>

