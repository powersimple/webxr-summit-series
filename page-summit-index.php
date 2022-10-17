<?php
    get_header();
?>
<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=@$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<main role="main" class="main <?=$section_class?>">
    <div class="row">
        <div class="container">    
            <div id="event-index">


<?php
    $events = "devsummit21,bizsummit21,designsummit21,edsummit22,brandsummit22,prodsummit22";
    eventIndex($events);
?>
            </div>
        </div>
    </div>
</main>


<?php
    get_footer();
?>