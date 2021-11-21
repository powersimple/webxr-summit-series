<?php

//phpinfo(); die();

get_header();
//    get_eventsFromTable(15);
    require_once "webxr/functions-aframe.php";
    $speed = "0.2";
    if(@$_GET['speed']){
        $speed = $_GET['speed'];    
    }
    $menu = 'bizsummit21';
    $model='';

    if(@$_GET['event_menu']){
        $menu = $_GET['event_menu'];
    }

    $summit_square_model = 'business-summmit-square';
    if(@$_GET['summit_model']){
        $summit_square_model = $_GET['summit_model'];
    }
  
    $cam_x = 0;
$cam_y = 1.6;
$cam_z = 0;

if(@$_GET['camera']){
  $cam_coords =  explode("~",$_GET['camera']);
  if(count($cam_coords) == 3){
    $cam_x = $cam_coords[0];
    $cam_y = $cam_coords[1];
    $cam_z = $cam_coords[2];
  }
}

    $thumbnail =getThumbnail(get_post_thumbnail_id($post->ID),"Full");
     ?>



    
   
    <script>
        if (location.protocol !== 'https:') {
            location.replace(`https:${location.href.substring(location.protocol.length)}`);
        }
    </script>
  

  <script src="/assets/js/polys2.js"></script>




    <a-scene look-switch anti-drop grab-panels burial-grab item-grab device-set device-orientation-permission-ui gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link 
        device-orientation-permission-ui physics="iterations: 30;"
        inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
        loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
        background="color: #000000">
        <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
        <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>

        <a-assets timeout="800000">
             <!-- Loads models -->
    <a-asset-item id="2nd-polys-trophy" response-type="arraybuffer"
    src="/assets/models/polys/2021-Poly.glb"></a-asset-item>
    
    <a-asset-item id="polys2" response-type="arraybuffer" src="/assets/models/Polys2.glb"></a-asset-item>
    
    <img id="sky" src="/assets/images/skybox/Polys2Skybox.jpg">


            <?php// include "webxr/summits/assets.php";?>
            <?php include "webxr/summits/mixins.php";?>
            <a-asset-item id="platform" response-type="arraybuffer" src="/assets/models/polys/platform.glb"></a-asset-item>
            
        </a-assets>


        <a-sky src="#sky"></a-sky>
        <a-entity>
            <a-text id="GL-VR" visible="false" position="2.55 -0.1 0.01" value="" color="white" width="4"
                line-height="50" text="wrapCount: 30"></a-text>
            <a-text id="GL-PC" visible="false" position="2.55 -0.1 0.1" value="" color="black" width="5"
                line-height="50" text="wrapCount: 30"></a-text>
            <a-text id="GL-SP" visible="false" position="2.55 -0.1 0.1" value="" color="black" width="5"
                line-height="50" text="wrapCount: 30"></a-text>


            <a-text id="SMH-VR" visible="false" position="-6.65 -0.57 0.01" value="" color="black" width="5"
                line-height="60" text="wrapCount: 30"></a-text>
            <a-text id="SMH-PC" visible="false" position="-6.65 -0.75 0.01" value="" color="black" width="5"
                line-height="40" text="wrapCount: 30"></a-text>
            <a-text id="SMH-SP" visible="false" position="-6.65 -0.6 0.01" value="" color="black" width="5"
                line-height="50" text="wrapCount: 25"></a-text>
        </a-entity>


        <a-entity id="rig" rotation-reader thumbstick-logging
            movement-controls="speed: <?=$speed?>; constrainToNavMesh: true;fly: true" position="<?=$cam_x?> <?=$cam_y?> <?=$cam_z?>" rotation="0 0 0">
           
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>

            <a-entity id="camera" camera look-controls capture-mouse cursor="rayOrigin:mouse" camera="zoom: 1"
                raycaster="far: 5; objects: .clickable" super-hands="colliderEvent: raycaster-intersection;
                             colliderEventProperty: els;
                             colliderEndEvent:raycaster-intersection-cleared;
                             colliderEndEventProperty: clearedEls;" position="0 0 0" rotation="0 0 0"></a-entity>

            <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: highPoly; color: #ffcccc"></a-entity>
            <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: highPoly; color: #ffcccc"></a-entity>

            <a-entity oculus-touch-controls="hand: left" vive-controls="hand: left" thumb-controls="hand: left" blink-controls="cameraRig: #rig; teleportOrigin: #camera; collisionEntities: #nav; hitCylinderColor: #e9974c; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
            </a-entity>
            <a-entity oculus-touch-controls="hand: right" vive-controls="hand: right " thumb-controls="hand: right">
            </a-entity><!---->

            
        </a-entity>  

        <a-entity>
       
        
        <a-entity id="2nd-polys-logo-model" class="center-obj-zone" static-body
                gltf-model="#polys2" visible="true" scale="200 200 200" position="0.4 80 -132"
                rotation="90 0 0"><a-light id="logo-spot1" type="spot" color="#124aba" distance="105" intensity="15" position="0.2 -0.23 0.087" angle="90" scale="0 0 0"></a-light></a-entity>

            <a-entity id="2nd-polys-trophy-model" class="center-obj-zone" static-body
                gltf-model="#2nd-polys-trophy" visible="true" scale="20 20 20" position="0.183 -4.45 -132"
                rotation="0 -90 0">
                    <a-light id="trophy-spot1" type="spot" color="#fff" distance="105" intensity="40" position="3.5 1.3 0" angle="22" rotation="0 90 0"></a-light>
                   
                    <a-light id="trophy-spot2" type="spot" color="#f00" distance="105" intensity="40" position="3 028 0" angle="20" rotation="-14.1 90 0"></a-light>

                    <a-light id="trophy-spot3" type="spot" color="#f0f" distance="157" intensity="40" position="7 1.5 0" angle="50" rotation="-34.2 90 0"></a-light></a-entity>

                    <a-image id="hosts-png" material="side:front" mixin="scale-label"
                            src="<?=$thumbnail?>" scale="75 75 75" position="3.746 30 -142"
                rotation="0 0 0"
                            ></a-image>
                
            <a-entity id="platform-model" class="center-obj-zone" static-body
                gltf-model="#platform" visible="true" scale="250 100 250" position="0 -7 -90"
                rotation="0 0 0">
                <a-light id="platform-spot1" type="spot" color="#fff" distance="200" intensity="15" position="0 0.321 0.56" angle="25" rotation="-30 0 0"></a-light>
            </a-entity>
    </a-entity>

    <a-entity id="light-rig" position="0 60 0">

    <a-light id="Spin-spot1" type="spot" color="#fff" distance="150" intensity="15" position="0 0 0" animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 12000; loop: true;"angle="250" rotation="0 0 0"></a-light></a-entity>
    





    </a-entity>


        <?php 
        
    
        ?>

































    </a-scene>
</body>

<?php get_footer();?>
</html>