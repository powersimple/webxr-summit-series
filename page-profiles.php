<?php

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


<main role="main" class="main <?=$section_class?>">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">


<?php
  $event_meta = [];
  $awards = array_merge(get_menu_array('virtual-red-carpet-4'),get_menu_array('polys4'));

  foreach($awards as $key => $award){// outer menu loop
    
    foreach($award['children'] as $c =>$child){// EVENTS loop
      $event_meta = get_event_meta($child,$child['children'],0,$event_meta); 


    }
}

  $profiles = getProfiles();

  $profile_array = [];
  foreach($profiles as $p => $profile){
    
    $email = get_post_meta($profile->ID,"email",true);
    $is_company = get_post_meta($profile->ID,"is_company",true);
    $profile_title = get_post_meta($profile->ID,"profile_title",true);
    $company = get_post_meta($profile->ID,"company",true);
  
    if(!@$is_company){ 
      $profile_array[$profile->post_name] = [

        "id"=>$profile->ID,
        "name"=>$profile->post_title,
        "email"=>$email,
        "company"=>$company,
        "profile_title"=>$profile_title,
        "is_company",$is_company
      ];
    }
    // print "$profile->ID|$profile->post_title|$profile->post_name|$email<BR>";
  
  }




function get_event_data($event_meta){

  $event_data = [
    "unique_guest" => $event_meta,
    "event_type" => [],
    "appearance_type" =>[],
    "confirmation_status" =>[],
    "guest_type" =>[],
    
    

  ];




  //var_dump($nominee_meta);
  foreach($event_meta as $m =>$guest){// this 
    extract($guest[0]);
  
    if(!@$is_company){
    //  print "$name";
    //print "|$email";
    $event_info=[
      "name"=>$name,
      "email"=>$email,
      "profile_title"=>$profile_title,
      "company"=>$company,
      
      "appearances"=>[],
    ];

   
    
  // print "|$guest_type";

  
    print "<ol>";
  foreach($guest as $a => $event){ // lopos avent appearence

    $event_type = ucwords(str_replace('-'," ",$guest[$a]['event_type']));
/*
    print "<li>".$event['event_title'];
      print "|".$event_type;
      print "|".$guest[$a]['guest_type'];
      print "|".$guest[$a]['appearance_type'];
      print "|".$guest[$a]['confirmation_status'];
      print "</li>";
  */  
      array_push($event_info['appearances'],[
        "event_title"=>$event['event_title'],
        "event_type"=>$event_type,
        "confirmation_status"=>$guest[$a]['confirmation_status'],
        "guest_type"=>$guest[$a]['guest_type']

      ]);

    }
    $event_data = handle_event_array($event_data,$m,$event_info,"appearance_type",$guest[$a]['appearance_type']);
    $event_data = handle_event_array($event_data,$m,$event_info,"guest_type",$guest[$a]['guest_type']);
    $event_data = handle_event_array($event_data,$m,$event_info,"confirmation_status",$guest[$a]['confirmation_status']);
    
    
    extract($guest);
    print "</ol>";


  }

  }
  return $event_data;
}

function handle_event_array($event_data,$slug,$event_info,$field,$value){

    $status = $event_data[$field];

    if(is_array($status)){
      
      if(!array_key_exists($value,$status)){
        if($field != ''){
          $event_data[$field][$value] = [];
        }
      }
      $event_data[$field][$value][$slug] = $event_info;  
      
    }

  return $event_data;

}
function get_profile_array(){
  $profiles = getProfiles();
  $profile_array = [];
  foreach($profiles as $p => $profile){
    
    $email = get_post_meta($profile->ID,"email",true);
    $is_company = get_post_meta($profile->ID,"is_company",true);
    $profile_title = get_post_meta($profile->ID,"profile_title",true);
    $company = get_post_meta($profile->ID,"company",true);
    if(!@$is_company && $email!=''){ }
      $profile_array[$profile->post_name] = [
        "id"=>$profile->ID,
        "name"=>$profile->post_title,
        "email"=>$email,
        "is_company",$is_company,
        "profile_title"=>$profile_title,
      "company"=>$company,
      
      ];
    // print "$profile->ID|$profile->post_title|$profile->post_name|$email<BR>";
  
  }
  return $profile_array;
}

$event_data = get_event_data($event_meta);

if(@$_GET['polys'] == 4){
$vips = display_event_data($event_data);
displayVIPList($vips);
}

function displayVIPList($vips){
  print "<strong>VIP ZOOM</strong><BR>";
  foreach($vips as $key=>$vip){
    if(@$vip['is_company']){
      continue;
    }

    $profile_title = get_post_meta($vip['id'],"profile_title",true);
    $company = get_post_meta($vip['id'],"company",true);
    if($vip['email'] != ''){
      if(@$_GET['email'] != ''){
        print $vip['name']." ";
      
        print "&lt;".$vip['email']."&gt;,";
                          
      } else {
        print $vip['name'];
        if($vip['profile_title'] != ''){
          print ", ". $vip['profile_title'];

        }
        if($vip['company'] != ''){
          print ", ". $vip['company'];

        }
        
      }
      print "<BR>";
    }
  }
}
  
function display_event_data($event_data){
  $profile_array = get_profile_array();
  // /  print("<pre>".print_r($results,true)."</pre>");

  $fields = [];
  foreach($event_data as $field=>$value){

    array_push($fields,$field);

  }

  
    foreach($event_data as $field=>$data){
      
      
       
          print "<strong>".ucwords(str_replace("_"," ",$field))."</strong><BR>";
          //print "$field|<BR>";
        
      
          foreach($data as $k=>$list){
            if(@$list[0]['is_company'] == 1){
            //  print "UNSET ".ucwords(str_replace("_"," ",$k));
          
              unset($profile_array[$k]);
              continue;

            } 

            
            print "<strong>".ucwords(str_replace("-"," ",$k))."</strong><BR>";
            //print "|".@$data['is_company']."";
            print "<BR>";
            //  print("|<pre>".print_r($data,true)."</pre>|");
          
            
                  print "<ol>";
                
                  foreach($list as $key=>$value){
                  //var_dump($value['is_company']==NULL);
                
                      // print("|<pre>".print_r($value,true)."</pre>|");
                      print "<li>";
                      if($field != "unique_guest"){
                        
                          print $value['name'];
                      
                          if(@$_GET['emails']==1){
                            print "&lt;".$value['email']."&gt;,";
                          }
                      

                      } else {


                        
                        

                      
                      // print("<pre>".print_r($value,true)."</pre>");
                        print $value['event_title'];
                       
                        if(@$_GET['status']){
                        foreach($fields as $key=>$field_key){
                          if($key!=$field){
                            print "|";
                            print  ucwords(str_replace("-"," ",$value[$field_key]));

                          } else {
                          // print "$key";
  
                          }
                
                          }
                        } 
                      }
                    unset($profile_array[$k]);

                      print "</li>";
                    
                    
                  }
                  print "</ol>";
                
                
              
              print "<hR>";
            }

          
       

      
    

  }
  return $profile_array;

}


  print do_blocks(do_shortcode($post->post_content));

?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>