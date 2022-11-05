<?php

    function getRegistrations(){
        global $wpdb;
        $q = $wpdb->get_results("select * from wp_db7_forms");
        $registrations = [];
        foreach($q as $key =>$value){
            array_push($registrations,(array)$value);
        }
        return $registrations;
    }
    function selectProfileForm($name){
        global $wpdb;
        $q = $wpdb->get_results("select ID, post_title from wp_posts where post_status = 'publish' and post_type='profile' and post_title like '$name%' order by post_title");
        ?>
        <select name="post_id">
        <?php
        foreach($q as $key =>$value){
            ?>
            <option value="<?=$value->ID?>"><?=$value->post_title?></option>
            <?php
        }
        ?>
        </select>
     
    <?php
    }

if(@$_POST['post_id']){
    print $sql = "update wp_posts set post_content = '". esc_sql($_POST['post_content'])."' where ID = $_POST[post_id]";
  $wpdb->query($sql);

/*
    THIS CODE NEEDS AN UPATE query and to add the meta for the sort.
*/


  //get_last_name_first($name){
    foreach($_POST['meta'] as $key=>$value){
      print $sql= "insert into wp_postmeta (post_id,meta_key,meta_value) values($_POST[post_id],'$key','".esc_sql($value)."');";
        print "<BR><BR>";
        $wpdb->query($sql);
    }



 
}


    $registrations = getRegistrations();
    foreach($registrations as $r =>$registration){
        extract($registration);
       $reg = unserialize($form_value);
        ?>
    <form action="?=new_profile" method="post">

<?php





        print $reg['first_name'];
       selectProfileForm($reg['first_name']);
       $profile=[];
        $meta = [];
       foreach($reg as $k=>$f){
           print $k;
           if($f != ''){
                if($k == 'email'){
                    $k = 'email';?>
                    <input type="hidden" name="meta[<?=$k?>]" value="<?=$f?>">
                    <?php
                } else if ($k =='your_name' || $k == 'last_name' ||  strpos($k,"_file") ||  strpos($k,"_file")||  strpos($k,"_status")){
                    
                
                } else if ($k =='bio'){
                    $k='post_content';?>
                    <input type="hidden" name="<?=$k?>" value="<?=$f?>">
                    <?php

                } else if($k == 'title'){
                    $k='profile_title';?>
                    <input type="hidden" name="meta[<?=$k?>]" value="<?=$f?>">
                    <?php
                } else {
                    ?>
                    <input type="hidden" name="meta[<?=$k?>]" value="<?=html_entity_decode($f)?>">
                    <?php
                }
            }
        ?>
        
        <?php
         

       
    }
       //$reg[$k][0];
     
     
    ?>
    <input type="submit" value="update profile">
    </form>
    <?php
  print "<br><hr><Br>";

    }

    ?>
