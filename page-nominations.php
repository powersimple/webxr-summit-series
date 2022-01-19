<?php
function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}
get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
print $default_video_url = get_post_meta($post->ID,"embed_video_url",true);

if($hero=get_post_meta($post->ID,'hero',true)){
   $hero_image = getThumbnail($hero);
   /*
if($post->post_parent==0){

    print "<div id='section-heading'>";
    $parent_post = get_post($post->post_parent);
    $parent_post_title = $parent_post->post_title;
    echo $parent_post_title;
    print "</div>";
}
*/
?>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<?php
}

?>

<div class="title-bar">
    <h1 class="title"><?=$post->post_title?></h1>
    <?php
    if(@$post->post_excerpt){
    ?>
    <h2 class="featuring">
        <?=$post->post_excerpt?></h1>
    
    <?php
    }
 
    ?>
</div>


<main  role="main" class="main <?=$section_class?>">
<?php $awards = get_nominations('polys2');
getNomineeCards($awards);?>
  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">


<?php
function get3DLaurel($laurel_2d_id,$laurel_3d_id,$label){
 
  $src_2d = getThumbnail($laurel_2d_id);
  $src_3d = get_attachment( $laurel_3d_id);

 
  print "

  <model-viewer bounds='tight' src='$src_3d' ar ar-modes='webxr scene-viewer quick-look' camera-controls environment-image='neutral' poster='$src_2d' shadow-intensity='1'>

    <div class='progress-bar hide' slot='progress-bar'>
        <div class='update-bar'></div>
    </div>
    <button slot='ar-button' id='ar-button'>
        View in your space
    </button>
    <div id='ar-prompt'>
        <img src='https://modelviewer.dev/shared-assets/icons/hand.png'>
    </div>
</model-viewer>

"; 
}


function get2DLaurels($laurels,$label){
  if($laurels){
    $count = count($laurels);
    $class = 'col-12';
    if($count == 2){
      $class = 'col-6';
    }


    for($i=0;$i<$count;$i++){
      print "<div class='$class'>";
  $src = getThumbnail($laurels[$i]);
    print "<img class='style-svg' src='$src' alt='Laurel $label'>";
    print "</div>";
    break;
  }
  
}
}


function getNomineeCard($awards){



}
function getNomineeCards($awards){

    print "<div id='cards'>";

    foreach($awards as $i =>$award){
        extract($award);
        if(!in_array("nomination",explode(" ",$classes[0]))){
            continue;
          }

          foreach($nominees as $c => $nominee){
            print "<div class='nominee-card'>";
         //   print "<h2>$award[title]</h2>";
         print "<div class='row'>";
         //  var_dump($nominee['meta']);
         
           get2DLaurels(@$nominee['meta']['laurel'],$nominee['title']);
            getNomineeCard($nominee);
            print "</div>";

          //  get3DLaurel(@$nominee['meta']['laurel'][0],@$nominee['meta']['3Dlaurel'][0],$nominee['title']);

          print "<table class='hosts'>
          <tr>
          <td class='host julie'>
          <span class='by'>Hosted by</span>
          <span class='hostname'>Julie Smithson</span>
          </td>
          <td class='host sophia'>
          <span class='by'>Virtual Red Carpet with</span>
          <span class='hostname'>Sophia Moshasha</span>
          </td>
          </tr>
        </table>";

        print"<div class='showtime'>
            Saturday, February 12, 2022<BR>11am PST | 2pm EST | 7pm UTC
        </div>
        ";
            


          print"<div class='social'>
            @webxrawards<br>
            #polys2<br>
            thepolys.com<br>
            bit.ly/polys2tix<br>
            
            
          </div>";

            print "</div>";

          }
          


          
    }
  

    print "</div>";


}

  print do_blocks(do_shortcode($post->post_content));
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>