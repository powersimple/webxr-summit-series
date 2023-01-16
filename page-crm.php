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
 
 
CRM

<?php

    function get_profile_by_id($profile_id){
        $website = get_post_meta($profile_id,"website",true);
        $twitter = get_post_meta($profile_id,"email",true);
        $linkedin = get_post_meta($profile_id,"linkedin",true);
        $profile_title=get_post_meta($profile_id,"profile_title",true);
        $email = get_post_meta($profile_id,"email",true);
        $profile_name = get_post($profile_id)->post_title;



        return 
            ['id'=>$profile_id,
                'website'=>$website,
            'twitter'=>$twitter,
            'linkedin'=>$linkedin,
            'title'=>$profile_title,
            'email'=>$email,
            'name'=>$profile_name

            ]
        
        ;


    }


    function get_profile_id_from_company($company){
        global $wpdb;
        $sql = "select post_id from wp_postmeta where meta_key='company' and meta_value like '%$company%'";
        $q = $wpdb->get_results($sql);
       $profiles = [];
       foreach($q as $key => $value){
        array_push($profiles,$value->post_id);
       }
       return $profiles;
    }

    if(@$_GET['company']){
        $companies = [];
        foreach(explode(",",$_GET['company']) as $key =>$company_name){
        $company_profiles = get_profile_id_from_company($company_name);
            
            foreach($company_profiles as $key=>$profile_id){
                array_push($companies,
                [   'company'=>$company_name,
                    'profiles'=> get_profile_by_id($profile_id)
                ]
            );

              

            }
          
 

       }


    ?>
    <table>
       <tr>
        <th>Company</th>
        <th>Contact Name</th>
        <th>Contact Title</th>
        <th>Email</th>
        <th>LinkedIn</th>
        <th>Twitter</th>
        <th>Website</th>
    </tr>



    <?php
        foreach($companies as $key => $value){
          
            foreach($value['profiles'] as $p =>$profile){
                $this_profile = $value['profiles']; }    
                ?>
                <tr>
                <td><?=$value['company']?></td>
                <td><?=$this_profile['name']?></td>
                <td><?=$this_profile['title']?></td>
                <td><?=$this_profile['email']?></td>
                <td><?=$this_profile['linkedin']?></td>
                <td><?=$this_profile['twitter']?></td>
                <td><?=$this_profile['website']?></td>
                </tr>
                <?php
           
        
        }

    ?>


    </table>
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">
    <?php

   //   var_dump($companies);


    }






  print do_blocks(do_shortcode($post->post_content));
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>
  