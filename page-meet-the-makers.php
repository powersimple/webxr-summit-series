`<?php
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
$menu = 'polys3-credits';
if(@$_GET['menu']){
  $menu = $_GET['menu'];

}


$menu = get_menu_array($menu);
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
            include "webxr/makers/assets.php";
            include "webxr/polys3/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 1200000; loop: true;"></a-sky>

    <?php
            include "webxr/makers/credits.php";

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











</a-scene>
<script>

<?php
     get_footer();
?>`