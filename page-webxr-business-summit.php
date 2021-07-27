<?php
    get_header();


     ?>








    <a-scene look-switch anti-drop grab-panels item-grab device-set device-orientation-permission-ui
        gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link
        device-orientation-permission-ui physics="iterations: 30;"
        inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
        loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
        background="color: #000000">
        <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
        <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
        <a-assets timeout="800000">
            <?php 
    require_once("webxr/summits/summit-assets.php")

?>
            <!-- CAMERA 
            


                THIS CAMERA AND RIG IS PAGE SPECIFIC



                -->

            <a-entity id="camera" camera look-controls raycaster="far: 5; objects: .clickable"
                super-hands="colliderEvent: raycaster-intersection; colliderEventProperty: els; colliderEndEvent:raycaster-intersection-cleared; colliderEndEventProperty: clearedEls;"
                position="0 0 10" rotation="180 150 0">
                <a-entity id="crosshair" cursor="rayOrigin:mouse" position="0 0 -0.2"
                    geometry="primitive: ring; radiusInner: 0.002; radiusOuter: 0.003" material="shader: flat"
                    raycaster="far: 5; objects: .clickable" visible="false"></a-entity>
            </a-entity>
            <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: lowPoly; color: #0055ff">
                <!--<a-entity fps-counter></a-entity>-->

            </a-entity>
            <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: lowPoly; color: #0055ff"
                blink-controls="cameraRig: #rig;  teleportOrigin: #camera; collisionEntities: #mountain-model; hitCylinderColor: #00; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
            </a-entity>
            </a-entity>
            <a-entity id="rig" rotation-reader thumbstick-logging
                movement-controls="speed: 0.1; constrainToNavMesh: true;fly: true" position="-39 147.5 -99.5"
                rotation="0 0 0">

                <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone"
                    static-body="shape: box" position="0 0 0" width="0.25" height="0.25" depth="0.25" visible="false">
                </a-box>

                <a-entity id="camera" camera look-controls capture-mouse cursor="rayOrigin:mouse" camera="zoom: 1"
                    raycaster="far: 5; objects: .clickable" super-hands="colliderEvent: raycaster-intersection;
                             colliderEventProperty: els;
                             colliderEndEvent:raycaster-intersection-cleared;
                             colliderEndEventProperty: clearedEls;" position="0 1.6 -8.2 rotation=" 0 0 0"></a-entity>

                <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: highPoly; color: #ffcccc"></a-entity>
                <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: highPoly; color: #ffcccc"></a-entity>

                <a-entity oculus-touch-controls="hand: left" vive-controls="hand: left" thumb-controls="hand: left">
                </a-entity>
                <a-entity oculus-touch-controls="hand: right" vive-controls="hand: right " thumb-controls="hand: right"
                    blink-controls="cameraRig: #rig; teleportOrigin: #camera; collisionEntities: #nav #platform-collider; hitCylinderColor: #e9974c; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
                </a-entity>

            </a-entity>



            <?php include "webxr/summits/mixins.php";?>


        </a-assets>
        <a-sky src="#sky"></a-sky>





        <?php include "webxr/summits/space-elevator.php";
            include "webxr/summits/lowpolymountain.php";
            
            ?>





    </a-scene>
</body>

<?php get_footer();?>

</html>