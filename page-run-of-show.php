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

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">

  <?php 
   
  $vrc = 'virtual-red-carpet-4';
  $ceremony = 'polys4';

    if(@$_GET['vrc']){
      $vrc = $_GET['vrc'];
    }
    if(@$_GET['ceremony']){
      $ceremony = $_GET['ceremony'];
    }

   print "<hr><div>";

    $vrc = get_menu_array($vrc);
    $ceremony = get_menu_array($ceremony);
    $awards = array_merge($vrc,$ceremony);

    $results = [];
    $results['people'] = [];
    $offset = -5;
    if(@$_GET['offset']){
        $offset = $_GET['offset'];
    }
    
print "<table class='ros-table'>";
   foreach($awards as $key => $award){// outer menu loop
    $counter=0;
    $start = intval($award['meta']['utc_start'][0]);
    $start = $start-(($offset*3600)*-1);// corrects timezone to minute hours

      print "<tr><td class='$award[slug]'>";// single cell table 100%;
        print "<table class='event-table'><tr>"; 
        print "<td>";
        print $award['title'];
        print "</td>";
        print "<td>";
        print date("g:i a",$start);
        print "</td></tr></table>";
      print "</td></tr>";

      print "<tr><td class='$award[slug]'><table class='ros-sessions'>"; 

    
      $event = [
        "name"=>$award['title'],
        "slug"=>$award['post']->slug
      ];
    

   
        $results = rosListings($award['children'],$results,$event,$start,$counter);
      
    //  print $award['post']->ID;
    // print $award['meta']['utc_start'][0];
    
       print "</table></td></tr>";
   }
   print "</table>";
//   var_dump($results);
//print("<pre>".print_r($results,true)."</pre>");
   print "</div>";

function getSessionDetail($child,$counter){
    extract($child);
    print "<table>";
    print "<tr><td>";
    $list_class = '';
    $post_type = $post->post_type;
    if(@$_GET['headshot']==1){
    if(@$meta['_thumbnail_id'][0]){
      $src=getThumbnail(@$meta['_thumbnail_id'][0],"thumbnail"); 
       print "<img src='$src'>";
       print "</td><td>";
     }
    }
    

    if(@$classes[0] == 'presenter'){
      print "Presented by ";
      $list_class = '';
    } else {
      if($counter == 1 ){
      //  print "Nominee: ";
      } else if($counter == 2) {

      //  print "· ";
      } else if($counter == 3){
       // print "·· ";
      }
    }
  print "</td><td>";
    switch(@$_GET['mode']){

      case "contact":

        
        if($post_type == 'profile'){
        if(@$meta['email'][0] != ''){
          print $child['title'];
         print "&lt;".@$meta['email'][0]."&gt;,";
        }
      } else {
        print $child['title'];
      }
        break;
    
      

      default: '';
    }



  print "</td></tr>";
  print "</table>";

  
  
}

function rosListings($children,$results,$event,$start,$counter){
  foreach($children as $c =>$child){// EVENTS loop
    extract($child);
    if($child['classes'][0] == 'nomination' || $child['classes'][0] == 'honor'){     }
     
    
      if($counter == 0){// THIS IS THE EVENT LEVEL with htimes.

       
       
      } 
      if($counter == 0){
        $event = [
          "name"=>$title,
          "slug"=>$post->slug
        ];



        $length = @$child['event_length_seconds'];
        if($length>0){
          print "<tr class='session-container'><th>&nbsp;</th><th>Mins</th><th>End Time</th>";
        print "<tr class='session-title'><td>";
        //print $counter; 
        print $child['title'];
  
        print "</td>";
          print "<td>";
          if($length != ''){
            $start+=intval(trim($length));
          }
          print intval($length)/60;

          print "</td><td>";
            print     date("g:i a",$start);
          print "</td>";
          print "</tr>";
        }
      } else{
        if($child['post']->post_type == 'profile'){
            
          //$results = getInvitationResults($child,$event,$results['people']);
         
        }
      


        print "<tr><td colspan='3'>";

        print "<table class='session-detail'><tr><td>";

        getSessionDetail($child,$counter);


       



        print "</td></tr></table></td></tr>";
      }
      if(@$_GET['detail']){
      if(count(@$children)){
          $counter++;
          $results = rosListings($children,$results,$event,$start,$counter);
          $counter--;
      }
    }
    
    
   
    }
    return $results;

}

function getInvitationResults($child,$event,$results){
  extract($child);
 $slug = $post->post_name;
 $people = $results['people'];
  if(!in_array($slug,$people)){

  
    $people[$slug] = [
      "name"=>$title,
      "email"=>@$meta['email'][0]

    ];
  }
    $people_slug = $people[$slug];
    if(!in_array('events',$results['people'][$slug])){
      $results['people'][$slug]['events']=[];
      
    }
    array_push($results['people'][$slug]['events'],$event);
  
  
  return $results;

}

//nomineeOutreach($awards['children']);
print "<BR><HR><BR>";


  print do_blocks(do_shortcode($post->post_content));
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>