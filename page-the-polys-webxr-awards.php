<?php
    get_header();
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

    <a-scene look-switch anti-drop grab-panels burial-grab item-grab device-set device-orientation-permission-ui gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link 
        device-orientation-permission-ui physics="iterations: 30;"
        inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
        loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
        background="color: #000000">
        <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
        <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
        <a-assets timeout="800000">
        <a-asset-item id="ring" response-type="arraybuffer" position="0 0 -5" src="/assets/models/Ring.glb">
</a-asset-item>
<a-asset-item id="poly" response-type="arraybuffer" src="/assets/models/trophy.glb"></a-asset-item>

<a-asset-item id="the-polys" response-type="arraybuffer" src="/assets/models/thepolys.glb"></a-asset-item>
<a-asset-item id="webxr-awards" response-type="arraybuffer" src="/assets/models/WebXRAwards.glb">
</a-asset-item>
<a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/pedestal.glb"></a-asset-item>
<img id="sky" src="/assets/images/skybox/blueskybox.jpg">
<a-asset-item id="emblem" response-type="arraybuffer" src="/assets/models/emblem.glb"></a-asset-item>

<!-- NFT TROPHIES -->
<a-asset-item id="foty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_FOTY.glb"></a-asset-item>
<a-asset-item id="sueoty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_SUEOTY.glb"></a-asset-item>
<a-asset-item id="mueoty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_MUEOTY.glb"></a-asset-item>
<a-asset-item id="ioty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_IOTY.glb"></a-asset-item>
<a-asset-item id="eeoty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_EEOTY.glb"></a-asset-item>
<a-asset-item id="goty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_GOTY.glb"></a-asset-item>
<a-asset-item id="doty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_DOTY.glb"></a-asset-item>
<a-asset-item id="ombudsperson" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_Ombudsperson.glb"></a-asset-item>
<a-asset-item id="edoty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_EDOTY.glb"></a-asset-item>
<a-asset-item id="lifetime" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_LIfetime.glb"></a-asset-item>
<a-asset-item id="soty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_SOTY.glb"></a-asset-item>
    <a-asset-item id="soty" response-type="arraybuffer"
    src="/assets/trophies/16ae2b7e-6711-4841-bd19-ebdcce8d95c6_SOTY.glb"></a-asset-item>


<a-asset-item id="polys" response-type="arraybuffer" src="/assets/models/polys.glb"></a-asset-item>
<a-asset-item id="polys2" response-type="arraybuffer" src="/assets/models/Polys2.glb"></a-asset-item>
<!--  <a-asset-item id="the-movie" response-type="arraybuffer" src="/assets/models/themovie.glb">
    </a-asset-item>-->
<a-asset-item id="world-premiere" response-type="arraybuffer" src="/assets/models/world-premiere-may-6.glb">
</a-asset-item>
            <?php include "webxr/summits/mixins.php";?>


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
            movement-controls="speed: 0.2; constrainToNavMesh: true;fly: true " position="0 0.1 1">
            <!-- Player Character -->
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>

            <!-- CAMERA 
                    summit coords position="-40 35 -105" f

                -->

            <a-entity id="camera" camera look-controls raycaster="far: 5; objects: .clickable"
                super-hands="colliderEvent: raycaster-intersection; colliderEventProperty: els; colliderEndEvent:raycaster-intersection-cleared; colliderEndEventProperty: clearedEls;"
                position="0 1.5 0" rotation="180 150 0">
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



       


        <?php include "webxr/polys/2020-Polys.php";?>













        <a-entity id="trophy2021-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#trophy2021"
            intensity="0.2">
        </a-entity>













    </a-scene>
</body>
<script src="/assets/js/main.js"></script>

<script>
    jQuery("#menu").click(function () {

        jQuery(".sidedrawer").animate({
            left: 0,
            opacity: 1
        }, 500);
        jQuery("body").animate({
            marginLeft: 250,
        }, 500);
        jQuery("#menuclose").show();
        jQuery(this).hide();
    });

    jQuery("#menuclose").click(function () {
        jQuery(".appswitchdropdown").hide();
        jQuery(".sidedrawer").animate({
            left: -250,
            opacity: 1
        }, 300);
        jQuery("body").animate({
            marginLeft: 0,
        }, 300);
        jQuery("#menu").show();
        jQuery(this).hide();
    });

    jQuery(".appswitch").click(function () {
        jQuery(".appswitchdropdown").toggle();
    });
    jQuery(".page").hover(function () {
        jQuery(".appswitchdropdown").hide();
    });
    jQuery(".appconversation").click(function () {
        jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").hide();
        jQuery(".convo").show();
        jQuery("body").css({
            marginLeft: 0,
        }, 500);
    });

    jQuery(".convo").click(function () {
        jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").show();
        jQuery(".convo, .trendscontent ").hide();
        jQuery("body").css({
            marginLeft: 250,
        }, 500);
    });

    jQuery(".appstudio").click(function () {
        jQuery(".spark, .sparkcontent, .sparklist").hide();
        jQuery(".studio, .studiolist").show();
        jQuery('#logo').css('background-position', '0px 0px');
        jQuery('.appswitch').css('background-position', '0px 0px');
    });



    jQuery(".collapse").click(function () {
        jQuery(".collapse").hide();
        jQuery(".expand").show();
        jQuery('.sidedrawer').css('width', '60px');
        jQuery(".sparklist div, .appswitch").css({
            width: 50,
        }, 500);

        jQuery("body").animate({
            marginLeft: 60,
        }, 500);


    });

    jQuery(function () {
        jQuery("#accordion").accordion({
            autoHeight: true
        });
    });
</script>
<?php get_footer();?>
</html>