

<a-asset-item id="buttonmodel" response-type="arraybuffer" src="/assets/models/button.glb"></a-asset-item>
<a-asset-item id="buttonupmodel" response-type="arraybuffer" src="/assets/models/button-up.glb">
</a-asset-item>


<a-asset-item id="emblem" response-type="arraybuffer" src="/assets/models/polys/emblem22.glb"></a-asset-item>

<img id="sky" src="/assets/images/skybox/bluegreenparabola.jpg">
<a-asset-item id="ring" response-type="arraybuffer" position="0 0 -5" src="/assets/models/polys/ring.glb">
</a-asset-item>

<!--2021-->

<?php
    $trophy = '2021-Poly';
    if(@$_GET['trophy']){
        $trophy =$_GET['trophy'];
        ?>
        <a-asset-item id="2nd-polys-trophy" response-type="arraybuffer" src="/assets/models/polys/trophies/<?=$trophy?>.glb"></a-asset-item>
        <?php
    } else if(@$_GET['laurel']){
        $trophy =$_GET['laurel'];
        ?>
        <a-asset-item id="2nd-polys-trophy" response-type="arraybuffer" src="/assets/models/polys/laurels/<?=$trophy?>.glb"></a-asset-item>
        <?php
    } else {
        ?>
           <a-asset-item id="2nd-polys-trophy" response-type="arraybuffer" src="/assets/models/polys/trophies/<?=$trophy?>.glb"></a-asset-item>
        <?php
    }
?>





<a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/polys/pedestal.glb"></a-asset-item>
<a-asset-item id="polys2" response-type="arraybuffer" src="/assets/models/polys/Polys2Logo.glb"></a-asset-item>


<!--logos-->
<a-asset-item id="futurewei" response-type="arraybuffer" src="/assets/models/polys/Logo_Futurewei.glb"></a-asset-item>
<a-asset-item id="powersimple" response-type="arraybuffer" src="/assets/models/polys/Logo_Powersimple.glb"></a-asset-item>
<a-asset-item id="metavrse" response-type="arraybuffer" src="/assets/models/polys/Logo_MetaVRse.glb"></a-asset-item>
<a-asset-item id="point-cloud" response-type="arraybuffer" src="/assets/models/polys/a-point-cloud-production.glb"></a-asset-item>

<!--



<a-asset-item id="summitseries2022" response-type="arraybuffer" src="/assets/models/2022summits/2022-WebXR-SummitSeries-Logo-Horizontal.glb"></a-asset-item>

<a-asset-item id="educationsummit" response-type="arraybuffer" src="/assets/models/2022summits/2022-WebXR-EducationSummit-Logo-Horizontal.glb"></a-asset-item>

<a-asset-item id="brandsummit" response-type="arraybuffer" src="/assets/models/2022summits/2022-WebXR-BrandSummit-Logo-Horizontal.glb"></a-asset-item>

<a-asset-item id="productionsummit" response-type="arraybuffer" src="/assets/models/2022summits/2022-WebXR-ProductionSummit-Logo-Horizontal.glb"></a-asset-item>

<a-asset-item id="polys3" response-type="arraybuffer" src="/assets/models/polys/3rd/3rdPolysLogo.glb"></a-asset-item>-->

<?php
    foreach($assets as $key => $asset){
        extract($asset);
        ?>
<a-asset-item id="<?=$slug?>" response-type="arraybuffer" src="<?=$path?>"></a-asset-item>
        <?php
    }
?>