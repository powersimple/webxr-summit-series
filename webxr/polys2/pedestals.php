
    <?php
   


        $pedestal_z = 0;
      //  var_dump($pedestals); die();
        foreach($pedestals as $key=>$pedestal){
            extract($pedestal);
           print "<!-- $coords -->";
         
            $coords=explode(" ",$coords);
            $title = str_replace("2021 – ","",$title);
    ?>
    

    <?php
                    $trophy_offset = "0.008 4.367 -1.009";
                  
                    $card_title = "";

                    $z_offset=2;
                    
                    $levels =[
                        "level1"=>0,
                        "level2"=>0,
                        "level3"=>0,
                        
                    ]
            
                
                
                ?>
 

<!--<?=$pedestal['slug']?>-->
        

<a-entity class="center-zone" id="table-<?=$pedestal['slug']?>" <?=getCoords($coords,$pedestal_z)?> class="<?=implode(" ",$classes)?>">

        <!--PEDESTAL-->
        <a-entity 
        gltf-model="#pedestal"
        class="table" static-body="shape: box;" 
        position="0 0.3 0"
        rotation="0 17.5 0"
        scale="0.25 0.25 0.25" id="pedestal-<?=$pedestal['slug']?>"  
        material="shader: standard; metalness: 0.8;"  
            shadow="cast: false; receive: false"></a-entity>

              <!-- SIGNAGE-->
        <a-entity id="signage-<?=$pedestal['slug']?>" rotation="0 0 0" position="0 1.1.24 0.09">
        <!--
        <a-entity troika-text='value:2021 WebXR Awards; color:#fff; fontSize:.04;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 0.09 0.01" rotation="0 0.111 0">
                </a-entity>-->

                        <?php if(!@$_GET['hidelabels']){?> 
                <a-entity troika-text='value:<?=$title?>; color:#f5f5f5; align:center; color:#fff; fontSize:.08;align:center;maxWidth:0.8'
                    material="shader: standard; metalness: 0.8;" position="0 0.01 0.01" rotation="0 0 0">
                </a-entity>
            <a-plane height="0.3" width="0.55" position="0 0 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double" visible="false">

               
<!--                <a-entity troika-text='value:; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 -0.089 0.01" rotation="0 0 0"></a-entity>-->
            </a-plane>
            <?php }?>
        </a-entity>
        



        <!--TROPHY-->
        <a-entity id="<?=$pedestal['slug']?>-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.28 0" mixin="obj" rotation="0 -75 0" scale="0.25 0.25 0.25" gltf-model="#2nd-polys-trophy"></a-entity>


 <!--NOMINATIONs WRAPPER-->
        <a-entity id="nominations" rotation="0 0 0" position="0 30 -200" scale="30 30 30" shadow >
        
                <a-entity id="<?=$pedestal['slug']?>-title" class="art-text" mixin="table-label" position="0 0 0" color="white"
                    width="2.5" rotation="0 0 0" text="value:;wrapCount:50 ">

                    <a-entity troika-text='value:<?=$pedestal['title']?>; color:#f5f5f5; align:center; color:#fff; fontSize:.5;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 2 0" rotation="0 0 0">
                </a-entity>
                  <?php
                  $pos_x = 0;
                  $pos_y = 1.5;
                  $pos_z = 0;
                 
                   

                 $card_coordinates_x = setCardCoords(count($nominees));
                 


        $counter = 0;                
        foreach($nominees as $n => $nomination){
            if ((@$nomination['classes'][0] == 'presenter')){
                continue;
            }
            $winner=0;
            if ((@$nomination['classes'][0] == 'winner')){
                $winner=1;
                
            }

            $coordinates = $card_coordinates_x[$counter];
           
            $px = "px_".$card_coordinates_x[$counter];
          



            ?>

     <a-entity  id="<?=$nomination['slug']?>-card" class="center-obj-zone"  <?=getCoords(explode(" ",$px))?>>
            <?php

            if( $laurel_id = @$nomination['meta']['laurel'][0]){
                
            $laurel = getGLB($laurel_id);
            ?>
            <a-entity  id="<?=$nomination['slug']?>-laurel-model" class="center-obj-zone" static-body
                        full-gltf-model="#<?=$nomination['slug']?>-laurel" class="collision" position="1 -.5 0.1"
                        
                        scale="3 3 3" visible="true"></a-entity>

            <?php
          
            } else {
                ?>
        
                     
    




        <?php
            }//laurel
            $pos_x=$pos_x+3;
            $src="";
            if($thumbnail_id = @$nomination['meta']['_thumbnail_id'][0]){
                $src = "/wp-content".explode("/wp-content",getThumbnail($thumbnail_id))[1];
            }
         



            ?>
                <a-image mixin="scale-label" src="<?=$src?>"
                geometry="primitive: circle;"
                                                scale="1 1 1" position="0 .5 0" ></a-image>
<!-- nominee label-->
            <a-entity id="label-<?=$nomination['slug']?>" troika-text='value:<?=$nomination['title']?>; color:#f5f5f5;  wrapCount:18; color:#fff; 
            fontSize:.25;align:center; anchor:center;'material="shader: standard; metalness: 0.8;" rotation="0 0 0" position="0 -0.8 0"> </a-entity>



<!--nomination-->
<?php


if(in_array("honoree",$nomination['classes']) == 'honoree'){

    ?>
<a-entity id="label-<?=$nomination['slug']?>" troika-text='value:Honoree; color:#f5f5f5;  color:#fff; 
fontSize:.25;align:center; anchor:center;'material="shader: standard; metalness: 0.8;" rotation="0 0 0" position="0 -1.10 0"> </a-entity>

<a-entity id="content-<?=$nomination['slug']?>" troika-text='value:<?=strip_tags(str_replace("\n\n\n",'\n',$pedestal['content']))?>; color:#f5f5f5;  max-width:4.5; color:#fff; 
fontSize:.2;align:left; anchor:left;'material="shader: standard; metalness: 0.8;" rotation="0 0 0" position="1.4 0.15 0"> </a-entity>


    <?php
}

    $y=-1.2;
                        foreach($nomination['children'] as $o => $nominee){ //nominee
                                
                            ?>
                             <a-entity troika-text='value: <?=$nominee['title'] ?> ; color:#f5f5f5; align:center; color:#fff; fontSize:.2;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 <?=$y?> 0" rotation="0 -0.1 0"></a-entity>


                            
                                <?php
                                


                                $y=$y-.3;
                                    }
                                    if($winner){
                                        if(!@$_GET['hidewinners']){
                                        ?>
         <a-entity troika-text='value:WINNER ; color:#fff000; align:center; color:#fff000; fontSize:.2;align:center;'
                        material="shader: standard; metalness: 0.8;" position="0 <?=$y?> 0" rotation="0 -0.1 0"></a-entity>
                                        <?php
                                        }
                                    }

                                ?>
</a-entity><!--nomination-->
            

            <?php
            $counter++;//nomination counter;
        }// for nomination
?>



                       
                        

                    </a-entity>

        </a-entity>

    </a-entity>
    <?php
    
    $pedestal_z = ($pedestal_z-$z_offset);

    }
    ?>


<script>


AFRAME.registerComponent("item-grab", {
    init: function () {
        sceneEl = document.querySelector('a-scene');
        var grabtrig = function (grabitem, grabinfo, grabtable, grabholo, grabproj, grabmodel, 
            cgrabrotate = "0 0 0", 
        grabscale = "5 5 5", grabposition = "0 1 0") {
              //  console.log("grab",grabitem, grabinfo, grabtable, grabholo, grabproj, grabmodel, grabrotate = "0 0 0", grabscale = "5 5 5", grabposition = "0 1 0")

            document.getElementById(grabitem).addEventListener("grab-start", function (evt) {
                if (document.getElementById(grabinfo).getAttribute('visible') == true) {
                    for (let each of sceneEl.querySelectorAll(grabtable)) { // Turn off everything
                        each.object3D.visible = false;
                    }
             //       document.getElementById(grabproj).object3D.visible = false;
                   //document.getElementById(grabholo).object3D.visible = false;
                } else {
                    for (let each of sceneEl.querySelectorAll(grabtable)) {
                        each.object3D.visible = false;
                    }
//                    document.getElementById(grabproj).object3D.visible = true;
                    document.getElementById(grabinfo).object3D.visible = true;
                    /*document.getElementById(grabholo).object3D.visible = true;
                    document.getElementById(grabholo).setAttribute("full-gltf-model", grabmodel);
                    document.getElementById(grabholo).setAttribute("rotation", grabrotate);
                    document.getElementById(grabholo).setAttribute("scale", grabscale);
                    document.getElementById(grabholo).setAttribute("position", grabposition);*/
                }
            })
           
        }
<?php
        foreach($pedestals as $key=>$pedestal){
            extract($pedestal);
            ?>
        grabtrig("<?=$pedestal['slug']?>-grab", "<?=$pedestal['slug']?>-title", ".art-text", "holoartifact", "holoartproj", "models/emblem.glb", undefined, "2 2 2", undefined)
        <?php
        


        foreach($nominees as $n => $nomination){

            if($laurel_id = @$nomination['meta']['laurel']){
            $laurel =getGLB($laurel_id);          
            ?>
        
        //    grabtrig("<?=$nomination['slug']?>-grab", "<?=$nomination['slug']?>-title", ".art-text", "holoartifact", "holoartproj", "models/emblem.glb", undefined, "2 2 2", undefined)
            <?php
            } 
        }









        
        }
    ?>

    }
})

</script>