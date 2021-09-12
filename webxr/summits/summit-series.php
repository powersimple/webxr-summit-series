<a-assets timeout="800000">

<a-asset-item id="series-model" response-type="arraybuffer" src="/assets/models/WebXRSummitSeries-Horizontal.glb"></a-asset-item>



</a-assets>
<a-entity id="summit-series" <?=$seating_position?> scale="200 200 200" visible="true">
            <a-light id="series-spot1" type="spot" color="#4de407" distance="105" intensity="15" position="-0.13 0.44 -0.045" angle="25" rotation="-87.2 -0.33 0"></a-light>
            <a-light id="series-spot2" type="spot" color="#4de407" distance="105" intensity="15" position="0 0.44 -0.117" angle="25" rotation="-104.68 -0.45 0"></a-light>
            <a-light id="series-spot3" type="spot" color="#4de407" distance="105" intensity="15" position="0.124 0.44 -0.131" angle="25" rotation="-104.68 -5.6 0"></a-light>
                <a-entity position="0 0 0" rotation="0 0 0" id="chair6" gltf-model="#series-model" scale="1 1 1" visible="true"></a-entity>
 </a-entity>