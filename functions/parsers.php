<?php
function cleanString(){


}


function splitCells($split){
    
    if(is_array($split)){
        ob_start();
        print "<table>
        <tr>";
        foreach ($split as $key => $value) {


            print "<td>".$value."</td>";
        }


        print "</tr>
        </table>";
        return ob_get_clean();
    }


   
}



function addToArray($text){
    if(is_array($text)){
        foreach($text as $key=>$value){
            array_push($_GET['words'],trim($value));
        }
    } else {
         array_push($_GET['words'],trim($text));
    }

}

function parseJobTitle($text){
    
    if(strpos($text," of ")){
        $text = str_replace(" of ","^",$text);
          $text = explode("^",$text);
        addToArray($text);

          return $text;
         
    }
    else if(strpos($text," på ")){
        $text = explode(", ",$text);
        addToArray($text);
        return $text;

    }else if(strpos($text,", ")){
        $text = explode(", ",$text);
        addToArray($text);
        return $text;

    } else if(strpos($text,"; ")){
          $text = explode("; ",$text);
          addToArray($text);
        return $text;
    } else if(strpos($text,"/")){
          $text = explode("/ ",$text);
          addToArray($text);
        return $text;
    }    else if(strpos($text,"|")){
        addToArray($text);
          $text = explode("|",$text);
        return $text;
    
    } else if(strpos($text," and ")){
         $text = str_replace(" and ","^",$text);
         addToArray($text);
          $text = explode("^",$text);
        return $text;
    }
    
    
    else {
        return array($text);
    }
        



}
function parseCompany($text){
    $blurb = str_replace(", ","^",$text);
   $text = explode('^',$text);
         addToArray($text);
    
        return $text;
    



}
function defaultParse($blurb){
    $blurb = str_replace(", ","^",$blurb);
        $blurb = str_replace("; ","^",$blurb);
        $blurb = str_replace("|","^",$blurb);
        $blurb = str_replace(".","^",$blurb);
        $blurb = str_replace("&","^",$blurb);
        $blurb = str_replace("(","^",$blurb);
        $blurb = str_replace(")","",$blurb);

        $blurb = str_replace("~","^",$blurb);
        $blurb = str_replace("►","^",$blurb);
        $blurb = str_replace("★","^",$blurb);
         $blurb = str_replace("⚡","^",$blurb);
          $blurb = str_replace("✅","^",$blurb);
          
        $blurb = str_replace(" - ","^",$blurb);
        $blurb = str_replace(" • ","^",$blurb);
        $blurb = str_replace("/","^",$blurb);
        $blurb = str_replace("@","^",$blurb);
        $blurb = str_replace("+","^",$blurb);
        $blurb = str_replace(" AR ","^",$blurb);
        $blurb = str_replace(" VR ","^",$blurb);
        $blurb = str_replace(" MR ","^",$blurb);
        $blurb = str_replace(" XR ","^",$blurb);
        $blurb = str_replace(" and ","^",$blurb);

 $blurb = str_replace(" and ","^",$blurb);

        $boom = explode('^',$blurb);

        
        addToArray($boom);

        return splitCells($boom);
}

function parseBlurb($blurb){
    
    if(strpos($blurb," at ")){ //spits common case of job + title
        $blurb = str_replace(" at ","^",$blurb);
        $blurb = str_replace(" @ ","^",$blurb);

        $blurb = str_replace(" @ ","^",$blurb);


        $split = array();
       $boom = explode('^',$blurb);
       if(is_array($boom)){
            $split[0] = splitCells(parseJobTitle($boom[0]));
            $split[1] = splitCells(parseCompany($boom[1]));
        

        return splitCells($split);
       } else{
        return splitCells($boom);
       }

    } else if(strpos($blurb,". ")){ //spits common case of job + title
         return defaultParse($blurb);
    } else { // not parsed as job title.
      return defaultParse($blurb);
       }

          
}

function parseBlurbs($blurb_array){
    $_GET['words'] = array();
    print "<table>";
    $counter = 0;
    foreach ($blurb_array as $key => $value) {
        extract($value);
        $class="oddrow";
        if(($counter/2) == intval($counter/2)){
            $class = 'evenrow';
        }


    print "<tr class='$class'>";
    print "<td><a href='".$linkedin."' target='_new'>".$name."</a></td>";
    
    print "<td>".$occupation."</td>";
    print "<td>".parseBlurb($occupation)."</td>";
    print "</tr>";



        $counter++;
    }

 print "</table>";
 print "<ol style='list-style:decimal; margin-left:20px; padding-left:40px;'>";


  foreach($_GET['words'] as $key=>$value){
//insertTaxTerm($value);

            print "<li>".$value."</li>";
        }
print "</ol>";




}


function insertTaxTerm($term){
    global $wpdb;
    try{
    $wpdb->insert("omni_tax_raw",array("term" => $term));
    }catch (Exception $e) {
    }

}







?>
