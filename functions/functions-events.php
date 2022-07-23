<?php

function getRoster($menu){
    
}


function getNominee($nominee,$nominations,$current_award,$current_nomination){

    if(count(@$nominee['children'])){
//     
        
        foreach($nominee['children'] as $n => $child){
            print "<tr>";
        //    var_dump($child);
            extract($child);
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
         
            $src = getThumbnail(get_post_thumbnail_id($child['post']->ID));
            print "<td>".@$class[0]."</td>";   
        print "<td>";
        if($src != ''){
        print "<img src='$src' alt='".$nominee['post']->post_title."'></td>";
    }
            print "<td>";
           
            print "<a href='/wp-admin/post.php?post=$id&action=edit' target='_blank'>$child[title]</a>";
            print "</td>";
        //    print " | ". @$type. " | ";


            // $child[slug]
           // var_dump($child['meta']);
           
          


           getMetaLink($child['meta'],'email','td');

           getMetaLink($child['meta'],'twitter','td');
           getMetaLink($child['meta'],'website','td');
           getMetaLink($child['meta'],'resource_url','td');
            print "<td>";
            
            print "</td>";
            print "</tr>";
            $nominations = getNominee(@$child,$nominations,$current_award,$current_nomination);
            
        }
//        print "</tr>";

    }
    return $nominations;

}
function statusBoolField($status,$field){
    print "<td>";
    if($status == null){
        print "$field: ⌛";
        return false;
    } else if($status[0]=="0") {
        print "$field:  ⌛";
        return false;

    } else {
        print "$field:  ✅";
        return true;
    }
    print "</td>";

}
function match_profilesFromTable($table){
    global $wpdb;
    $q= $wpdb->get_results("select * from $table");
    $meta_fields = "email,title,company,twitter,website,twitter,github,discord,blurb,resources";
    foreach($q as $key=>$value){
        extract((array) $value);
      
 //  $i = insertProfile($name,$bio,$parent);
     $ID= $wpdb->get_var("select ID from wp_posts where post_title LIKE '$value->name'");
     $content= $wpdb->get_var("select post_content from wp_posts where post_title LIKE '$value->name'");
     
     if($ID != NULL){
        
        $wpdb->query("update _profile_import set bio = '$content' where id = $id");
        /*
        var_dump($ID);
        print "$value->name<br>";
print        $twitter = get_post_meta($ID,"twitter",true);
print        $linkedin = get_post_meta($ID,"linkedin",true);
print        $discord = get_post_meta($ID,"discord",true);
print        $github = get_post_meta($ID,"github",true);

$wpdb->query("update _profile_import set post_id = $ID where id = $id");
$wpdb->query("update _profile_import set twitter = '$twitter' where id = $id");
$wpdb->query("update _profile_import set linkedin = '$linkedin' where id = $id");
$wpdb->query("update _profile_import set github = '$linkedin' where id = $id");
$wpdb->query("update _profile_import set discord = '$discord' where id = $id");

*/


print "<BR>";

       }
        foreach(explode(",",$meta_fields) as $k => $f){
       //  print $value->$f;
            //  add_post_meta($i,$f,$value->$f);

        }


    }
}

function getRunOfShowAccordion($ros){
    
    $nominations = [];
    $nominees = [];
    $nominee_list = [];
    $award_list = [];
    $counter = 0;
    
    foreach($ros as $i =>$item){ // outer loop.
        extract($item);
    

        $current_award = $slug;
        $awards_list[$current_award] = $item['title'];
        
        if(!in_array("nomination",explode(" ",$classes[0]))){
           // continue;
          }
         // var_dump($duration = @$item['meta']);
         if( $duration = @$item['meta']['duration'][0]){
          
         } else {
             $duration = 210;
          }
          $length = gmdate("i:s", $duration);
          $start = @$meta['utc_start'][0];
           
          if($start != '' && $start != 0){
            $start_date_time = date("m-d h:ia",$start);  
            $current_time = $start;
          }  else {

          
            $start_date_time = date("h:ia",$current_time);
          }
          @$current_time = $current_time + $duration;
          
          $the_time = date("H:m",$current_time);

        print "<h3><span class='ros-event'>".showCounter($counter)." | $title </span><span class='ros-time'>$start_date_time | $length</span></h3>";
        print "<div>"; 
    if(@$meta['show_journal'][0]){
        if(@$_GET['cues']){

       
        print "<div class='show-journal'>". @$meta['show_journal'][0]."</div>";
    }

    }

        

        
        if(is_array($nominees)){
        print "<table class='segment'>";
        foreach($nominees as $c => $nominee){
            extract($nominee);
            

            $class= explode(" ",$classes[0]);
            //var_dump($class);
            
           $current_nomination = $nominee['slug'];
          
           $id = $nominee['post']->ID;
           $type=$nominee['post']->post_type;
          $thumbnail = @$nominee['meta']['_thumbnail_id'][0];
       
    
           if($type == 'profile'|| $type == 'resource'){
        }
            if(!in_array($current_nomination,$nominations)){
            }
                $nominations[$current_nomination] = ["nominations"=>[],"nominee"=>[
                    "name"=>$nominee['title'],
                    "email"=>@$nominee['meta']['email'][0],
                    "website"=>@$nominee['meta']['website'][0],
                    "resource_url"=>@$nominee['meta']['resource_url'][0],
                    "_thumbnail_id"=>@$nominee['meta']['_thumbnail_id'][0],
                    
                    
                ]];
                
            
    
            array_push($nominations[$current_nomination]['nominations'],$current_award . " ". $current_nomination);
    
          
            print "<tr><td colspan='9'><hr></td></tr>";
          
           print "<tr class='$classes[0]'>";
      
           if(in_array('presenter',$class)){
        
            }  

        $src = getThumbnail(get_post_thumbnail_id($nominee['post']->ID));

            print "<td class='designation'>".ucfirst($class[0])."</td>";   
        print "<td class='thumbnail'>";
        if($src){
        print "<img src='$src' alt='".$nominee['post']->post_title."'>";
    
        
        }
        print "</td>";
           print"<td class='name' ><a href='/wp-admin/post.php?post=$id&action=edit' target='_blank'>$nominee[title]</a></td>";
        //    print " | ". $type. " | ";
    

            getMetaLink($nominee['meta'],'email','td');
    
            getMetaLink($nominee['meta'],'twitter','td');
            getMetaLink($nominee['meta'],'website','td');
            getMetaLink($nominee['meta'],'linkedin','td');
            getMetaLink($nominee['meta'],'instagram','td');
            

            getMetaLink($nominee['meta'],'resource_url','td');
            
            print "</tr>";
           
            if(@$_GET['credential']){
                print "<tr><td>";
                print "<td colspan='9'>";
                print "<textarea cols='30' rows='5'>";
print $nominee['post']->post_title;
print "
";
                if(@$nominee['meta']['profile_title'][0]){
print $nominee['meta']['profile_title'][0].", ";
                }
                if(@$nominee['meta']['company'][0]){
print $nominee['meta']['company'][0];
                 }
                 
                 if(@$nominee['meta']['twitter'][0]){
print "
";
                    
print str_replace("https://twitter.com/","@",$nominee['meta']['twitter'][0]);
                 }
                 print "</textarea>";

 
              // var_dump($nominee['meta']);
                print "</td>";
                print "</td></tr>";

            }
    
    
           $nominations = getNominee(@$nominee,$nominations,$current_award,$current_nomination);
    
     
       
        }
    print "</table>";
    } else {//not an array of nominees

    }
   

        print"</div>";
        

        $counter++;

        }//run of show
}


//$ros = get_nominations('polys2');



function showCounter($counter){
    if($counter<10){
        return "0".$counter;
    }
    return $counter;
}

function getNominees(){

}




function insertEvent($post_title,$post_content,$post_excerpt,$post_parent){
        $table = "wp_posts";
       
        $new_post = array(
            
           
            'post_parent' => "$post_parent",
            'post_title' => "$post_title",
            'post_content' => "$post_content",
            'post_excerpt' => "$post_excerpt",
            
            'post_status' => 'publish',
            'post_type' => 'event',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        global $wpdb;
     
       // $wpdb->query($sql);

        return $new_post;
    }
    function insertProfile($post_title,$post_content,$parent){
        $table = "wp_posts";
       
        $new_post = array(
            
            'post_content' => "$post_content",
          
            'post_title' => "$post_title",
            'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'profile',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        
       // $wpdb->query($sql);

        return $new_post;
    }

    function get_eventsFromTable($parent){
        global $wpdb;
        $q= $wpdb->get_results("select * from _events where parent = parent limit 0,20");
    //   var_dump($q);
        foreach($q as $key=>$value){
            extract((array) $value);
            print "$value->name<br>";
       $i = insertEvent($value->name,$value->content,$value->content,$parent);

      
        }
    }

    function get_profilesFromTable($parent){
        global $wpdb;
        $q= $wpdb->get_results("select * from _profiles");
        $meta_fields = "email,title,company,twitter,website,twitter,github,discord,blurb,resources";
        foreach($q as $key=>$value){
            extract((array) $value);
            print "$value->name";
       $i = insertProfile($name,$bio,$parent);

            foreach(explode(",",$meta_fields) as $k => $f){
             print $value->$f;
                  add_post_meta($i,$f,$value->$f);
             
            }
 print "<BR>";
        }
    }

    function insertResource($post_title){
        $table = "wp_posts";
       
        $new_post = array(
            
  //          'post_content' => "$post_content",
          
            'post_title' => "$post_title",
//            'post_excerpt' => "$post_content",
            'post_status' => 'publish',
            'post_type' => 'resource',
        );
        $new_post = wp_insert_post( $new_post,$wp_error = false );
        
       // $wpdb->query($sql);

        return $new_post;
    }
    
    function get_resourcesFromTable(){
        global $wpdb;
        $q= $wpdb->get_results("select * from _resources");
      
        foreach($q as $key=>$value){
            extract((array) $value);
            print "$value->name<br>";
           $i = insertResource($name);
        }
           
    }





    function getChildList($parent,$post_type,$sort='menu_order'){
        global $wpdb;
        $q= $wpdb->get_results("select ID, post_title, post_name, post_content, post_excerpt from wp_posts where post_status='publish' and post_parent = '$parent' and post_type='$post_type' order by $sort");
        $children=[];
        foreach($q as $key=>$value){
            extract((array) $value);
            //print "$value->ID | $value->post_title<br>";
     //  $i = insertProfile($name,$bio,$parent);
         array_push($children,(array) $value);

    
        }
        return $children;
    }

    function getEventMeta($event){

        $event_meta = [];
        $event_meta['utc_start'] = get_post_meta($event['ID'],"utc_start",true);
        $event_meta['embed_video_url'] = get_post_meta($event['ID'],"embed_video_url",true);
        
        return $event_meta;
    }
    function getEventID($id){
        global $wpdb;
        $parent = $wpdb->get_row("select ID, post_parent from wp_posts where ID = $id");
    
        if($parent->post_parent == 0){
            return $parent->ID;
        } else {
        
           getEventID($parent->post_parent);
        }
    }
    function wrapSocial($service,$url){
        $mail="";
        if($service=="email"){
            $mail="mailto:";
            if($url = ''){
                return "Confirme, Registration pending.";
            }
        }
        if($url != ''){
        $link = " <a target='_new' href='".$mail."".$url."'>";
        
        switch ($service){
            case "twitter":  
                $link.="Twitter";
                break;
                case "linkedin":  
                    $link.="LinkedIn";
                    break;
                case "github":  
                    $link.="GitHub";
                    break;
                case "website":
                    $link.=$url;
                    break;
                case "email":
                    $link.=$url;
                    break;
        
                    
    
        }
        $link .= "</a> |";
        return $link;
        }
    }
    function showEmails(){
        global $wpdb;
        $sql="select m.meta_value as email, p.ID, p.post_title as name from wp_posts p, wp_postmeta m where p.ID = m.post_id and meta_key = 'email' and p.post_status = 'publish' order by post_title";
        $q=$wpdb->get_results($sql);
        foreach($q as $key=>$value){
            print "$value->name | $value->email<br>";
        }
    }


  function personalizeScript($script,$session,$name,$green_room_url,$start_time,$end_time,$green_room_time,$moderation="",$with=""){
    $script = str_replace('[SESSION]','"'.$session.',"',$script);
    $name = explode(" ",$name);
    $script = str_replace('[NAME]',$name[0],$script);
    $script = str_replace('[START_TIME]',date("H:i",$start_time),$script);
    $script = str_replace('[END_TIME]',date("H:i",$end_time),$script);
    
    $script = str_replace('[GREEN_ROOM_URL]',$green_room_url,$script);
    $script = str_replace('[GREEN_ROOM_TIME]',date("H:i",$green_room_time),$script);
    $script = str_replace('[MODERATION]',$moderation,$script);
    $script = str_replace('[WITH]',$with,$script);
    
    
    

    return $script;

}

function getEventPanel($panel,$recurse=0){
    //var_dump($panel);die();
    extract($panel);
    $coords=explode(" ",$coords);
   // var_dump($panel);
    ?>

<a-entity id="<?=$slug?>-wrap" visible="true" <?=getCoords($coords)?> class="<?=implode(" ",$classes)?>">
            


                <?php if(@$logo3D_src){
            ?>
<a-entity id="model-<?=$slug?>" class="clickable center-obj-zone" static-body 
    position="0 0.1 0" mixin="obj" rotation="0 0 0" scale="2 2 3" gltf-model="#<?=$slug?>-logo3D"></a-entity>
            <?php
        } else {
        ?>

        

        <?php
        }
        $title_y = -1;
        $y_offset = -.75;
        ?>
<a-entity id="text-wrap" scale=".5. .5 .5"> 

<?php

    if($parent!=0){
        if(!@$_GET['townhall']){}// hide date
?>
<a-entity id="event-title" troika-text='value:<?=$title?>; color:#f5f5f5; align:center; color:#fff; fontSize:1;align:center;maxWidth:20;strokeColor:#000;strokeWidth:0.015;font:/wp-content/themes/webxrsummits/fonts/AGENCYB.ttf'
            material="shader: standard; metalness: 0.8;"
            
             position="0 <?=$title_y?> 0" rotation="0 0 0" scale="1 1 2">
</a-entity>

            <?php
          //  }
$title_y = $title_y-1;
        ?>

<a-entity id="event-date-<?=$slug?>" troika-text='value:<?=$attr?>; color:#f5f5f5; align:center; color:#fff; fontSize:.75;align:center;maxWidth:8;strokeColor:#000;strokeWidth:0.01;font:/wp-content/themes/webxrsummits/fonts/AGENCYB.ttf'
position="0 <?=$title_y?> 0"
            material="shader: standard; metalness: 0.8;"
            ></a-entity>
        <?php

    }//parent !=0;
    
        $title_y = $title_y-.25;
        if($parent==0){
            $children = [];
        }
            foreach($children as $key => $label){
                $title_y = $title_y+$y_offset;
                $img_y = $title_y+ -.3;
                if($label['thumbnail']){
                    ?>
                    <a-image mixin="scale-label" src="<?=$label['thumbnail']?>"
                    geometry="primitive: circle;" scale="1 1 1" position="-3.5 -3.5 0" ></a-image>
                <?php
                }
            ?>
            <a-entity id="label-subtitle" troika-text='value:<?=$label['attr']?>; color:#f5f5f5; align:left; anchor:left;color:#fff; fontSize:.5; maxWidth:4;strokeColor:#000;strokeWidth:0.01;'

                material="shader: standard; metalness: 0.8;" position="-2.2 <?=$title_y?> 0" rotation="0 0 0">
            </a-entity>
            <?php
    $title_y = $title_y+$y_offset;
            ?>
                <a-entity id="label-title" troika-text='value:<?=$label['title']?>; color:#f5f5f5; align:left; anchor:left; color:#fff; fontSize:.7;maxWidth:12;StrokeColor:#000;strokeWidth:0.015;'
                material="shader: standard; metalness: 0.8;" position="-2.2 <?=$title_y?> 0" rotation="0 0 0">
            </a-entity>
            <?php
            }
        
        

        ?>


</a-entity>
                </a-entity>
<?php


}

function get_pedestals($menu){
    $awards = get_menu_array($menu);
      $pedestals = [];
      
     foreach($awards as $key =>$award){
    

        if($award['coords'] !=''){
          array_push($pedestals,[
              
              
              "title"=>@$award['title'],
              "content"=>@$award['content'],
              "slug"=>@str_replace("2021-","",$award['slug']),
              "classes"=>$award['classes'],
              "coords"=>$award['coords'],              
              "nominees" => $award['children'],
              "meta" => $award['meta']
              
          ]);
        }
      }// var_dump($pedestals); die();
      return $pedestals;
  }

  
function get_nominations($menu){
    $awards = get_menu_array($menu);
      $pedestals = [];
     
     foreach($awards as $key =>$award){
         if($award['classes'] != null){
        $class_array = $award['classes'];
         


                array_push($pedestals,[
                    
                    "id"=>@$award['ID'],
                    "title"=>@$award['title'],
                    "content"=>@$award['content'],
                    "slug"=>@str_replace("2021-","",$award['slug']),
                    "classes"=>$award['classes'],
                    "coords"=>$award['coords'],
                    "duration"=>$award['duration'],
                    
                    "nominees" => $award['children'],
                    "meta" => $award['meta']
                    
                ]);
          
        }
      }// var_dump($pedestals); die();
      return $pedestals;
  }

  function getIcalDate($time, $inclTime = true)
{
    return date('Ymd' . ($inclTime ? '\THis' : ''), $time);
}
function getGLB($id){
    if($id != NULL){
        
    $guid = @get_post($id[0])->guid;
       
    //var_dump(explode('/wp-content',$guid));
        
        if(strpos(@$guid,"/wp-content")){
            return '/wp-content'.explode('/wp-content',@$guid)[1];
        }
    }
  }

  
function getNomineeImage($thumbnail_id,$class){
    $src = getThumbnail($thumbnail_id);
    

}
function getMetaLink($data,$field,$wrap='span'){
    $prefix ='';
    $link = '';
    $label = '';
    $value = trim(@$data[$field][0]);
   
    if($value){

        if($field == 'email'){
          
            $link = "mailto:$value";
            $label = $value;
        } else if($field == 'twitter'){
            $link = $value;
            $label = str_replace("https://twitter.com/","@",$value);
        }else if($field == 'linkedin'){
            $link = $value;
            $label = str_replace("	https://www.linkedin.com/in/","/",$value);
        }
        
        else {
            $link = $value;
            $label = $value;
        }



        print "<$wrap class='meta'><a href='$link'>$label</a></$wrap>";
    } else {

     //   print " <span class='alert'>no $field</span>";
    }

}
function getPostMeta($meta_key){
    global $wpdb;
    $q= $wpdb->get_results("select distinct meta_value, post_id from wp_postmeta where meta_key = '$meta_key'");
    $children=[];

    foreach($q as $key=>$value){
        extract((array) $value);
        //print "$value->ID | $value->post_title<br>";
 //  $i = insertProfile($name,$bio,$parent);
     array_push($children,(array) $value);


    }
    return $children;
}    

function getPanelsArray($panels_menu){
    $panels = [];
    
    foreach($panels_menu as $key => $panel){
        

        array_push($panels,getPanelItem($panel,0));
      
      
        

    }
  //    var_dump($panels);
   
    return $panels;
}

function getPanelItem($panel,$level=0){
    extract($panel);
  
//     print @$attr;
   // print $title;
    
   // print "<BR>";
 

    $panel_children = [];
        if(count($children)){
        foreach($children as $key =>$child){
//                var_dump($child);
            if(is_array(@$children)){
                array_push($panel_children,getPanelItem($child,$level));
            }
        }
    }
    $panel = [
        
        
        'title'=>$title,
        'slug'=>$slug,
        'parent'=>$parent,
        
        'attr'=>@$attr_title,
        'classes'=>@$classes,
        'coords'=>@$coords,
        
        'logo'=>@$meta['logo'],
        'logo3D'=>@$meta['logo_3D'],
        'logo3D_src'=>getGLB(@$meta['logo_3D']),
        'thumbnail'=>getThumbnailPathFromID($panel['post']->ID),
        
        'children'=>$panel_children
        
    ];
   
    
    
    return $panel;

  

}
function getThumbnailPathFromID($id){
    if($thumbnail_id = get_post_thumbnail_id($id)){    
        $path = getThumbnail($thumbnail_id);
    
        return '/wp-content'.explode('wp-content',$path)[1];
    }

}
