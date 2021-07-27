<?php
    /*Optimize page loads by rendering restapi queries to static json files and save them in app/json/*/
/*
  ===BEWARE OF REST API PAGINATION AND SORT ORDER!====
Pagination:
Keep in mind, the rest API has a default of 16 records, so you have to set the parameter
&per_page=, and the limit is 100. If you need to return more than 100 results from any of the queries below
you have to paginate the results
Otherwise, the results you want, may not be the results it returns.
Sort: For sanity's sake, it's best that you sort posts by ID, so when inspecting your endpoint, they are in order
Hence, the REST_post_filter variable below.
*/
$GLOBALS['REST_post_filter'] = "filter[orderby]=ID&order=asc&per_page=100";// handles order and pagination


function iterateEndpoint($type,$name,$query){
        $endpoint_array = array();
       // print $iterations;
        global $wpdb;
        if($type == 'post_type'){

           $iterations = 2;
           $sql = "select id from wp_posts where post_status='publish' and post_type='$name'";
           $q = $wpdb->get_results($sql);
        } else {

        }

            
        if(print (count($q)/100) > floor(count($q)/100)){
                        //print   $iterations = count($q);
             $iterations = floor((count($q)/100))+1;
            


        } else {
            $iterations = 1;
        }

       

        for($i=1;$i<=$iterations;$i++){
             
           array_push($endpoint_array,$query."&page=$i");
        }    
        
            return $endpoint_array;
        

}

$GLOBALS['REST_CONFIG'] =array(//An array of url arguments
            "posts"=>"fields=id,type,title,content,slug,excerpt,languages,post_media,featured_media,screen_images,video,type,cats,tags&".$GLOBALS['REST_post_filter'],
            "pages"=>"fields=id,type,title,content,slug,excerpt,languages,post_media,featured_media,screen_images,featured_video,cats,tags,type&".$GLOBALS['REST_post_filter'],
            "profile"=>"fields=id,type,title,content,slug,excerpt,post_media,languages,info,seo,featured_media,screen_images,featured_video,type,industry,support_hardware,feature,thumbnail_url,collaboration_type,platform,cats,tags&".$GLOBALS['REST_post_filter'],
           // "profile"=>iterateEndpoint('post_type','profile',"fields=id,type,title,content,slug,excerpt,post_media,languages,info,seo,featured_media,screen_images,featured_video,type,industry,support_hardware,feature,thumbnail_url,collaboration_type,platform,cats,tags&".$GLOBALS['REST_post_filter']),
            "hardware"=>"fields=id,type,title,content,slug,excerpt,posts,post_media,languages,info,seo,profiles,featured_media,screen_images,featured_video,type,industry,feature,thumbnail_url,platform,cats,tags&".$GLOBALS['REST_post_filter'],
         //   "resource"=>"fields=id,type,title,content,slug,excerpt,languages,project_info,featured_media,screen_images,featured_video,type,cats,tags&".$GLOBALS['REST_post_filter'],
           // "event"=>"fields=id,type,title,content,slug,excerpt,languages,project_info,featured_media,screen_images,featured_video,type,cats,tags&".$GLOBALS['REST_post_filter'],
            //"product"=>"fields=id,type,title,content,slug,excerpt,languages,project_info,featured_media,screen_images,featured_video,type,cats,tags&".$GLOBALS['REST_post_filter'],
            //"person"=>"fields=id,type,title,content,slug,excerpt,languages,project_info,featured_media,screen_images,featured_video,type,cats,tags&".$GLOBALS['REST_post_filter'],
            //"sponsor"=>"fields=id,type,title,content,slug,excerpt,languages,project_info,featured_media,screen_images,featured_video,type,cats,tags&".$GLOBALS['REST_post_filter'],
            //"social"=>"fields=id,type,title,content,slug,excerpt,featured_media,social_url&".$GLOBALS['REST_post_filter'],
            "categories"=>"fields=id,name,count,slug,description,posts,children".$GLOBALS['REST_post_filter'],
/*
            "feature"=>"fields=id,name,count,slug,description,posts,".$GLOBALS['REST_post_filter'],
            "collaboration_type"=>"fields=id,name,count,slug,description,posts".$GLOBALS['REST_post_filter'],
            "platform"=>"fields=id,name,count,slug,description,posts".$GLOBALS['REST_post_filter'],
            "industry"=>"fields=id,name,count,slug,description,posts".$GLOBALS['REST_post_filter'],
            "integration"=>"fields=id,name,count,slug,description,posts",
            */
            "tags"=>"fields=id,name,slug,posts&".$GLOBALS['REST_post_filter'],
            "menus"=>"menus",
            "media"=>"fields=id,data&".$GLOBALS['REST_post_filter'],
           // "collaborators"=>"fields=meta_value&".$GLOBALS['REST_post_filter'],
           
        );

// for WPML Comment this out if you aren't using it.
require_once("functions-wpml-languages.php");

        
    function getEndpoints(){ // BUILDS URLS FOR REST API ENDPOINTS

       $content = array();

        $url_path = "http://".$_SERVER['HTTP_HOST']."/wp-json/wp/v2/";//pendpoint path
        $server_path = get_template_directory()."/data/";//destination folder for writing
 
        if(@$_GET['endpoints']){//header for list of endpoints
                print "<strong>ENDPOINTS:</strong>
                <ul>";
        }
        
        foreach($GLOBALS['REST_CONFIG'] as $key => $value){//loops through the array of endpoints above
            /* FIX ITERATIVE ATTEMPT
            
             if(is_array($value)){
             //  $url = $url_path.$key."?".$value; // default, value passes params in REST_CONFIG array
  //         // var_dump($value);
  //var_dump($value);
                $result_array = array();
                foreach($value as $it => $qstring){
                    $url = $url_path.$key."?".$qstring;
                    if($it == 0){
                         $merged_results = json_decode(getJSON($url));
                    } else {
                        array_merge($merged_results,json_decode(getJSON($url)));
                    }

                  
                }

             
                var_dump(json_decode(json_encode($merged_results)));

               
           } else {
               $url = $url_path.$key."?".$value; // default, value passes params in REST_CONFIG array

           } 
     */
              $url = $url_path.$key;
            if(function_exists('icl_object_id')){// if WPML is here. 
                if($value == 'language'){ //language = $key, will not work with arguments
                    //see path registrations in WPML Languages
                    $url = $url_path.$key;// this is the REST API url with the language last
                }

            }
            
            
           $server = $server_path.$key.".json";
           if(@$_GET['publish']){
            
            if(is_array($value)){
             //  $url = $url_path.$key."?".$value; // default, value passes params in REST_CONFIG array
               



           } else {
                $url = $url_path.$key."?".$value; 
             $content[$key] = json_decode(getJSON($url));
           } 
           

           // writeJSON($server,)$content[$key];
           }

              if(@$_GET['endpoints']){//prints endpoing urls
                print "<li><a href='$url'>$key</a><br></li>";
              }

            
        }
        if(@$_GET['endpoints']){
            print "</ul>";
            die();//kills the page load so you can see the endpoint urls
        }
        if(@$_GET['publish']){
            header('Content-Type: application/json');
            $content = json_encode($content,true); // writes the whole shebang into a json packet
            
            writeJSON($server_path."content.json",$content);
            print $content;
            die();//kills the page load so you can see the endpoint urls
        }

      
      //writeJSON($posts_path,$file_path);

        

    }
    function getJSON($data_path){
        return file_get_contents($data_path);
    }

    function writeJSON($file_path,$data){
        //$data = file_get_contents($posts_path);
        $handle = fopen($file_path, 'w') or die('Cannot open file:  '.$file_path);
        fwrite($handle, $data);
        fclose($handle);
    }
    
    $user = wp_get_current_user();
    $allowed_roles = array('administrator');
    if( array_intersect($allowed_roles, $user->roles ) ) {  
       //stuff here for allowed roles
     
        
    if(@$_GET['publish'] || @$_GET['endpoints']){
        getEndpoints();
       
    }
} 

function slugify_tax($start,$end){
    global $wpdb;
    $sql = "select term_id, name from wp_terms where (term_id >= $start) and (term_id<=$end)";
    $q = $wpdb->get_results($sql);
  
    $terms_sql = "select * from wp_terms";
    $terms = $wpdb->get_results($terms_sql);
  
  
    foreach($q as $key=>$value){
//     string $slug, object $term ;

        print $value->name ."|".wp_unique_term_slug(sanitize_title($value->name),$terms)."<BR>";

    }
    die();
}
  if(@$_GET['slugify_tax']){
      slugify_tax($_GET['slugify_tax'],$_GET['end']);
}



    //add_action( 'save_post', 'refreshJSON');// this will run if you save a post. Too much overhead for every save so better to trigger manually
?>