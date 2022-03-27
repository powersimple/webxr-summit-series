<?php
    get_header();

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
            include "webxr/summits22/assets.php";
            include "webxr/summits22/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky>

    <?php
            include "webxr/summits22/rigging.php";
            include "webxr/summmits22/lights.php";

?>
    <a-entity id="summits-2022" position="0.05 0 -21.2" rotation="0 0 0" scale="1 1 1" visible="true">
   



    </a-entity><!-- summmits-->
</a-scene>
<?php
     get_footer();
?>