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
    $class = 'col-sm-offset-4 col-sm-7 laurel';
    if($count == 2){
      $class = 'col-sm-6 laurel';
    } else if ($count == 3){
      $class = 'col-sm-4 laurel';

    } else if ($count == 4){
      $class = 'col-sm-4 laurel';

    } else if ($count == 5){
      $class = 'col-sm-4 laurel';

    } else if ($count == 6){
      $class = 'col-sm-4 laurel';

    } else if ($count == 7){
      $class = 'col-sm-3 laurel';

    }


    for($i=0;$i<$count;$i++){
      print "<div class='$class'>";
  $src = getThumbnail($laurels[$i]);
    print "<img class='style-svg' src='$src' alt='Laurel $label'>";
    print "</div>";
//    break;
  }
  
}
}


function getNomineeCard($awards){



}
function getNomineeCards($awards){
  $nominations = [];
    print "<div id='cards'>";

    foreach($awards as $i =>$award){
        extract($award);
        $current_award = $slug;
        if(!in_array("nomination",explode(" ",$classes[0]))){
            continue;
          }

          foreach($nominees as $c => $nominee){
            print "<div class='nominee-card'>";
              print "<h2>Congratulations to<br>$nominee[title]!</h2>";
              $count = count($nominee['meta']['laurel']);
              $noms = "on your Poly nomination";
              if($count>1){
                $noms = "on your $count Poly nominations";

              }
              print "<h3>$noms</h3>";
          print "<div class='row laurels'>";
          //  var_dump($nominee['meta']);
          
            get2DLaurels(@$nominee['meta']['laurel'],$nominee['title']);
              getNomineeCard($nominee);
              print "</div>";

            //  get3DLaurel(@$nominee['meta']['laurel'][0],@$nominee['meta']['3Dlaurel'][0],$nominee['title']);

            print "<div class='hosts'>
            <table>
            <tr>
            <td class='host julie'>
            <span class='by'>Hosted by</span>
            <span class='hostname'>Julie Smithson</span>
            <!--<span class='hostsocial'>@juliesmithso</span>-->
            </td>
            <td class='julie-sophia'></td>
            <td class='host sophia'>
            <span class='by'>Virtual Red Carpet with</span>
            <span class='hostname'>Sophia Moshasha</span>
            <!--<span class='hostsocial'>@SophiaMosh</span>-->
            
            </td>
            </tr>
          </table>
          </div>";

          print"<div class='showtime'>
              <span class='showbrand'>
              <span class='thepolys'>The<sup>2nd</sup>Polys</span><span class='webxrawards'> - WebXR Awards</span>
              </span>
              Saturday, February 12, 2022<BR>11am PST | 2pm EST | 7pm UTC
          </div>
          ";
              


            print"<div class='social'>
            <span class='watch-parties'>See the show in our community watch parties across the Metaverse</span>
            thepolys.com<br>
            bit.ly/polys2tix<br>
            @webxrawards<br>
            #polys2<br>
            </div>";




              $current_nomination = $nominee['slug'];
                print"<div class='nominee-card-credits'>";
                $name = @$nominee['title'];
                $twitter = @$nominee['meta']['twitter'][0];
                $at = str_replace("https://twitter.com/","@",$twitter);
                $resource_url = @$nominee['meta']['resource_url'][0];
                $website = trim(@$nominee['meta']['website'][0]);
                
                print "<li>";
                print $name;
                print " <a href='$twitter' target='_blank'>$at</a><br>";
                if($nominee['post']->post_type == 'resource' && @$resource_url != ''){
                  print "<a href='$resource_url' target='_blank'>$resource_url</a>";
                } else if ($nominee['post']->post_type == 'profile' && @$website != ''){
                  $website = str_replace('https://',"//",$website);
                  $website = str_replace("http://","//",$website);
                  $website = str_replace("www.","",$website);

                  if(strlen($website)<25){
                    print "<a href='$website' class='site-link' target='_blank'>$website</a>";

                  }
                }

                $nominations = getNomineeCredits(@$nominee,$nominations,$current_award,$current_nomination);
                print "</div>"; //card credits


            print "</div>";//card
              
            print "<div class='nominee-coms'>




            
            </div>";






          }
          


          
    }
  

    print "</div>";


}


function getNomineeCredits($nominee,$nominations,$current_award,$current_nomination){

  if(count(@$nominee['children'])){
    
      print "<ul>";
      




      foreach($nominee['children'] as $n => $child){
    
        $id = $child['post']->ID;
          $type=$child['post']->post_type;
          if($type == 'profile' || $type == 'resource'){
              if(!is_array(@$nominations[$child['slug']])){
                  $nominations[$child['slug']] = ["nominations"=>[],"nominee"=>[
                      "name"=>$child['title'],
                      "email"=>@$child['meta']['email'][0],
                      "website"=>@$child['meta']['website'][0],
                      "resource_url"=>@$child['meta']['resource_url'][0],
                      "_thumbnail_id"=>@$child['meta']['_thumbnail_id'][0],
                  ]];
                
               }
               array_push($nominations[$child['slug']]["nominations"],$current_award);
         
          
       //           array_push($nominations[$current_nomination],$nominee);
          }


          print "<li>";
         
        //  print "<a href='/wp-admin/post.php?post=$id&action=edit' target='_blank'></a>";
          print $child['title'];

      //    print " | ". @$type. " | ";


          // $child[slug]
         // var_dump($child['meta']);
         
        


         //getMetaLink($child['meta'],'email');

         getMetaLink($child['meta'],'twitter');
//         getMetaLink($child['meta'],'website');
          print "</li>";
          $nominations = getNomineeCredits(@$child,$nominations,$current_award,$current_nomination);
      }
      print "</ul>";

  }
  return $nominations;

}



  print do_blocks(do_shortcode($post->post_content));
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>