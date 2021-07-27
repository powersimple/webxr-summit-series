<?php

    function getStat($sql,$total=0){
        global $wpdb;
       $wpdb->get_results($sql);
        $count = intval($wpdb->num_rows);
        if($total>0){
            return $count." / ".intval(($count/$total)*100)."%";
        } else {
            return $count;
        }
        
        
    }

    function getStats(){
        $scraped = getStat("select id from omni_data where scraped = 1");
        $total = getStat("select id from omni_data");
        $no_link = getStat("select id from omni_data where no_link = 1",$total);
        $links = intval($total-$no_link);
        $hyperlinks = $links." / ".intval(($links/$total)*100)."%";
            
        return array(
            "total"=>$total,
            "original_records"=>getStat("select id from omni_data where old_key>0",$total),
            "added"=>getStat("select id from omni_data where old_key=0",$total),
            "acquired"=>getStat("select id from omni_data where acquired = 1",$total),
            "pivoted"=>getStat("select id from omni_data where pivoted = 1",$total),
            "defunct"=>getStat("select id from omni_data where defunct = 1",$total),
            "no_link"=>$no_link,
            "hyperlinks"=>$hyperlinks,
            
            "scraped"=>$scraped,
            "errors"=>getStat("select id from omni_data where error404 = 1 or error400=1"),
            "pdfs"=>getStat("select id from omni_data where isPDF = 1"),
            "twitters"=>getStat("select id from omni_data where twitter <> ''",$scraped),
            "facebooks"=>getStat("select id from omni_data where facebook<>''",$scraped),
            "linkedins"=>getStat("select id from omni_data where linkedin<>''",$scraped),
            "instagrams"=>getStat("select id from omni_data where instagram<>''",$scraped),
            "githubs"=>getStat("select id from omni_data where github<>''",$scraped),
            "youtubes"=>getStat("select id from omni_data where youtube<>''",$scraped),
            "vimeos"=>getStat("select id from omni_data where vimeo<>''",$scraped),
            "tumblrs"=>getStat("select id from omni_data where tumblr<>''",$scraped),
            "pinterests"=>getStat("select id from omni_data where pinterest<>''",$scraped),
            "google_pluses"=>getStat("select id from omni_data where google_plus<>''",$scraped),
            "behances"=>getStat("select id from omni_data where behance<>''",$scraped),
            "mediums"=>getStat("select id from omni_data where medium<>''",$scraped),
            "slacks"=>getStat("select id from omni_data where slack<>''",$scraped),
            "telegrams"=>getStat("select id from omni_data where telegram<>''",$scraped),
            "skypes"=>getStat("select id from omni_data where skype<>''",$scraped),
            "flickrs"=>getStat("select id from omni_data where flickr<>''",$scraped),
            "rsses"=>getStat("select id from omni_data where rss<>''",$scraped),
            "emails"=>getStat("select id from omni_data where email <>''",$scraped),
            "phones"=>getStat("select id from omni_data where phone <>''",$scraped),
            
            "share_image_urls"=>getStat("select id from omni_data where share_image_url <>''",$scraped),
            "logo_urls"=>getStat("select id from omni_data where logo_url <>''",$scraped),
            "contact_urls"=>getStat("select id from omni_data where contact_url <>''",$scraped),
            "blog_urls"=>getStat("select id from omni_data where blog_url <>''",$scraped),
        );

    }
?>