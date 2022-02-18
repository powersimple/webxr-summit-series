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
<style>
    .thumb{
            width:150px;
            border-radius:50%;
    }
    th{
               font-weight:900;

    }
    table{
      width:100%;
    }
    tr.even{
        background-color:#f7f7f7;
    }
    th, td{
     vertical-align:middle;
     padding:3px;
    }
    td a{
      font-size:150%;
      color:#EEF;
    }
    .ballot-page{}
    .category{
        background-color:#444;
        color:#fff;
        font-weight:900;
        font-size:150%;
        line-height:125%;
        padding:10px;

    }

    .nominee{
       font-size:125%;
           line-height: 125%;
    }
    .save {
        float:right;
        background-color:#393;
        color:#fff;
        border-radius:15px;
        font-weight:900;
        margin-right:20px;
        padding:5px 10px;;
    }
    .sign-in input{
        font-size:120%;
    }
    .choice{
        text-align:center;
vertical-align:middle;
    }
    .choice input[type=radio]{
        transform: scale(2);
  padding: 10px;
        text-align:center;
        font-size:15px;
    }
    .cert{
        font-size:80%;
        text-align:right;
        vertical-align:middle;
    }
    .optin{
      border:1px dashed #ccc;
      padding:40px;
    }
    .page-ballot{
      padding-top:70px;
      font-size:150%;
    }
    
</style>

<main role="main" class="main">

  <section  id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 ballot-page">

   <h1><?=$post->post_title?></h1>
<?php
  if(@$_POST['consent']){
    foreach($_POST['consent'] as $key=>$value){
      updateJuror($key,$value,$_POST['juror_id']); 
    }
     

  }


  function optin($field,$juror,$message,$optin,$optedin){
    $juror = (array)$juror;
    //var_dump($juror);

      if($juror[$field] == 0){
        $state=1;
        $button =$optin;
      } else {
        $state=0;
        $button =$optedin;
      }


    ?>

    <!--
    <form action="/ballot/" method="post" class="sign-in">
    <label><?=$message?></label>  
    <input type='hidden' value="<?=$state?>" name="consent[<?=$field?>]">
    <input type='hidden' value="<?=$juror['id']?>" name="juror_id">
    <input type='hidden' value="<?=$juror['email']?>" name="juror_email">
    

      <input type="submit" value="<?=$button?>">

  </form>-->
  <?php
  }




  if(!@$_POST['juror_email']){

  
?>


<p>Voting for <span class="thepolys">The<sup>2nd</sup>Polys</span> <span class="webxrawards">- WebXR Awards</span> has concluded and the winners have been chosen. 
<BR><BR>
Thank you to all the jurors who voted.
</p>

<!--
<p>You have been invited to participate in the jury to select winners of <span class="thepolys">The Polys</span> <span class="webxrawards">- WebXR Awards</span> on February 12<sup>th</sup>. </p>

<form action="/ballot/" method="post" class="sign-in">
    <label>Please enter the email address where you received your invitation.
    <input type="text" name="juror_email" value="" placeholder="email" size="30"><br>
    <input type="submit" value="Proceed to Ballot">
  </form>-->


<?php
  } else{




  $juror = getJuror(@$_POST['juror_email']);
  if(@$juror->name){
     $awards = get_nominations('polys2');



     if(@$_POST['award']){
 
     updateJurorBallot($juror->id);

     }
     ?>
     <div id="ballot-faq">
     <h2>Welcome <?=$juror->name?>,</h2>


    <?php

       print do_blocks(do_shortcode($post->post_content));
      

    ?>
     </div>
 
 <div class="optin">
    <p>
    <strong>FIVARS and VRTO</strong> have kindly offered free access to Jurors so they can review the FIVARS World, which is nominated for Event of the Year. FIVARS is a world built in Janus XR by Keram Malicki-Sánchez who is nominated for Creator of the year and James Baicoianu, who is nominated for Developer of the Year. VRTO, which is nominated for World of the Year, is a collection of Hubs worlds built on a custom Hubs Cloud deployment and requires user registration as it is a private server. Keram is the founder of FIVARS and VRTO. You must <strong>OPT-IN to share your email with Constant Change Media Group.</strong> We cannot share your email without your consent.<br>
<br>


</p>
<?php

  optin('constantchange',$juror,"OPT-IN to share your email with Constant Change Media Group?<br>","Yes, Please",'You have opted in');

?>
</div>
<div id="ballot">
  <h2><span class="thepolys">The<sup> 2nd </sup>Polys</span><span class="webxrawards"> - WebXR-Awards Ballot</span>
    <?php

  get_ballot("polys2",$juror->id);
  ?>
  </div>
  <?php
  }
    if($juror == NULL){
print "We're sorry, we did not find your email address<BR>
<a href='/ballot/'><strong>CLICK HERE TO RE-ENTER YOUR EMAIL</strong></a><br><Br>
If that doesn't work, please email nominees AT webxrawards.com";
    }else {
     
    ?>
    
  <?php




    }

  

?>




<div id="ballot">




</div>

<?php
}
   
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>