





<a-asset-item id="platform" response-type="arraybuffer" position="0 0 -5" src="/assets/models/2022Summits/9SidedPlatform.glb">
</a-asset-item>
<a-asset-item id="brandtownhall" response-type="arraybuffer" src="/assets/models/2022Summits/2022_WebXR_Brand_Summit_TownHall_Long.glb"></a-asset-item>
<a-asset-item id="emblem" response-type="arraybuffer" src="/assets/models/emblem2022.glb"></a-asset-item>
<a-asset-item id="chair" response-type="arraybuffer" src="/assets/models/chair.glb"></a-asset-item>
<a-asset-item id="The3rdPolysTrophy-hosts" response-type="arraybuffer" src="/assets/models/polys/3rd/2022-Poly-hosts.glb"></a-asset-item>
<a-asset-item id="zerospace-logo" response-type="arraybuffer" src="/assets/models/polys/3rd/zerospace.glb"></a-asset-item>
<a-asset-item id="The3rdPolysLogo" response-type="arraybuffer" src="/assets/models/polys/3rd/3rdPolysLogo.glb"></a-asset-item>
<a-asset-item id="ring" response-type="arraybuffer" position="0 0 -5" src="/assets/models/polys/ring3.glb">
<!--
<a-asset-item id="22SummitsSquare" response-type="arraybuffer" src="/assets/models/2022Summits/2022WebXRSummitSeriesSquare.glb"></a-asset-item>-->
<!--LIST OF ASSETS GENERATED BY MENU-->

<?php
    $skybox_id = get_post_meta($post->ID,"skybox",true);
    //var_dump($skybox_id);
   $skybox = str_replace("-scaled","",getThumbnail($skybox_id));
   if($skybox_id != ""){

?>
   <img id="sky" src="<?=$skybox?>">
<?php
    }



   if(@$assets3D){// this var is created in panels.php
    foreach($assets3D as $key => $asset3D){
        ?>
<!-- ASSET <?=$asset3D['slug']?> -->
    <a-asset-item id="<?=$asset3D['slug']?>-logo3D" response-type="arraybuffer" src="<?=$asset3D['asset']?>"></a-asset-item>

            <?php
        }
    }

    ?>




<?php
    if(is_array(@$assets)){
        foreach($assets as $key => $asset){
         extract($asset);
            ?>
<a-asset-item id="<?=$slug?>" response-type="arraybuffer" src="<?=$path?>"></a-asset-item>
            <?php
        }
    }
?>



<a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/polys/pedestal.glb"></a-asset-item>
<a-asset-item id="polys2" response-type="arraybuffer" src="/assets/models/polys/Polys2Logo.glb"></a-asset-item>


<!--logos-->

<a-asset-item id="futurewei" response-type="arraybuffer" src="/assets/models/polys/Logo_Futurewei.glb"></a-asset-item>
<a-asset-item id="powersimple" response-type="arraybuffer" src="/assets/models/polys/Logo_Powersimple.glb"></a-asset-item>
<a-asset-item id="metavrse" response-type="arraybuffer" src="/assets/models/polys/Logo_MetaVRse.glb"></a-asset-item>
<a-asset-item id="point-cloud" response-type="arraybuffer" src="/assets/models/polys/a-point-cloud-production.glb"></a-asset-item>