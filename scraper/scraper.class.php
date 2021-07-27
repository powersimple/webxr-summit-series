<?php





namespace diversen;

use DOMDocument;

/**
 * Class based on this answer found on stackoverflow
 * http://stackoverflow.com/questions/3711357/getting-title-and-meta-tags-from-external-website
 */

class meta {

    /**
     * Curl the document
     * @param string $url
     * @param int $timeout
     * @return string $data
     */
    private function curl($url, $timeout) {
        $ch = curl_init();

        $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
    
    /**
     * 
     * @param string $url
     * @param array $tags array ('description', 'keywords')
     * @param int $timeout seconds
     * @return mixed false| array
     */

    public function getMeta($url, $tags = array ('description', 'keywords'), $timeout = 10) {
        
        $html = $this->curl($url, $timeout);
        if (!$html) {
            return false;
        }
        $image_array = array();
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
    

        $script = $doc->getElementsByTagName('script');

        $remove = [];
        foreach($script as $item)
        {
            $remove[] = $item;
        }

        foreach ($remove as $item)
        {
            $item->parentNode->removeChild($item); 
        }

        $doc->saveHTML();


        $title = $doc->getElementsByTagName('title');
        $lang = $doc->getElementsByTagName('html');
        $addr = $doc->getElementsByTagName('address');
        $logo = $doc->getElementById('logo');
                
       
       


        
        foreach($doc->getElementsByTagName('img') as $link){
            $image_array[] = array('src' => $link->getAttribute('src'), 'alt' => $link->getAttribute('alt'));
        }

      
        // Get and display what you need:
        
        $ary = [];
      
        $ary['title'] = @$title->item(0)->nodeValue;
        $ary['lang'] = @$lang->item(0)->getAttribute('lang');
        
        $ary['address'] = @$addr->item(0)->nodeValue;
        $ary['contact_url'] = "";
        
        if(@$logo){

         print $ary['logo_svgtag'] = $logo->tagName;
        }


        
        $metas = $doc->getElementsByTagName('meta');
    
        
        $link_array = array();
    //Loop through each <a> and </a> tag in the dom and add it to the link array
    foreach($doc->getElementsByTagName('a') as $link) {
        $this_link =$link->getAttribute('href');
        $this_text = $link->nodeValue;
        if($this_link != ""&& $this_text != ""){
            if(strpos(strtolower($this_link),"contact") || strpos(strtolower("contact"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['contact_url'] = $this_link;
                
            }

            if(strpos(strtolower($this_link),"blog") || strpos(strtolower("blog"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['blog_url'] = $this_link;
                
            }


            if(strpos(strtolower($this_link),"jobs") || strpos(strtolower("jobs"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['jobs_url'] = $this_link;
                
            }

            if(strpos(strtolower($this_link),"apply") || strpos(strtolower("apply"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['apply_url'] = $this_link;
                
            }


            if(strpos(strtolower($this_link),"events") || strpos(strtolower("events"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['events_url'] = $this_link;
                
            }


            if(strpos(strtolower($this_link),"conference") || strpos(strtolower("conference"),$this_text)){
                if(!strpos($this_link,"//")){
                    $this_link = $url.$this_link;
                }
                

                $ary['conference_url'] = $this_link;
                
            }


            













        }


        $link_array[] = array('url' => $this_link, 'text' => $this_text);

    }
    $siphon = array("h1","h2","h3","h4","h5","h6","p","li","blockquote");
    $content = '';
    foreach($siphon as $tag){
            foreach($doc->getElementsByTagName($tag) as $link) {
            $this_text = $link->nodeValue;
            


            $content .= " ".strtolower(strip_tags($this_text));

        }


    }

     $ary['url_content'] = $content;      
     $ary['link_array'] = $link_array;
     $ary['image_array'] = $image_array;

        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
           

            
            

                if ($name = $meta->getAttribute('name')) {
                    $ary[$name] = $meta->getAttribute('content');
                }
                if ($property = $meta->getAttribute('property')) {
                    $ary[$property] = $meta->getAttribute('content');
                }

            
        }
        
        return $ary;
        
    }
}
?>