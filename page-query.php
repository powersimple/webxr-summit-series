<?php

get_header(); 


?>
<BR><BR><BR><BR><BR><BR><BR><BR>

<?php
function get_votes($id){
    global $wpdb;
    $sql="select count(first_choice) as one from award_ballot where award_id = $id and first_choice = $id";
    $q=$wpdb->get_results($sql);
    //var_dump($q);
    
    

}

    function get_cats(){
        global $wpdb;
        $sql="select distinct b.award_id, p.post_title from award_ballot b, wp_posts p where b.award_id = p.ID";
        $q=$wpdb->get_results($sql);
        
        foreach($q as $Key => $v){
            $votes = get_votes($v->award_id);
            print "$v->award_id $v->post_title <BR>";
            
            
           // get_nominee($v->award_id);
          
           
            
          

        }

         
    }
    function get_nominee_name($id){
        global $wpdb;
        $sql="select post_title as nominee_name from wp_posts where ID = $id";
        $q=$wpdb->get_var($sql);
        
        return $q;
         
    }
    function get_nominees($field){
        global $wpdb;
        $sql="select distinct b.$field as id, p.post_title from award_ballot b, wp_posts p where b.$field = p.ID";
        $q=$wpdb->get_results($sql);
        
        foreach($q as $Key => $v){
            print "$v->id $v->post_title <BR>";
        
          

        }

     
    }
    function get_noms($id,$field){
        global $wpdb;
        $sql="SELECT $field, award_id, count(*) AS count
        FROM award_ballot
        where award_id = $id
        GROUP BY $field, award_id";
        $q=$wpdb->get_row($sql);
        return $q;
        foreach($q as $Key => $v){
        

        }

         
    }





?>
<main role="main" class="main <?=$section_class?>">

<section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">

<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">
    <?php
    
    get_cats();
    get_nominees("first_choice");
    
    ?>

</div>

</div>
</section>
</main>