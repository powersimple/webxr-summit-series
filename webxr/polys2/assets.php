

<a-asset-item id="buttonmodel" response-type="arraybuffer" src="/assets/models/button.glb"></a-asset-item>
<a-asset-item id="buttonupmodel" response-type="arraybuffer" src="/assets/models/button-up.glb">
</a-asset-item>


<a-asset-item id="emblem" response-type="arraybuffer" src="/assets/models/polys/emblem22.glb"></a-asset-item>

<img id="sky" src="/assets/images/skybox/MilkyWaySkybox.jpg">
<a-asset-item id="ring" response-type="arraybuffer" position="0 0 -5" src="/assets/models/polys/ring.glb">
</a-asset-item>

<!--2021-->
<a-asset-item id="2nd-polys-trophy" response-type="arraybuffer" src="/assets/models/polys/2021-Poly.glb"></a-asset-item>
<a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/polys/pedestal.glb"></a-asset-item>
<a-asset-item id="polys2" response-type="arraybuffer" src="/assets/models/polys/Polys2Logo.glb"></a-asset-item>


<!--logos-->
<a-asset-item id="futurewei" response-type="arraybuffer" src="/assets/models/polys/Logo_Futurewei.glb"></a-asset-item>
<a-asset-item id="powersimple" response-type="arraybuffer" src="/assets/models/polys/Logo_Powersimple.glb"></a-asset-item>
<a-asset-item id="metavrse" response-type="arraybuffer" src="/assets/models/polys/Logo_MetaVRse.glb"></a-asset-item>
<a-asset-item id="point-cloud" response-type="arraybuffer" src="/assets/models/polys/a-point-cloud-production.glb"></a-asset-item>


<?php
    foreach($assets as $key => $asset){
        extract($asset);
        ?>
<a-asset-item id="<?=$slug?>" response-type="arraybuffer" src="<?=$path?>"></a-asset-item>
        <?php
    }
?>