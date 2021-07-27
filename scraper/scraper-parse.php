<?php
    
    if(@$_GET['url']){
        ?>
        <div id="iframe">
					<iframe src="<?=@$_GET['url']?>"></iframe> 
				</div>
   LINK: <a href="<?=@$_GET['url']?>"target="_blank"><?=@$_GET['url']?></a> | <a href="view-source:<?=@$_GET['url']?>" target="_blank">SRC</a>

        <?php
        $other_links = '';  
        $other_meta = '';  
        $meta_data = scrapeLink($_GET['url']);
      

        if(is_array($meta_data)){
                $continue = true;
           
           foreach($meta_data as $key => $value){
              
               $info = new SplFileInfo($_GET['url']);
                if($info->getExtension() == 'pdf'){ // What do we say to pdfs? Not today.
                   
                    ?>
                    <h2>PDF</h2>
                    <form method="post" action="#">
                        <input type="hidden" name="id" value="<?=$_GET['key']?>">
                        <input type="hidden" name="isPDF" value="1">
                        <input type='submit' class="save" value="MARK AS PDF">
                    </form>
                    <?php
                    $continue = false;
                    
                }
                if($value == '400 Bad Request'){ // WHAT WE'VE GOT HERE IS, FAILURE TO COMMUNICATE
                   
                    ?>
                    <h2>ERROR 400 - Scrape Failed</h2>
                    <form method="post" action="#">
                        <input type="hidden" name="id" value="<?=$_GET['key']?>">
                        <input type="hidden" name="error400" value="1">
                        <input type='submit' class="save" value="MARK AS 400 ERROR">
                    </form>
                    <?php
                    $continue = false;
                    
                }
       
                if($continue != false){// HE WANTS IT, WELL, HE GETS IT
                    if($key == 'title'){
                        if(strpos($value,"|")){
                            $t = explode("|",$value);
                            $value = $t[1] ." | " .$t[0];//reverse order of title
                        }
                    
                    print    "<br>Title: ". $title = $value;

                    
                    } else if ($key == 'og:image'){
                        print "<br>".$share_image_url = $value;
                        if(strpos($value, '//') != false){
                        $share_image_url = $value;

                        } else {
                        $share_image_url = $_GET['url'].$value;  
                        }

                        print  $share_image_url;
                    
                    } else if($key == 'lang'){
                        print    "<br>language: ".$language = $value;
                    } else if($key == 'address'){
                        print    $address = $value;
                    } else if($key == 'page'){
                        $page_data = $value;
                    } else  if($key == 'description'){
                        print "<BR>Description:".$description = $value;
                    } else  if($key == 'keywords'){
                        print "<BR>Keywords:".$keywords = $value;
                    } else if ($key == 'twitter:site'){
                    
                        print "<BR>Twitter:". $twitter = str_replace("@","",$value);
                        
                    } else {
                        if(!is_array($value)){
                            $other_meta .= "<br><em>".$key."|".$value."</em>";
                        }
                    }
                }

            }
        }
        if(@$continue != false){

            
            $other_images= '';
            $logo_url = '';
            print '<form name="scraped-images" action="" method="post" id="scraped-images">';
            print "Images<hr><table id='scraped-image-list'>";
            print "<tr><td>Scraped Images</td><td>Logo</td><td>Share Image</td></tr>";
            foreach($meta_data['image_array'] as $key =>$value){
                 if(strpos(strtolower($value['alt']),"logo") || strpos(strtolower($value['src']),"logo")){
                        $logo_url = $value['src'];
                        $logo_checked = " checked";
                    if(!strpos($logo_url,"//")){
                        $logo_url = $_GET['url']."/".$logo_url;
                    } 
                   
                } else {
                    $logo_checked = "";
                }

                if(strpos($value['src'],"//") == false){
                   $value['src'] = @$_GET['url'].$value['src'];
                }
                print '<tr><td><img class="scrape-thumbail" src="'.$value['src'].'"></td>
                <td><input name="logo_url" type="radio" value="'.$value['src'].'"'.$logo_checked.'></td>

                <td><input name="share_image_url" type="radio" value="'.$value['src'].'"></td>
                
                
                </tr>';


               
             
                if(strpos(strtolower($value['alt']),"logo")){
               
                }
            }
            if(@$logo_url != ''){
               // print '<BR>LOGO:'.$logo_url.'<br><img class="form-thumbnail" src="'.$logo_url.'"><BR>';
            } 
            if(@$share_image_url){
                
                //print '<BR>Share Image:'.$share_image_url .'<BR><img class="form-thumbnail" src="'.$share_image_url.'"><BR>';


            } 
            print "</tr></table>
            </form>";
    
            extract(parseLinks($meta_data['link_array']));

            if(@$meta_data['url_content'] != ""){
               $url_content = @$meta_data['url_content'];

               
            }
            if(@$meta_data['contact_url'] != ""){
                print "<br>Contact URL | ".$contact_url = @$meta_data['contact_url'];
                $contact_data = scrapeLink(@$meta_data['contact_url']);

                extract(parseLinks($contact_data['link_array']));
                 $url_content .= $contact_data['url_content'];
            }
            if(@$meta_data['blog_url'] != ""){
                print "<br>Blog URL | ".$blog_url = @$meta_data['blog_url'];
                $blog_data = scrapeLink(@$meta_data['blog_url']);

                extract(parseLinks($blog_data['link_array']));
                $url_content .= $blog_data['url_content'];
            }


            if(@$meta_data['jobs_url'] != ""){
                print "<br>Jobs URL | ".$jobs_url = @$meta_data['jobs_url'];
                $jobs_data = scrapeLink(@$meta_data['jobs_url']);

                extract(parseLinks($jobs_data['link_array']));
                $url_content .= $jobs_data['url_content'];
            }
            if(@$meta_data['apply_url'] != ""){
                print "<br>Application URL | ".$apply_url = @$meta_data['apply_url'];
                $apply_data = scrapeLink(@$meta_data['apply_url']);

                extract(parseLinks($apply_data['link_array']));
                $url_content .= $apply_data['url_content'];
            }
            if(@$meta_data['events_url'] != ""){
                print "<br>Events URL | ".$events_url = @$meta_data['events_url'];
                $events_data = scrapeLink(@$meta_data['events_url']);

                extract(parseLinks($events_data['link_array']));
                $url_content .= $events_data['url_content'];
            }
            if(@$meta_data['conference_url'] != ""){
                print "<br>Conference URL | ".$conference_url = @$meta_data['conference_url'];
                $conference_data = scrapeLink(@$meta_data['conference_url']);

                extract(parseLinks($conference_data['link_array']));
                $url_content .= $conference_data['url_content'];
            }



















            if(@$meta_data['about_url'] != ""){
                print "<br>about URL | ".$about_url = @$meta_data['about_url'];
                $about_data = scrapeLink(@$meta_data['about_url']);

                extract(parseLinks($about_data['link_array']));
                 $url_content .= $about_data['url_content'];
            }
          



            print "<br>Twitter | ".@$twitter;
            print "<br>Facebook | ".@$facebook;
            print "<br>Instagram | ".@$instagram;
            print "<br>YouTube | ".@$youtube;
            print "<br>Vimeo | ".@$vimeo;
            print "<br>Tumblr | ".@$tumblr;
            print "<br>GooglePlus | ".@$google_plus;
            print "<br>Medium | ".@$medium;
            print "<br>Telegram | ".@$telegram;
            print "<br>Slack | ".@$slack;
            print "<br>Skype | ".@$skype;
            print "<br>GitHub | ".@$github;
            print "<br>LinkedIn | ".@$linkedin;
            print "<br>Pinterest | ".@$pinterest;
            print "<br>Behance | ".@$behance;
            print "<br>Flickr | ".@$flickr;
            print "<br>RSS | ".@$rss;
            print "<br>Telephone | ".@$telephone;
            print "<br>email | ".@$email;
            print "<br>Address: ".$address;

    
            $url_content = trim(preg_replace('/\t+/', " ", @$url_content )); //strip line breaks
            $url_content = preg_replace('/\p{C}+/u', "", @$url_content ); //strip line breaks
            
    
    ?>
        </div>
 
       
       
        <hr>
        <strong>META</strong>
        <div class="list-wrap"><BR><?=$other_meta?></div>
        <hr>
        <BR><strong>LINKS</strong>
        <div class="list-wrap"><?=$other_links?></div>
        <hr>
        <strong>Content Blob</strong>
        <div class="list-wrap"><BR><?=@$url_content?></div>
                            

    <?php
    } else {
        ?>
        <h2>Dead Link</h2>
                    <form method="post" action="#">
                        <input type="hidden" name="id" value="<?=$_GET['key']?>">
                        <input type="hidden" name="error404" value="1">
                        <input type='submit' class="save" value="404 Dead Link">
                    </form>
        <?php
    }

 } else {
     
     print "SELECT A LINK ON THE LEFT";
 }
 ?>
