<?php

get_header(); 
?>

<main role="main" class="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-3 col-md-6 ">

   <h1><?=$post->post_title?></h1>
<?php

  print do_blocks(do_shortcode($post->post_content));

getJurorLinks();
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>