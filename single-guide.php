<?php get_header();




 ?>
<html>
    <head>
<style>

</style>
<head>
    <body>
<main role="main" id="main">
    <div id="guide">
<?php
ob_start();


 $properties = get_page_properties_print($post);
    extract((array) $properties);

    if($page_layout_template == 'front_page'){
        $bleed = "";
        if(@$full_bleed == "1"){
            $bleed = 'full-bleed';

        }

        ?>
  <section class="<?=$page_layout_template?> <?=$bleed?>" id="<?php echo @sanitize_title($value->post_title);?>" role="region"> 
        
        <img src="<?php print getThumbnail($hero);?>">
        
    </section>
  <?php

    } else {
?>
  <section class="module <?=$page_layout_template?>" id="<?php echo @sanitize_title($post->post_title);?>" role="region">
<div class="row">
<div class="container">
         <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-3 col-md-6 ">
    <?php
    echo replace_vars(do_blocks($post->post_content),$post->post_name);
    ?>
    </div>
</div>

</div>
<div class="page-footer">&copy;2020 XR IGNITE INC - PLEASE SHARE THIS PUBLICATION!<br><span class="dots"><?php include "images/footer-dots-01.svg";?></div>

</section>

<?php
    }

    $content = ob_get_clean();



?>


<?php



echo $content;
?>
</div>
</main>
<?php

    get_footer();



?>
</body>
</html>