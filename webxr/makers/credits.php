<?php

$speed = "1.5";
if(@$_GET['speed']){
    $speed = $_GET['speed'];    
}
$cam_x =0;
$cam_y =1.6;
$cam_z =-3.5;
if(@$_GET['camera']){
    $cam_coords =  explode("~",$_GET['camera']);
    if(count($cam_coords) == 3){
      $cam_x = $cam_coords[0];
      $cam_y = $cam_coords[1];
      $cam_z = $cam_coords[2];
    }
  }
?>



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
            movement-controls="speed:<?=$speed?>;" position="0 0 0">
            <!-- Player Character -->
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>
            
                <!-- CAMERA 
                    summit coords position="-40 35 -105" f
 position="<?=$cam_x?> <?=$cam_y?> <?=$cam_z?>" 
                -->
                
            <a-entity camera look-controls="fly:true"  wasd-controls="fly:true; acceleration:<?=$speed?>" raycaster="far: 5; objects: .clickable"
                super-hands="colliderEvent: raycaster-intersection; colliderEventProperty: els; colliderEndEvent:raycaster-intersection-cleared; colliderEndEventProperty: clearedEls;"
                
                position="<?=$cam_x?> <?=$cam_y?> <?=$cam_z?>" 
            
                rotation="0 -25 0"
                
                >
                <a-light id="cam-light-front"  color="#ffffff"  position="0 0 0" rotation="0 0 0"  light="type: spot; intensity: 4; angle: 75; distance:30; shadowRadius: -3.72" visible="" type="ambient"></a-light>
 <!---->
                <a-light id="cam-light-left"  color="#ffffff"  position="-30 0 0" rotation="0 30 0"  light="type: spot; intensity: 20; angle: 90;distance:30; shadowRadius: -3.72" visible=""></a-light>
                <a-light id="cam-light-right"  color="#ffffff"  position="30 0 0" rotation="0 60 0"  light="type: spot; intensity: 20; angle: 60;distance:30; shadowRadius: -3.72" visible=""></a-light>
                


                <a-entity id="meet-the-makers-logo" class="center-obj-zone" static-body
                gltf-model="#meet-the-makers-logo" class="collision" visible="true"
                position="0 0 0" mixin="obj" rotation="0 0 0" scale="10 10 10" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"></a-entity>




                <a-entity id="crosshair" cursor="rayOrigin:mouse" position="0 0 -0.2"
                    geometry="primitive: ring; radiusInner: 0.002; radiusOuter: 0.003"
                    material="shader: flat" raycaster="far: 5; objects: .clickable" visible="false"></a-entity>
            </a-entity>

            <a-entity mixin="hand"  oculus-touch-controls="hand: left" hand-controls="hand: left; handModelStyle: highPoly; color: #0055ff"> 
             <!-- -->
          <!--  <a-entity fps-counter></a-entity>-->
            </a-entity>
            <a-entity mixin="hand" oculus-touch-controls="hand: right" hand-controls="hand: right; handModelStyle: highPoly; color: #0055ff"   blink-controls ="cameraRig: #rig;  teleportOrigin: #camera; collisionEntities: .collision; hitCylinderColor: #FF0; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8;landingNormal:0 2 0"  >   
            </a-entity>
        </a-entity>
