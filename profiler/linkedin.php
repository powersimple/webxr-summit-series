<?php


$server_path = get_template_directory()."/../../../../linkedin/scrapedin-linkedin-crawler/crawledProfiles";

$profiles = scandir($server_path);


foreach($profiles as $key => $slug) {

    if($key>2){
    $file_path= $server_path."/".$slug;
    print $file_path."<br>";
    $data = file_get_contents($file_path);
    $result = json_decode($data);
    //var_dump($result);
        foreach ($result as $field => $values) {
            print $field;
            print "<br>";
            if($field == 'profile'){
                    $name = $values->name;
print               $location = $values->location;
                    $imageurl = $values->imageurl;
                    $headline = $values->headline;
                    $summary = @$values->summary;

print "<br>";

            } else if($field == 'aboutAlternative'){
                $aboutAlternative = $values->text;
         } else {
                $$field = trim(str_replace('"','\\"',str_replace("'","\'",json_encode($values))));
            }


        }



        $profile_array = array(
            "name"=>@$name,
            "slug"=>$slug,
            "location"=>$location,
            "headline"=>$headline,
            "summary"=>$summary,
            "imageurl"=>$imageurl,
            "about_alternative"=>$aboutAlternative,
            "positions"=>$positions,
            "educations"=>$educations,
            "accomplishments"=>$accomplishments,
            "recommendations"=>$recommendations,
            "skills"=>$skills
            
            
            
        );

       print $insert = "INSERT INTO `benerwin_linkedin` (`id`, `slug`, `name`, `location`, `headline`, `summary`, `imageurl`, `about_alternative`, `recommendations`, `skills`, `educations`, `accomplishments`, `positions`) VALUES (NULL, '$slug', '$name', '$location', '$headline', '$summary', '$imageurl', '$aboutAlternative', '$recommendations', '$skills', '$educations', '$accomplishments', '$positions')";


       // var_dump($profile_array);
        global $wpdb;
        //$wpdb->query($insert);
    die();
        }
}

?>