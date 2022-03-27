<?php 
function getNFTLaurelMeta($laurel,$nominee,$nominee_meta_list){
  


  $laurels = [];
    extract((array) $nominee);
    

    $src = explode("/",getThumbnail($laurel));
    $laurel_array = explode("-",str_replace(".svg","",$src[7]));
    print implode(" ",$laurel_array);
   

    $current_award = getLaurelLabel($laurel_array[2]);
    $current_nomination = $title;


    





      


      $nom_data = [
        "names"=>[],
        "emails"=>[],
        "twitters"=>[],
        "email_names"=>[],
        
    ];

    if($nominee['post']->post_type=='profile'){
    array_push($nom_data['names'],$nominee['title']);
    array_push($nom_data['emails'],@$nominee['meta']['email'][0]);
    array_push($nom_data['email_names'],$nominee['title']."<".@$nominee['meta']['email'][0].">");

    array_push($nom_data['twitters'],@$nominee['meta']['twitter'][0]);
    }

    $nominee_meta_list = getNomineeMetaList($nom_data,$nominee,$current_award,$current_nomination);

    $laurels = @$nominee['meta']['laurel'];
//    var_dump($nominee_meta_list);

        $at_names = [];
        $names = $nominee_meta_list['names'];
        $first_names = [];
        
        foreach(@$names as $t =>$name){
          array_push($at_names,$name);
          $this_name = explode(" ",$name);
          array_push($first_names,$this_name[0]);

        }
        $names = implode(" ",$at_names);
        $names_comma = implode(", ",$at_names);
        
        print "<br>";
        $first_names = implode("<BR>",$first_names);
      


      
    //  var_dump($nominee_meta_list);
      $at_twitters = [];
      $twitters = $nominee_meta_list['twitters'];

      foreach(@$twitters as $t =>$twitter){
        array_push($at_twitters,str_replace("https://twitter.com/","@",$twitter));

      }
      $twitters = implode(" ",$at_twitters);





      $nftmeta_title= "Official 3D Nominee Laurel Recognizing $current_nomination";
      $nftmeta_subtitle= "The Polys - WebXR Awards - $current_award - 2021 Nominee";

    $nftmeta_desc =  "This 3D Laurel is presented to 
$current_nomination
$names_comma 
as a 2021 Nominee for
$current_award 
at The 2nd Polys WebXR Awards - Saturday February 12, 2022
Hosted by Julie Smithson and Sophia Moshasha.
";
        //print "Length: ". strlen($tweet)."<BR>";
        print "<form>
        Title<input type='text' value='$nftmeta_title' size='80'><br>
        Sub: <input type='text' value='$nftmeta_subtitle' size='80'><br>
        <textarea cols='80' rows='9'>";
        print str_replace(", ,",", ",$nftmeta_desc);
        print "</textarea><BR><HR><BR>";



      
    
      
 
}


?>
<?php
function getMetaArray($key,$data,$returnArray){

}


function getLaurelList($laurels){
  if(is_array($laurels)){

 print "<ol>";
    
    foreach($laurels as $key=>$value){
      print "<li>";
//        print "$value";
        if($src=getThumbnail($value)){
          print "<img src='$src' style='width:200px;'>";
        } else {
          print wp_get_attachment_url($value);
        }

      print "</li>";
    }


  print "</ol>";
}
 
}


function nomineeAccordion($awards){
  $nominations = [];
  print "<div id='nomineeAccordion'>";
  
  foreach($awards as $i =>$award){
      extract($award);
      
      $current_award = $slug;
      
      if(!in_array("nomination",explode(" ",$classes[0]))){
          continue;
        }
        
        $title = str_replace("2021 – ","",$title);
        print "<h3 class=>$title</h3>";
        print "<div class='nominees'>";
        print "<ul class='nominee-list'>";
        foreach($nominees as $c => $nominee){
          
          $current_nomination = $nominee['slug'];
          $type= $nominee['post']->post_type;
          if($type == 'resource'){
              $url = @$nominee['meta']['resource_url'][0];
          } else {
              $url = @$nominee['meta']['website'][0];
          }



          
          
         $presented = "";
         $nominee_class=""; 
         $id = $nominee['post']->ID;
         //
         $title =  htmlentities($nominee['title']);
         if($nominee['classes'][0] == 'presenter'){
          continue; 
          $presented = 'Presented by'; 

           $nominee_class="presenter"; 
           print "<li class='presenter'>Presented by $nominee[title]</li>";
          } else if($nominee['classes'][0] == 'winner'){
              $presented = 'Winner'; 
              $nominee_class="winner2021"; 
              print "<li class='winners'>Winner<br><a href='$url' target='blank'>$nominee[title]</a></li>";
          } else{
            print "<li class='$nominee_class'>$presented  <a href='$url' target='blank'>$nominee[title]</a></li>";
          }
          
         
      
         
        }
          print "</ul>";
        print "</div>";
        
      }
      print "</div>";
       
}


function nomineeOutreach($awards){
    $nominations = [];
    print "<div id='cards'>";
    
    foreach($awards as $i =>$award){
        extract($award);
        
        $current_award = $slug;
        
        if(!in_array("nomination",explode(" ",$classes[0]))){
            continue;
          }
          
          
          print "<hr><h2>$title</h2>";
        print "<BR>";
          foreach($nominees as $c => $nominee){
            
            $current_nomination = $nominee['slug'];
            $type= $nominee['post']->post_type;
            if($type == 'resource'){
                $url = @$nominee['meta']['resource_url'][0];
            } else {
                $url = @$nominee['meta']['website'][0];
            }



            print "<div class='nominee-outreach-card'>";
            
           $presented = "";
           $nominee_class=""; 
           if($nominee['classes'][0] == 'presenter'){
             $presented = 'Presented by'; 
             $nominee_class="presenter"; 

            }
            
            if($nominee['classes'][0] == 'winner'){
                $presented = 'Winner'; 
                $nominee_class="winner2021"; 

               }
            
            $id = $nominee['post']->ID;
        

            print "<ul class='nominee-list'>";
            print "<li class='$nominee_class'>$presented  <a href='$url' target=          blank'>$nominee[title]</a></li>";
            print "</ul>";
//            print "<h3>$presented  <a href='/wp-admin/post.php?post=$id&action=edit' target=          blank'>$nominee[title]</a></h3>";

            if(@$_GET['inventory']==1){
              
              $laurels2D = @$nominee['meta']['laurel'];
              
              $laurels3D = @$nominee['meta']['3Dlaurel'];
              $laurel_screenshots = @$nominee['meta']['3Dlaurel_screenshots'];
              
              print "2D Laurels<BR>";
              getLaurelList($laurels2D);
              print "3D Laurel screenshots<BR>";
              
              getLaurelList($laurel_screenshots);
              print "3D NFT Laurels<BR>";
              
              getLaurelList($laurels3D);
              


            }

           

            $nom_data = [
              "names"=>[],
              "emails"=>[],
              "twitters"=>[],
              "email_names"=>[],
              
          ];

        if($nominee['post']->post_type=='profile'){
          array_push($nom_data['names'],$nominee['title']);
          array_push($nom_data['emails'],@$nominee['meta']['email'][0]);
          array_push($nom_data['email_names'],$nominee['title']."<".@$nominee['meta']['email'][0].">");
          
          array_push($nom_data['twitters'],@$nominee['meta']['twitter'][0]);
        }

          
          $nominee_meta_list = getNomineeMetaList($nom_data,$nominee,$current_award,$current_nomination);

        $laurels = @$nominee['meta']['laurel'];
        if(!is_array($laurels)){
          continue;
        }
        if(@$_GET['laurels']){

         foreach($laurels as $key=>$laurel){

            getNFTLaurelMeta($laurel,$nominee,$nominee_meta_list);
            continue;
          }
          //getNomineeCards($awards);
        } 
          ob_start();





          $at_names = [];
          $names = $nominee_meta_list['names'];
          $first_names = [];
          
          foreach(@$names as $t =>$name){
            array_push($at_names,$name);
            $this_name = explode(" ",$name);
            array_push($first_names,$this_name[0]);
  
          }
          $names = implode(" ",$at_names);
          $names_comma = implode(", ",$at_names);
          
          print "<br>";
          $first_names = implode("<BR>",$first_names);
        
  

        
      //  var_dump($nominee_meta_list);
        $at_twitters = [];
        $twitters = $nominee_meta_list['twitters'];
      
        foreach(@$twitters as $t =>$twitter){
          array_push($at_twitters,str_replace("https://twitter.com/","@",$twitter));

        }
        $twitters = implode(" ",$at_twitters);
        

        $at_emails = [];
        $emails = $nominee_meta_list['emails'];

        foreach(@$emails as $t =>$email){
          array_push($at_emails,$email);

        }
        $at_email_names = [];
        $email_names = $nominee_meta_list['email_names'];

        foreach(@$email_names as $t =>$email){
          array_push($at_email_names,$email);

        }


       
        $emails = implode(";",$at_emails);
        $email_names = implode(";",$at_email_names);
 
        $emails = ob_get_clean();
        
        $nominated_categories  = getLaurelNames($laurels,$nominee['title']);
      
        $noms_len = count($nominated_categories);
        
        $nominations = implode(", ",$nominated_categories);
 
        if($noms_len > 1){
          $congrats_tweets = "Congrats $twitters on $noms_len Poly nominations ";
          $nominations_tweets = str_replace(" of the Year"," ",$nominations);

          $congrats_linkedin = "Congratulations $names_comma on $noms_len Poly nominations ";
          $nominations_linkedin = " for $nominations";

        } else {
          $congrats_tweets = "Congrats $twitters on your Poly Nomination ";
          $nominations_tweets = "Congrats $twitters on your Poly nomination ";

          $congrats_linkedin = "Congratulations $names_comma on your Poly Nomination ";
          $nominations_linkedin = " for $nominations ";
        }
        



        if(@$_GET['tweet']){
            $tweet = $congrats_tweets;
            print $nominations."";
            $tweet .= "at the The 2nd Polys - #WebXR Awards with @juliesmithso & @SophiaMosh on 2.12.22";
            $tweet.="$nominations_tweets";
          // $tweet.=" $twitters";
          $tweet .=  " https://bit.ly/polys2tix thepolys.com";

            print "Length: ". strlen($tweet)."<BR>";
            print "<form>
            <textarea cols='50' rows='5'>";
            print $tweet;
            print "</textarea>";


            print "</form>";


        } 
         if(@$_GET['linkedin']){


            $tweet = $congrats_linkedin;
            $nominations_linkedin."";
                       $tweet.="$nominations_linkedin for $nominations ";
          // $tweet.=" $twitters";
          $tweet .= "at the The 2nd Polys - #WebXR Awards hosted by Julie Smithson and Sophia Moshasha on Saturday, Feb 12. ";

         $tweet .=  "Visit https://bit.ly/polys2tix ink to register for the event and visit https://thepolys.com to see the nominated experiences. ";

            //print "Length: ". strlen($tweet)."<BR>";
            print "<form>
            <input type='text' name='' value=''>
            <textarea cols='50' rows='9'>";
            print str_replace(", ,",", ",$tweet);
            print "</textarea><BR><HR><BR>";







        }

       
         if(@$_GET['emails']){
            ob_start();
           // print "Dear $names, <br>";

            print $nominations."|";
            print "  $names&lt;$email&gt;<br>";
           
            /*
            print "<form>
            <textarea id='email-body' cols='50' rows='15'>";
           
            print "</textarea>";
            print ob_get_clean();
            */
          
        }

       
       




          }
    }


}

function getNomineeMetaList($nom_data,$nominee,$current_award,$current_nomination){

    if(count(@$nominee['children'])){
      

     
  
  
        foreach($nominee['children'] as $n => $child){
      
    
            $type=$child['post']->post_type;
            if($type == 'profile'){
           
 
              
            array_push($nom_data['names'],$child['title']);
            array_push($nom_data['emails'],@$child['meta']['email'][0]);
            array_push($nom_data['twitters'],@$child['meta']['twitter'][0]);
            $nom_data = getNomineeMetaList(@$nom_data,$child,$current_award,$current_nomination);
          }
        }
    }
    return $nom_data;
  
  }

function getLaurelNames($laurels){
    $nominated_categories = [];
  if(@is_array($laurels)){
    foreach($laurels as $key=>$laurel_id){
    
        $laurel_meta = get_post_meta($laurel_id);
        
        //$noms = explode("-",get_post($laurel_id)->post_title));
        $noms = explode("-",get_post($laurel_id)->post_title);
        array_push($nominated_categories,getLaurelLabel($noms[2]));
  
    }
    return $nominated_categories;
  }
}

function getLaurelLabel($nom){
    switch($nom){
        case"AROTY";
            return "Augmented Reality Experience of the Year";

        case  "FOTY":
            return"Framework of the Year";
        case  "POTY":
            return"Platform of the Year";
        case  "COTY":
            return"Creator of the Year";
        case  "EOTY":
            return"Event of the Year";
        case  "SOTY":
            return"Software of the Year";
        case  "DOTY":
            return"Developer of the Year";
        case  "ROX ":
            return"R.O.X. Award – Return on Experience";
        case  "WOTY":
            return"World of the Year";
        case  "GOTY":
            return"Game of the Year";
        case  "VEOTY":
            return"Video Experience of the Year";
        case  "EEOTY":
            return"Entertainment Experience of the Year";
        case  "EDOTY":
            return"Education Experience of the Year";

              case  "XOTY":
            return"Experience of the Year";


            }

}



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

        }


        for($i=0;$i<$count;$i++){
            print "<div class='$class'>";
        $src = getThumbnail($laurels[$i]);
            print "$<img class='style-svg' src='$src' alt='Laurel $label'>";
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

?>