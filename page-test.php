<?php
    get_header();

     
    function get_nominations($menu){
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
              
          }// var_dump($pedestals); die();
          return $pedestals;
      }

      $pedestals = get_nominations('polys2');
    //    var_dump($pedestals);
      $assets = [];
      function getGLB($id){
        if(strpos(get_post($id)->guid,"/wp-content")){
          return '/wp-content'.explode('/wp-content',get_post($id)->guid)[1];
        }
        
      }

   if(@$_GET['dump'] == 'awards'){
     
?>

<div id="dump" style="position:absolute;top:0px; height:100vh;width:20%;background-color:rgba(10,10,10,0.4);color:#fff;z-index:100;overflow-y:scroll;">
    <?php 
    

    
    
    
    ?>
   </div>
<?php
}
   include "webxr/polys2/drawer-experiences.php";
 //   include "webxr/polys2/drawer-nominations.php";
?>

   

<a-scene gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link anti-drop
    device-orientation-permission-ui physics="iterations: 30;"
    inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
    loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
    background="color: #000000">
    <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
    <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
    <a-assets timeout="800000">
        <!-- Loads assets -->
        <?php
            include "webxr/polys2/assets.php";
            include "webxr/polys2/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky>

    <?php
            include "webxr/polys2/rigging.php";
            include "webxr/polys2/lights.php";

?>
<a-entity id="awards-2021" position="0.05 0 -21.2" rotation="0 0 0" scale="1 1 1" visible="true">
    <a-entity id="platform-wrap" visible="true" scale="2 2 2" 
    position="0 -2 0"
                rotation="0 0 0">

                <!--
                <a-image id="12-point" mixin="scale-label" src="/assets/images/bg/12Point2.png"
               
                                                position="0.12 1.145 3.973" scale="14.5 14.5 14.5"  rotation="90 0 0"></a-image>
              <a-image id="6-point" mixin="scale-label" src="/assets/images/bg/6Point.png"
               
                                                position="0.280 1.33 4.344" scale="12 12 12"  rotation="90 30 0"></a-image>-->is_array

            <a-entity id="outer-ring" class="center-obj-zone" static-body
                full-gltf-model="#ring" class="collision" visible="true"
                scale="1 1 1"
                position="0.11 0.069 3.97"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->

                <a-entity id="inner-ring" class="center-obj-zone" static-body
                full-gltf-model="#ring" class="collision" visible="true"
                scale=".8 .8 .8"
                position="0.126 0.569 3.97"
                static-body="shape: box;" 
                ><!-- inner ring -->
            <!--
                <a-entity id="emblem-model" class="center-obj-zone" static-body
                full-gltf-model="#emblem" class="collision" visible="true"
                scale="5 5 5"
                position="-0.41 3.25 0"
                static-body="shape: box;" 
                animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;"
                >
                <a-entity id="Polys2-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#polys2" class="collision" visible="true"
                        scale="5 5 5"
                        position="0 -0.5  0"

                        static-body="shape: box;" 
                    
                        ></a-entity>

            </a-entity>-->

            <a-entity id="trophy-model" class="center-obj-zone" static-body
                full-gltf-model="#2nd-polys-trophy" class="collision" visible="true"
                scale="25 25 25"
                position="0 -49 0"
               
                animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;">
                <a-entity id="Polys2-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#polys2" class="collision" visible="true"
                        scale="1 1 1  "
                        position="0 2.05  0"
                        rotation="0 90 0"
                        static-body="shape: box;" 
                    
                        ></a-entity>

            </a-entity>

            
                <a-entity id="logo-wrap"  animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;">

               
                    <a-entity id="futurewei-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#futurewei" class="collision" visible="true"
                        scale=".5 .5 .25"
                        position="0 1.5 5"

                        static-body="shape: box;" 
                    
                        ></a-entity>
                        <a-entity id="powersimple-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#powersimple" class="collision" visible="true"
                        scale=".5 .5 1"
                        position="-4.5 1.5 -2.4"
                        rotation="0 -120 0"
                        static-body="shape: box;">

                      
                       
                        
                        
                    </a-entity>
                    <a-entity id="point-cloud-model" class="center-obj-zone" static-body
                        full-gltf-model="#point-cloude" class="collision" visible="true"
                        scale=".7 .7 .7"
                        position="0 1.5 0"
                        rotation="0 120 0"

                        static-body="shape: box;" 
                    
                        >
                    
                    </a-entity>
                   
                    <a-entity id="metavrse-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#metavrse" class="collision" visible="true"
                        scale=".7 .7 .7"
                        position="4.5 1.5 -2.4"
                        rotation="0 120 0"

                        static-body="shape: box;" 
                    
                        ></a-entity>
                </a-entity>


            </a-entity><!-- /inner ring -->



                <!--
                <a-entity id="nav" class="center-obj-zone" static-body
                scale=".6 .6 .6 "
                position="0.124 .8 3.97"
                material="shader: standard; metalness: 0.8;" 
                full-gltf-model="#ring" class="collision" visible="true"></a-entity>-->
    </a-entity><!-- platform-->
    <a-entity id="pedestals" position="0 0 20" rotation="0 0 0">
  <?php

            include "webxr/polys2/pedestals.php";


        ?>
        </a-entity><!-- pedestals -->

    </a-entity><!-- awards 2021-->



  


     





<!--




        <a-entity position="0 -.2  -5.658" id="projector">
            <a-cylinder color="gray" rotation="0 30 0" segments-radial="8" segments-height="1" height="0.15"
                geometry="radius: 0.1"></a-cylinder>
            <a-entity id="holoartproj" visible="false">
                <a-entity mixin="holoprojector"></a-entity>
                <a-entity id="holoartifact" scale="7 7 7" rotation="0 0 0" class="center-obj-zone" static-body
                    position="0 1.25 0" full-gltf-model=""
                    animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 12000; loop: true;"
                    visible="false"></a-entity>
            </a-entity>
        </a-entity>







-->


















</a-scene>
<?php
     get_footer();
?>