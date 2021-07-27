/*var reload_check = false; var publish_button_click = false;
jQuery(document).ready(function ($) {
    add_publish_button_click = setInterval(function () {
        $publish_button = jQuery('.edit-post-header__settings .editor-post-publish-button');
        if ($publish_button && !publish_button_click) {
            publish_button_click = true;
            $publish_button.on('click', function () {
                var reloader = setInterval(function () {
                    if (reload_check) { return; } else { reload_check = true; }
                    postsaving = wp.data.select('core/editor').isSavingPost();
                    autosaving = wp.data.select('core/editor').isAutosavingPost();
                    success = wp.data.select('core/editor').didPostSaveRequestSucceed();
                    console.log('Saving: ' + postsaving + ' - Autosaving: ' + autosaving + ' - Success: ' + success);
                    if (postsaving || autosaving || !success) { classic_reload_check = false; return; }
                    clearInterval(reloader);

                    value = document.getElementById('metabox_input_id').value;
                    if (value == 'trigger_value') {
                        if (confirm('Page reload required. Refresh the page now?')) {
                            window.location.href = window.location.href + '&refreshed=1';
                        }
                    }
                }, 1000);
            });
        }
    }, 500);
});*/
        var content_object = {}
        var string_array = []
        var corpus = ''
var clean_string = "a,an,as,at,before,but,by,for,from,is,in,into,like,of,off,on,onto,per,since,than,the,this,that,to,up,via,with,he,she,it,I,you,you've, your,we,they,him,her,his,hers,our,ours,theirs,its,it's,itself,himself,herself,themselves,not,will,won't,can,can't,within,where,when,who,what,how,why,there,then,they're,have,haven't,not,push,pull,put,get,gave,give,got,gotten,same,similar,through,and,or,feel,felt,be,was,were,we're,between,bring,brought,bringing,if"
        clean_string = clean_string.replace(", ",",")
        clean_array = clean_string.split(",")

		function setJSON(field, data) {
		    console.log(field, data)
		    jQuery('#' + field).val(JSON.stringify(data)); //prints the json as text into the text area.
		}
        function setMeta(field, data) {
            console.log(field, data)
            jQuery('#' + field).val(data); //prints the json as text into the text area.
        }
		function processResults(search, results) {
		    console.log("process", search, search_results);

		    refreshResultsList()
        }
        function showSavedTerms(){
            var saved_terms = '<ul>';
            for(t in terms){
                saved_terms += "<li>"
                saved_terms += '<span class="cat-title">'+t+'</span>'

                if(terms[t].length>0){saved_terms += '<ul>'}
                for(var i=0;i<terms[t].length;i++){

                     saved_terms += "<li>"
                     saved_terms += terms[t][i].name
                     saved_terms += "</li>"
                }

                if (terms[t].length > 0) {saved_terms += '</ul>'}
                

              
                saved_terms += "</li>"
            }
            saved_terms +="</ul>"
            jQuery("#saved-terms").html(saved_terms)
        }
		function processScrape() {
            
            var keys = "";
            var key_label = ''
                for (i in scrape_results) {
                    var count = "("+scrape_results[i].length+")"
                    if (count || !jQuery.isEmptyObject(scrape_results[i])) {
                        if(i == 'lang'){ 
                                jQuery('#lang').val(scrape_results[i]);
                        } else {
                            keylabel = i.replace("_array","s",i)  
                            if(count == undefined){
                                count = '()'
                            } 
                            keys += '<li data-item="0" onclick=\"selectScrapeKey(\'' + i + '\');\">' + keylabel + ' '+count+'</li>';
                            console.log("Scrape Results",scrape_results[i])
                        jQuery('#keys').html(keys);
                        }
                    } else {

                    }
                }

                jQuery('#keys').html(keys);
              
        }
        function selectScrapeKey(key){
            console.log("key",key)
           var var_type  = jQuery.type(scrape_results[key]);
           var list = ''
           var this_item = ''
            if(var_type == 'array'){
                jQuery("#saved-terms").html('')

                for (var i = 0; i<scrape_results[key].length;i++){

                    switch(key){
                        case "link_array": this_item = displayLinkObject(scrape_results[key][i])
                        break
                        case "image_array": this_item = displayImageObject(scrape_results[key][i])
                        break
                        case "svg_array": this_item = displaySVGObject(scrape_results[key][i])
                        break
                        case "meta": this_item = displayMetaObject(scrape_results[key][i])
                        break
                       
                        break
                    }
                    if (this_item != undefined) {
                        list += '<li class="result">' + this_item + '</li>'
                    }
                    console.log(key,var_type,i, scrape_results[key][i])
                }
            } else if(var_type == 'object'){
                if(key == 'content'){
                    showSavedTerms()
                    content_object = {} // resests to  empty before loop
                    corpus = '' // resests to  empty before loop
                    for (i in scrape_results[key]) {
                        this_item = displayContentObject(i, scrape_results[key][i])
                         if(this_item != undefined){
                            list += '<li class="result">' + this_item + '</li>'
                        }
                    }
                    console.log("clean_array",clean_array);
                    for(s=0;s<string_array.length;s++){
                        
                        if (clean_array.indexOf(string_array[s]) === -1 && isNaN(string_array[s]) && string_array[s] !="") {

                            if(content_object[string_array[s]] == undefined){
                                content_object[string_array[s]] = 1
                            } else {
                                content_object[string_array[s]] += 1

                            }
                        }
                    }

                    console.log("content object",content_object)
                    console.log("string array", string_array)
                    console.log("corpus", corpus)
                }
               
                    
                   
                 
            }

            

            jQuery('#scrape-results').html(list);
        }
        function buildContentArray(tag,content){
            corpus +=content+' ';
            content = content.replace("."," ")
content = content.replace(/^[a-z\d\-_\s]+$/i, "")
            string_array = string_array.concat(content.split(" "))
           
           
         
         
           

        }
        function cleanLink(url){
            console.log("before",url.indexOf('http'), "url=" + url)
            if (url.indexOf('//') == -1) { //checks if link
        
               

                url = postmeta.url + url
                url = url.replace("http://", "http:||")
                url = url.replace("https://", "https:||")
                url = url.replace("//", "/")
                url = url.replace("http:||", "http://")
                url = url.replace("https:||", "https://")
             }
            console.log("after",url.indexOf('http'), "url=" + url)
             return url

        }
            function displayMetaObject(meta) {
                console.log("meta",meta)
                return meta.name + ' ' + meta.property
            }
    


            function displayContentObject(tag,tag_array) {
                if(tag_array.length>0){
                  var content = '<li class="tag"><ul>'+tag;
                    
                  for(i=0;i<tag_array.length;i++){
                        
                        buildContentArray(tag,tag_array[i] );
                        content += '<li class="tag-item">' + tag_array[i] + '</li>';
                     
                  }
                  content += '</ul></li>'
                  return content;
                }
            }
            function displaySVGObject(link) {
               console.log("svg",svg)
            }

        function displayLinkObject(link){
            var href = cleanLink(link.href);
            return '<a href="'+href+'" target="_blank">'+link.text+'</a>';
        }
         function displayImageObject(img) {
           
             var src = cleanLink(img.src);
             if(src !=''){
                var addLink = '<a href="#" onclick="getImg(\'' + src + '\')">add to media library</a>';
                 return '<span class="admin-img-wrap"><img src="' + src + '" onclick="setImage(\''+img.src+'\',\''+img.alt+'\')" alt="'+img.alt + '">'+addLink+'</span>';
                 
             }
         }
         function setImage(src,alt){

         }

		function refreshResultsList() {
		    var list = "";
		    for (i = 0; i < search_results.length; i++) {

               
                    
               
                    list += '<li data-item="0" onclick=\"selectSearchItem(' + i + ');\">' + search_results[i].title + '</li>';
                
                
                

		    }
		    //console.log(list);
		    jQuery('#results-list').html(list);

        }
        
        function scrapedResults() {
          

        }

		function wrap(tag, value, attribs) {
		    return '<' + tag + ' ' + attribs + '>' + value + '</' + tag + '>'
		}

		function saveSearchResultsLink() {
		    return '<a href="#" onclick=\"setMeta(\'search_content\',search_results);\">SAVE SEARCH RESULTS</a>';
		}

		function spliceItem(i) {
		    search_results.splice(i, 1);
		    console.log(search_results);
		    refreshResultsList();
		    jQuery('#save').html(saveSearchResultsLink());
		}

		function selectSearchItem(i) {

		    console.log("list item", search_results[i]);
		    var card = wrap("h4", search_results[i].title, '');
            //card += wrap("h5", search_results[i].link, '');
            card += '<a href="'+ search_results[i].link+'" target="blank">'+search_results[i].link+'</a><br>'
            card += '<a href="#" onclick="scrape(\''+ search_results[i].link+'\')"> Scrape</a><br>'
            
            card += '<a href="#" onclick="spliceItem(' + i + ');">DEL</a> | ';
            card += '<a href="#" onclick="setMeta(\'url\',\'' + search_results[i].link + '\');" title="' + search_results[i].link + '">Set as URL</a>';
            






		    jQuery('#selection').html(card);
		}

		function detectProfileURL() {

		}

		function cardLinks() {
		    var links = "";
		    for (var field in postmeta) {
		        if (postmeta[field][0].indexOf('http') === 0) { //checks if link
		            console.log(field, postmeta[field][0]);
		            links += "<li><a href='" + postmeta[field][0] + "' target='_blank'>" + field + "</a></li>"

		        }

		    }
		    console.log(links);
		    jQuery('#link-list').html(links);
		}
		jQuery(document).ready(function () {
		   // cardLinks();
		});

function getOEmbed(q, callback) {
    console.log("search", q);
    var url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyAS1V2NbsBFRQpC_AEuxeAVkSiyeNig6Os&cx=005354076002282767293:_ejv69cuyvk"
    var api_query = url + "&q=" + q
    /*
    jQuery.ajax({
        url: api_query, // the url
        data: '',
        success: function (data, textStatus, request) {
            console.log("results:", data)
            //      data_loaded.push(callback);
            return data,

                callback(data) // this is the callback that sends the data to your custom function

        },
        error: function (data, textStatus, request) {
            //console.log(endpoint,data.responseText)
        },

        cache: false
    })
    */
}




function getSearch(q, callback) {
    console.log("search",q);
    var url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyAS1V2NbsBFRQpC_AEuxeAVkSiyeNig6Os&cx=005354076002282767293:_ejv69cuyvk"
    var api_query = url + "&q=" + q

    jQuery.ajax({
        url: api_query, // the url
        data: '',
        success: function (data, textStatus, request) {
            console.log("results:", data)
            //      data_loaded.push(callback);
            return data,

                callback(data) // this is the callback that sends the data to your custom function

        },
        error: function (data, textStatus, request) {
            //console.log(endpoint,data.responseText)
        },

        cache: false
    })
}

console.log("ADMIN JS IS LOADED");

function setSearchOptions(label, data) {

    var search_string = label + ' '
    var search_array = [label]
    for (d in data) {

        if (jQuery.isNumeric(data[d])) {

        } else {
            search_string += data[d] + " ";
            search_array.push(search_string)

        }

    }
    console.log(search_array)
    var options_list = "<ul>"
    for (s = 0; s < search_array.length; s++) {
        options_list += '<li>' + search_array[s] + '</li>'
    }
    options_list += '</ul>'
    options_list += "<input type='text' name='q' value='' id='q'>"
    options_list += "<button type='button' id='search'>Search</button>"
    console.log(options_list)
    jQuery("#search-options").html(options_list);

}
function setSearchResults(data) {
    var results = data.items
    var result_list = '<ol>'
    for (var r = 0; r < results.length; r++) {
        result = results[r]
        console.log("display-link", result.displayLink,
            "link", result.link,
            "title", result.title,
            "snippet", result.snippet
        )
        result_list += "<li>"
        result_list += "<strong>" + result.title + "</strong><br>"
        result_list += '<a href="//' + result.displayLink + '" target="_blank">' + result.displayLink + "</a>"
        result_list += "<p>" + result.snippet + "</p>"
        result_list += "</li>"

    }
    result_list += "</ol>"
    jQuery("#search-results").html(result_list);

}


