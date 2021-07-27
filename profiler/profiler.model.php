<?php



namespace profiler;

use DOMDocument;



class ProfilerModel {

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
    public function getJSON($url, $timeout = 10) {
        
        $json = $this->curl($url, $timeout);
       
        return $json;
    }



    public function getHTML($url, $tags = array ('description', 'keywords'), $timeout = 10) {
        
        $html = $this->curl($url, $timeout);
        if (!$html) {
            return false;
        }

        $doc = new DOMDocument();
        @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$html);
    

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
        $html_data = [];
          

        
        $lang = $doc->getElementsByTagName('html');
        $html_data['lang'] = @$lang->item(0)->getAttribute('lang'); // gest the language attribute from the html tag
                
       
        
        $html_data['link_array'] = [];
        $html_data['image_array'] = [];
        $html_data['svg_array'] = $doc->getElementsByTagName('svg');
        
        $html_data['meta'] = [];
        
        $logo = $doc->getElementById('logo');

        if(@$logo){
         print $html_data['logo_svgtag'] = $logo->tagName;
        }

     


        
        $metas = $doc->getElementsByTagName('meta');
       
        //META
        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
     
            if ($name = $meta->getAttribute('name')) {
                    $html_data['meta'][] = array("name"=>$name, "property" => trim($meta->getAttribute('content')));
            }
        }
        

        //LINKS
        foreach($doc->getElementsByTagName('a') as $link) {
           $html_data['link_array'][] = array('href' => $link->getAttribute('href'), 'text' => trim($link->nodeValue));
        } 

        //IMAGES
        foreach($doc->getElementsByTagName('img') as $link){
            $html_data['image_array'][] = array('src' => $link->getAttribute('src'), 'alt' => $link->getAttribute('alt'));
        }


        //TAGS
        $tag_list = array("title","h1","h2","h3","h4","h5","h6","p","li","blockquote","address");
        $content_array = array();
        foreach($tag_list as $tag){
                $content_array[$tag] = array();
                foreach($doc->getElementsByTagName($tag) as $link) {
                    $this_text = $link->nodeValue;
                
                    $content_array[$tag][] = strtolower(strip_tags(trim($this_text)));

            }

        }

        $html_data['content'] = $content_array;      
        
        return $html_data;
        
    }
}
?>