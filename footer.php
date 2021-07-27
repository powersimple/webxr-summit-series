<footer class="footer">






        <div class="container">
            <div class="row">
                <div class="col-sm-3">

                    <span class="copyright font-alt"><span>&copy; <?=  date("Y")?> Powersimple, LLC - </span><span> All
                            Rights Reserved</span></span>
                </div>
                <div class="col-sm-9" id="footer-menu">
                    <ul>
                        <li><a href="/about/">About</a></li>
                        <li><a href="/sponsors/">Become a Sponsor</a></li>
                    </ul>

                  
                </div>

            </div>
           
        </div>
         <div class="partners">
                        <ul class="container">
                            <li>PARTNERS
                            <li><a target="_blank" class="awe" href="https://www.awexr.com/usa-2021/auggie/">
                                    Auggies Nomination Deadline September 8</a></li>
                            <li><a class="awe" target="_blank"
                                    href="https://augmentedworldexpo.secure.force.com/BuyTicket?id=7011H000001PEjd&partner=webxrsummits">Nov 9 -11</a></li>

                            <li><a class="vrara" target="_blank" href="https://www.vrarglobalsummit.com/">VR/AR Global Summit</a></li>
                            <li><a target="_blank" class="futurewei" href="https://futurewei.com/">Futurewei
                                    Technologies</a></li>

                            </li>
                        </ul>

                    </div>
    
</footer>

<script src="<?php echo get_stylesheet_directory_uri()?>/assets/lib/jquery/dist/jquery.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>


<script src="<?php echo get_stylesheet_directory_uri()?>/vendor.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/assets/js/plugins.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/assets/js/main.js"></script>
<!--   <script src="<?php echo get_stylesheet_directory_uri()?>/main.min.js"></script>-->
<script>
    /*
   // drawer accordion
    jQuery("#menu").click(function () {

        jQuery(".sidedrawer").animate({
            left: 0,
            opacity: 1
        }, 500);
        jQuery("body").animate({
            marginLeft: 250,
        }, 500);
        jQuery("#menuclose").show();
        jQuery(this).hide();
    });

    jQuery("#menuclose").click(function () {
        jQuery(".appswitchdropdown").hide();
        jQuery(".sidedrawer").animate({
            left: -250,
            opacity: 1
        }, 300);
        jQuery("body").animate({
            marginLeft: 0,
        }, 300);
        jQuery("#menu").show();
        jQuery(this).hide();
    });

    jQuery(".appswitch").click(function () {
        jQuery(".appswitchdropdown").toggle();
    });
    jQuery(".page").hover(function () {
        jQuery(".appswitchdropdown").hide();
    });
    jQuery(".appconversation").click(function () {
        jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").hide();
        jQuery(".convo").show();
        jQuery("body").css({
            marginLeft: 0,
        }, 500);
    });

    jQuery(".convo").click(function () {
        jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").show();
        jQuery(".convo, .trendscontent ").hide();
        jQuery("body").css({
            marginLeft: 250,
        }, 500);
    });

    jQuery(".appstudio").click(function () {
        jQuery(".spark, .sparkcontent, .sparklist").hide();
        jQuery(".studio, .studiolist").show();
        jQuery('#logo').css('background-position', '0px 0px');
        jQuery('.appswitch').css('background-position', '0px 0px');
    });



    jQuery(".collapse").click(function () {
        jQuery(".collapse").hide();
        jQuery(".expand").show();
        jQuery('.sidedrawer').css('width', '60px');
        jQuery(".sparklist div, .appswitch").css({
            width: 50,
        }, 500);

        jQuery("body").animate({
            marginLeft: 60,
        }, 500);


    });

    jQuery(function () {
        jQuery("#accordion").accordion({
            autoHeight: true
        });
    });

    */
</script>
<?php wp_footer(); ?>



</body>

</html>