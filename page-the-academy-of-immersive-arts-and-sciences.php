<?php
    get_header();
    
    require_once "functions/functions-awards.php";
      $pedestals = get_pedestals('polys4');
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
$menu = 'polys4-credits';
if(@$_GET['menu']){
  $menu = @$_GET['menu'];


}



$menu = get_menu_array($menu);
//var_dump($menu);
function dump_menu_children($children){
 
  if(count($children)){
    foreach($children as $key =>$child){

      extract($children);
      print $post_title;
      print "<BR>";
      array_push($credit['children'],getCreditMenuItem($child));
        
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
//credits_list_dump($credits_menu);
//die();

//var_dump($credits_menu); 

$assets3D = get3DAssets("logo3D_src",$credits);
$asset_list = getAssetList($assets3D);
//print("<pre>".print_r($credits,true)."</pre>"); die();
//print("<pre>".print_r($asset_list,true)."</pre>");die();
 //  include "webxr/polys4/drawer-experiences.php";
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
            include "webxr/polys4/assets.php";
            include "webxr/polys4/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 1200000; loop: true;"></a-sky>

    <?php
            include "webxr/polys4/credits-rigging.php";
            //include "webxr/polys4/lights.php";
    $showplatform="true";        
    if(@$_GET['showplatform']){
        $showplatform = "false";
     
    }

$z_start = 600;
if(@$_GET['z_start']){
  $z_start = $_GET['z_start'];
  $trophy_offset = $z_start+280;
 
}
$z_offset = 10;
if(@$_GET['z_offset']){
  $z_offset = $_GET['z_offset'];
  
}

?><!--
<a-entity id="trophy-wrap" class="clickable center-obj-zone" static-body="shape: box; mass: 2" position="0 -225 -400" >


    <a-entity id="trophy-model" class="center-obj-zone" static-body
                gltf-model="/assets/models/polys/4th/2023-Award200.glb" class="collision" visible="true"
                position="0 0 0" mixin="obj" rotation="0 90 0" scale="1 1 1" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"></a-entity>
        
        </a-entity>
       -->
       

       
<a-entity id="outer-wrap" position="0.05 3.5
 <?=@$z_start?>" rotation="0 0 0" scale="1 1 1" visible="true">
    <a-entity id="credits-wrap" visible="true" scale="2 2 2" position="0 -2 0"  rotation="0 0 0">
<?php
 
        $z_offset = 0;
        foreach($credits as $key => $credit){
           
             getCredit($credit,$z_offset,0);
          
            $z_offset = ($z_offset-(15*-1));
        }
    


?>

</a-entity><!-- credits-->


<a-entity id="trophy-rotation" class="center-obj-zone" 
                visible="true"
                scale="1 1 1"
                position="0 -75 -1000"
                rotation="0 0 0" 
                
               >

        <a-entity id="trophy-model" class="center-obj-zone" 
                gltf-model="#trophy"  visible="true"
                scale="80 80 80"
                position="0 0 0"
                rotation="0 60 0" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 96000; loop: true;"
           > </a-entity>
           <a-light light="type: spot; intensity: 48.91; angle: 91.11; distance: 502.65; shadowRadius: -3.72; color: #FF000" position="8.87229 289.25449 227.15971" visible="" rotation="0 -31.24 0"></a-light>
           <a-light color="#fff000" position="-72.17933 54.80446 105.50831" rotation="0 -13.56 0" light="type: spot; intensity: 40; angle: 90; distance: 500; shadowRadius: -3.72" visible=""></a-light>
           <a-light color="#fff000" position="240.79411 183.07199 29.71258" rotation="-7.8 41 0" light="type: spot; intensity: 30; angle: 60.2; distance: 500; shadowRadius: -3.72" visible=""></a-light>
           <a-light color="#fff000" position="-63.20265 222.31287 80.0975" rotation="-6.79 -33.59 0" light="type: spot; intensity: 10; angle: 60.2; distance: 500; shadowRadius: -3.72" visible=""></a-light>
        </a-entity>







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