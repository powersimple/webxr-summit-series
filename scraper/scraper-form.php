   
   <form method="post" action="#" id="scrape-form">
    <input type="hidden" name="id" value="<?=$_GET['key']?>">
    <input type="hidden" name="scraped" value="1">
    <input type="hidden" name="error400" value="0">
<table id="scraper-form" width="100%">



<tr><th>Field</th><td>Scrape Data
    <br><?=@$skip?>
</td><td><input type='submit' id="save-button" class="save" value="SAVE?"><span id="next-link" style="visibility:hidden">Next: <?=@$next?></span>

</td></tr>


   <?php
   
    $fields = "modified,URL,title,description,keywords,language,logo_url,share_image_url,logo_svgtag,contact_url,blog_url,apply_url,jobs_url,events_url,conference_url,twitter,facebook,linkedin,github,tumblr,google_plus,medium,telegram,slack,skype,instagram,youtube,vimeo,pinterest,dribbble,behance,rss,email,phone,address,address2,city,state,postal_code,country,location_country,location_province,location_city,url_content";
    
		ob_start();		
      
        $location_country = $this_link["location_country"];
        $location_province = $this_link["location_province"];
        $location_city = $this_link["location_city"];

        foreach(explode(",",$fields) as $key => $field){
       $label = ucfirst(str_replace("_"," ",$field));
        $field_value = trim(@$this_link[$field]);
        $scrape_value = trim(@$$field);
        $field_class = 'scrape-data';
        

       if(@$this_link[$field] == ""){
         if(@$this_link[$field] != $scrape_value){
              $field_class .= ' diff'; 
         }

        $field_value = @trim($scrape_value);
       }

 


       print "<tr>";

       print '<td class="form-field">'.$label;
         if($field == 'logo_url' || $field == 'share_image_url'){


             print "<br><img class=\"form-thumb\" id=\"preview-$field\" src=\"$field_value\" alt=\"\">";
         }

       print '</td>';
       
       print '<td class="'.$field_class.'">'.@substr(wordwrap($scrape_value,25,"<br>"),0,200).'</td>
           <td class="form-container">';
    
       if($field == 'description' || $field == 'url_content'){
        
            print '<textarea name="'.$field.'" rows="10">'.@$field_value.'</textarea>';
       } else if ($field == 'URL'){     
            print '<input type="text" name="'.$field.'" id="'.$field.'" value="'.@$_GET['url'].'">';
 
       } else if ($field == 'modified'){     
        print '<input type="checkbox" name="'.$field.'" id="'.$field.'" value="1">';

   } else {

            print '<input type="text" name="'.$field.'"  id="'.$field.'" value="'.@$field_value.'">';

       }



       print "</td>
       </tr>";
       

    }
    $fields_table = ob_get_clean();
    

    ?>


<?=$fields_table?>
<!--

<tr><th>Location</th><td colspan="2">
    <table>
    <tr><td>Country <?=@$location_country?></td>
    <td><select name="location_country" id="location_country"></select></td></tr>
    <tr id="province-row"><td>Province <?=@$location_province?></td>
    <td><select name="location_province" id="location_province"></select></td></tr>
    <tr><td>City <?=@$location_city?></td>
    <td><select name="location_city" id="location_city"></select></td></tr></table>
    </td><tr>


    <tr><td></td><td></td><td><input type='submit' class="save" value="SAVE"></td></tr>

</table>
</form>
<script>
    //set location vars to JS
     var location_data_path = "<?=get_template_directory_uri()?>/app/json/locations.json";

    var location_country = '<?=@$location_country?>';
    var location_province = '<?=@$location_province?>';
    var location_city = '<?=@$location_city?>';
    
</script>-->