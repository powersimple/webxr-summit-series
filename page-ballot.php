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


<section class="home-section home-parallax home-fade home-full-height
" id="home" style="background:url(<?=$hero_image?>) center center no-repeat;background-size:cover;">
</section>
<?php
}
?>

<main role="main" class="main">

  <section  id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ballot-page">

   <h1><?=$post->post_title?></h1>
<?php
/*
  print "<pre>";
  
  getJurorCandidates();


  print "</pre>";
*/
 // var_dump($_POST);
 print "<hr><div id='ballot'>";
 if(@$_GET['tally'] == 'ho'){

  get_ballot_results();


  print "<br><hr><br>";
 }

 if(@$_GET['mats'] == 1){
?>

 <form method="post" action="?">
    <p>Please Enter the Email Address where you received your Jury Invitation<br>
  Your votes will be anonomyized on the ballot. 
  </p>
      <input type="email" name="email" value="" placeholder="Email">
      <input type="submit" value="Enter to Vote for The Polys">
    



  </form>
<?php
 }
  if(!@$_POST['email'] && !@$_POST['juror_id']){
?>

 Voting for the 2022 Polys - WebXR Awards has ended. Thank you to our Jurors. See you next year.
 <br>


 <hr>
 <br>

<?php


    print do_blocks(do_shortcode($post->post_content));
      

  } else {
    
    if(@$_POST['email']){
      $juror = get_juror_id($_POST['email']);
      if(@$juror == NULL){

        // CAN'T FIND JUROR EMAIL

        print "Sorry we could not find your email address<br>
        please try again.";
        ?>
      <form method="post" action="?">
          <p>Please Enter the Email Address where you received your Jury Invitation<br>
        Your votes will be anonomyized on the ballot. 
        </p>
            <input type="email" name="email" value="" placeholder="Email">
            <input type="submit" value="Enter to Vote for The Polys">
          
        </form>
          <p>If you cannot access your ballot, please report it to <a href="mailto:webxrawards@gmail.com">webxrawards@gmail.com</a>
        
          <?php
      print do_blocks(do_shortcode($post->post_content));



      } else{
        //SUCCESS
        $juror_id = $juror->id;
        $_POST['juror_id'] = $juror->id;

        print "Welcome $juror->name";
      }
    } else {
      
      $juror_id=$_POST['juror_id'];
      $award_id=$_POST['award_id'];
      updateJurorBallot($award_id, $juror_id);
    

    }


    


  

    ?>

   
  



<?php
if(@$juror_id != NULL || @$_GET['tally'=='']){
$awards = get_menu_array('polys3');


    foreach($awards as $key => $award){// outer menu loop
        print "<h4>Please remember to save after voting in each category before voting in the next</h4>";
        print "<table>";
        foreach($award['children'] as $c =>$child){// EVENTS loop
          if($child['classes'][0] == 'honor'){
            continue;
          }
        

          if($child['classes'][0] == 'nomination' ){
            print "<tr><td class='nom-cat'>";
            ?>
            <form method="post" action="?">
            <input type="hidden" name="juror_id" value="<?=$juror_id?>">
            <input type="hidden" name="award_id" value="<?=$child['ID']?>">
            
            <?php
            print '<h3 class="nomination-category">'.$child['title'].'</h3>';
          //  var_dump($child['ID']);
            print "<table class='nominee-list'>";
            get_ballot($child['ID'],$child['children'],0);//recursive nominees loop
            print "<tr><th colspan='4'>";
            print "I affirm that I have reviewed all nominees in this category<br>before casting a vote<br>";
            print "<input type='submit' value='SAVE YOUR VOTE NOW for ".$child['title']."'><br>Save Before Proceeding";
            print "</th>";
            print "</table>";
          
            print '</form>';
          }
          print "</td></tr>";
        
          
        }
    
        print "</table>";

      }
  print "</div>";

  }

}
?>




</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>