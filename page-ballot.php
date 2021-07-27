<?php
get_header(); 
?>
<style>
    .thumb{
            width:50px;
    }
    th{
               font-weight:900;

    }
    tr.even{
        background-color:#f7f7f7;
    }
    th, td{
     vertical-align:top;
     padding:3px;
    }
    
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
</style>

<main role="main" class="main">

  <section  id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-3 col-md-6 ">

   <h1><?=$post->post_title?></h1>
<?php





  if(!@$_POST['juror_email']){

  
?><p>You have been invited to participate in the jury to select winners of the WebXR Awards on February 20th. </p>
    <form action="/ballot/" method="post" class="sign-in">
    <label>Please enter the email address where you received your invitation.
    <input type="text" name="juror_email" value="" placeholder="email" size="30"><br>
    <input type="submit" value="Proceed to Ballot">


  </form>


<?php



  } else {
   $id = getJurorID();
     if(@$_POST['award']){
    
      updateJurorBallot($id);

    }
     

    ?>
    <?php
    $juror = getJuror(@$_POST['juror_email']);
    if($juror == NULL){
print "We're sorry, we did not find your email address<BR>
<a href='/ballot/'><strong>CLICK HERE TO RE-ENTER YOUR EMAIL</strong></a><br><Br>
If that doesn't work, please email nominees AT webxrawards.com";
    }else {
     
    ?>
    <h2>Welcome <?=$juror->name?>,</h2>


    <?php

        print do_blocks(do_shortcode($post->post_content));

  

      getBallot($id);


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