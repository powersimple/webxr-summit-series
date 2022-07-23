<a-entity id="town-hall-wrap" visible="true" position=".3 -2.5 -12" rotation="0 0 0" scale="1 1 1" class="">


    <a-entity id="model-<?=$slug?>" class="clickable center-obj-zone" static-body 
        position="0 4 0" mixin="obj" rotation="0 0 0" scale="10 10 10" gltf-model="#edtownhall">
        
        </a-entity>
        <a-entity id="date-town-hall" troika-text='value:Thursday, July 14th; color:#f5f5f5; align:center; color:#fff; fontSize:.3;align:center;maxWidth:8;font:/wp-content/themes/webxrsummits/fonts/AGENCYB.ttf'
position="0 3.5 0"
            material="shader: standard; metalness: 0.8;"
            ></a-entity>
        
            <a-entity id="chair-wrap" visible="true" position="-3.2 0 0.265" rotation="0 0 0" scale="1 1 1" class="">
            <?php
        $start = 1;
  while($start<=3){
        ?>
<?php
    $counter=1;
    $x=-54;
    $z=.6;
   while($counter<=30){
    


   
?>
            <a-entity id="model-chair" class="clickable center-obj-zone" static-body 
        position="<?=$x?> -.5 <?=$z?>" mixin="obj" rotation="0 180 0" scale=".5 .5. .5" gltf-model="#chair"></a-entity>
<?php
    $i = $x/2;


    if($i==intval($i)){
        $x=.2;    
        $z=$z-.2;
    } else{
        $x=$x+.2;

    }
    $counter++;


    }
    $z=$z-.2;
    $x=-3.2;
    $start++;
    }
    
?>
</a-entity>
</a-entity>