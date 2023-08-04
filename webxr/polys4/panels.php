
    <?php
   


   $panel_z = 0;

   foreach($panels as $key=>$panel){
       extract($panel);
     
      print "<!-- $coords -->";
    
       $coords=explode(" ",$coords);
      
       $title = str_replace("2021 – ","",$title);

?>


<?php
               $trophy_offset = "0.008 4.367 -1.009";
             
               $card_title = "";

               $z_offset=2;
               
               $levels =[
                   "level1"=>0,
                   "level2"=>0,
                   "level3"=>0,
                   
               ]
       
           
           
           ?>


<!--<?=$panel['slug']?>-->
   


                <?php

                foreach($panels as $key => $panel_group){
                    extract($panel_group);
                   getEventPanel($panel_group,0);// last arg = don't recurse
                    foreach($children as $key=>$panel){
                       getEventPanel($panel,1);
                    }


             //      var_dump($panel);
                  //  


                }



                ?>



<?php




$panel_z = ($panel_z-$z_offset);

}

?>


<script>


AFRAME.registerComponent("item-grab", {
init: function () {
   sceneEl = document.querySelector('a-scene');
   var grabtrig = function (grabitem, grabinfo, grabtable, grabholo, grabproj, grabmodel, 
       cgrabrotate = "0 0 0", 
   grabscale = "5 5 5", grabposition = "0 1 0") {
         //  console.log("grab",grabitem, grabinfo, grabtable, grabholo, grabproj, grabmodel, grabrotate = "0 0 0", grabscale = "5 5 5", grabposition = "0 1 0")

       document.getElementById(grabitem).addEventListener("grab-start", function (evt) {
           if (document.getElementById(grabinfo).getAttribute('visible') == true) {
               for (let each of sceneEl.querySelectorAll(grabtable)) { // Turn off everything
                   each.object3D.visible = false;
               }
        //       document.getElementById(grabproj).object3D.visible = false;
              //document.getElementById(grabholo).object3D.visible = false;
           } else {
               for (let each of sceneEl.querySelectorAll(grabtable)) {
                   each.object3D.visible = false;
               }
//                    document.getElementById(grabproj).object3D.visible = true;
               document.getElementById(grabinfo).object3D.visible = true;
               /*document.getElementById(grabholo).object3D.visible = true;
               document.getElementById(grabholo).setAttribute("full-gltf-model", grabmodel);
               document.getElementById(grabholo).setAttribute("rotation", grabrotate);
               document.getElementById(grabholo).setAttribute("scale", grabscale);
               document.getElementById(grabholo).setAttribute("position", grabposition);*/
           }
       })
      
   }
<?php
/*
   foreach($panels as $key=>$panel){
       extract($panel);
       ?>
   grabtrig("<?=$panel['slug']?>-grab", "<?=$panel['slug']?>-title", ".art-text", "holoartifact", "holoartproj", "models/emblem.glb", undefined, "2 2 2", undefined)
   <?php
   


   foreach($nominees as $n => $nomination){

       if($laurel_id = @$nomination['meta']['laurel']){
       $laurel =getGLB($laurel_id);          
       ?>
   
   //    grabtrig("<?=$nomination['slug']?>-grab", "<?=$nomination['slug']?>-title", ".art-text", "holoartifact", "holoartproj", "models/emblem.glb", undefined, "2 2 2", undefined)
       <?php
       } 
   }









   
   }*/
?>

}
})

</script>