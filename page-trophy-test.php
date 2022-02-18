

<?php
    get_header();

   

      $pedestals = get_pedestals('polys2');
    //    var_dump($pedestals);
      $assets = [];
     

   if(@$_GET['dump'] == 'awards'){
     
?>

<div id="dump" style="position:absolute;top:0px; height:100vh;width:20%;background-color:rgba(10,10,10,0.4);color:#fff;z-index:100;overflow-y:scroll;">
    <?php 
    

    
    
    
    ?>
   </div>
<?php
}
 //  include "webxr/polys2/drawer-experiences.php";
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
<a-asset-item id="trophy" response-type="arraybuffer" src="/assets/models/trophies/<?=@$_GET['model']?>.glb"></a-asset-item>


            <a-entity id="trophy-model" class="center-obj-zone" static-body
                class="collision" visible="true"
                position="0 -1.6 2.2" mixin="obj" rotation="0 -75 0" scale="10 10 10" full-gltf-model="#trophy" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;">
                <a-entity id="Polys2-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#polys2" class="collision" visible="true"
                        scale="1 1 1  "
                        position="0 2.05  0"
                        rotation="0  -30 0"
                        static-body="shape: box;" 
                        ></a-entity>

            </a-entity>


          

            </a-entity>
    <?php

    ?>

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