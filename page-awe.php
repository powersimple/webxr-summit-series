<main role="main" class="main <?=$section_class?>">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">


<?php

  print do_blocks(do_shortcode($post->post_content));
?>
</div>
</section>
</div>

</div>
  </main>