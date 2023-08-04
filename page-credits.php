<?php
    get_header();
    
    require_once "functions/functions-awards.php";
      $pedestals = get_pedestals('polys3');
    //    var_dump($pedestals);
      $assets = [];
     

   if(@$_GET['dump'] == 'awards'){
     
?>

<div id="dump" style="position:absolute;top:0px; height:100vh;width:20%;background-color:rgba(10,10,10,0.4);color:#fff;z-index:100;overflow-y:scroll;">
    <?php 
    

    
    
    
    ?>
   </div>
<?php
}
$menu = 'virtual-red-carpet-3';
if(@$_GET['menu']){



}



$menu = get_menu_array($menu);
var_dump($menu);
function dump_menu_children($children){
 
  if(count($children)){
    foreach($children as $key =>$child){
      extract($children);
      print $post_title;
      print "<BR>";
     // array_push($credit['children'],getCreditMenuItem($child));
        
      }
  }

}


function dump_menu($menu){
 
print_r(@$menu);
  dump_menu_children(@$menu['children']);
  die();
}

//dump_menu($menu);


$credits = getCreditsArray($menu);
$credits_menu = getCreditsMenu($menu);
//credits_list_dump($credits_menu);die();

//var_dump($credits_menu); 

$assets3D = get3DAssets("logo3D_src",$credits);
$asset_list = getAssetList($assets3D);
//print("<pre>".print_r($credits,true)."</pre>"); die();
//print("<pre>".print_r($asset_list,true)."</pre>");die();
 //  include "webxr/polys3/drawer-experiences.php";
 //   include "webxr/polys2/drawer-nominations.php";





?>

   

<a-scene  renderer="antialias: true;
                   colorManagement: true;
                   sortObjects: true;
                   maxCanvasWidth: 5600;
                   maxCanvasHeight: 2750;"" gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link anti-drop
    device-orientation-permission-ui physics="iterations: 30;"
    inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
    loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 0;maxCanvasWidth:5600;
                   maxCanvasHeight: 3200;"
    background="color: #000000">

    <a-assets timeout="80000">
        <!-- Loads assets -->
        <?php
            include "webxr/polys3/assets.php";
            include "webxr/polys3/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 1200000; loop: true;"></a-sky>

    <?php
            include "webxr/polys3/credits-rigging.php";
            //include "webxr/polys3/lights.php";
    $showplatform="true";        
    if(@$_GET['showplatform']){
        $showplatform = "false";
     
    }


$z_offset = 15;
if(@$_GET['z_offset']){
  $z_offset = $_GET['z_offset'];
}

?>
<a-entity id="trophy-wrap" class="clickable center-obj-zone" static-body="shape: box; mass: 2" position="0 -225 -400" >


    <a-entity id="trophy-model" class="center-obj-zone" static-body
                gltf-model="/assets/models/polys/4th/2023-Award200.glb" class="collision" visible="true"
                position="0 0 0" mixin="obj" rotation="0 90 0" scale="1 1 1" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"></a-entity>
        
        </a-entity>
        <a-light id="trophy-light-front" color="#ffffff" position="0 -5.07707 -304.04045" rotation="" light="type: spot; intensity: 20; angle: 90; distance: 500; shadowRadius: -3.72" visible=""></a-light>
       
        <a-light light="type: spot; intensity: 20; angle: 90; distance: 500; shadowRadius: -3.72" position="217.71962 -54.48486 -285.73576" visible=""></a-light>
        <a-light color="#fff000"  position="0 250 -275" rotation="0 0 0"  light="type: spot; intensity: 20; angle: 90; distance:500; shadowRadius: -3.72" visible=""></a-light>
        <a-light color="#fff000" position="0 -127.00302 -331.17228" rotation="" light="type: spot; intensity: 22.1; angle: 90; distance: 500; shadowRadius: -3.72" visible=""></a-light>
<a-entity id="outer-wrap" position="0.05 3.5
 564" rotation="0 0 0" scale="1 1 1" visible="true">
    <a-entity id="credits-wrap" visible="true" scale="2 2 2" position="0 -2 0"  rotation="0 0 0">
<?php
 
        $z_offset = 0;
        foreach($credits as $key => $credit){
           
             getCredit($credit,$z_offset,0);
          
            $z_offset = ($z_offset-(15*-1));
        }
    


?>

</a-entity><!-- credits-->












</a-scene>
<script>
AFRAME.registerComponent('qz-keyboard-controls', {
  // ...

  getVelocityDelta: function () {
    var data = this.data,
        keys = this.getKeys();

    this.dVelocity.set(0, 0, 0);
    if (data.enabled) {
      if (keys.KeyW || keys.ArrowUp)    { this.dVelocity.z -= 1; }
      if (keys.KeyA || keys.ArrowLeft)  { this.dVelocity.x -= 1; }
      if (keys.KeyS || keys.ArrowDown)  { this.dVelocity.z += 1; }
      if (keys.KeyD || keys.ArrowRight) { this.dVelocity.x += 1; }

      // NEW STUFF HERE
      if (keys.KeyQ)  { this.dVelocity.y += 1; }
      if (keys.KeyZ) { this.dVelocity.y -= 1; }
    }

    return this.dVelocity.clone();
  },

  // ...
});
</script>
<?php
     get_footer();
?>`