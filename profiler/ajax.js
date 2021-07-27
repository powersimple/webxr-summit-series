function scrape(url) {
var data = {
            'action': 'my_action',
            'mission': 'scrape',
			'url': url
		};
    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function (response) {
        console.log('Server says: ' + response);
    });
}
function getImg(src) {
    var data = {
        'action': 'my_action',
        'mission': 'getImg',
        'src': src
    };
    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function (response) {
        console.log('Server says: ' + response);
    });
}
function searchTaxonomy(term){ // called from admin.js when text is highlighted
    var data = {
        'action': 'my_action',
        'mission': 'tax_search',
        'term': term
    };
    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function (response) {
        console.log("AJAX returned:", response);
        termResponse(data.term,response);
    });

}
function addTerm() {
    var term_parent = jQuery('#term-parent').val(),
        term_name = jQuery('#term-name').val()
    console.log("add term", term_parent, term_name)
     var data = {
         'action': 'my_action',
         'mission': 'addTerm',
         'term_parent': term_parent,
         'term_name': term_name
     };
     // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
     jQuery.post(ajaxurl, data, function (response) {
         console.log('Server says: ' + response);
     });
}
function getTaxonomies(json_url){
    //var json_url = 'http: //omniscience.192.168.1.11.xip.io:8900/wp-json/wp/v2/taxonomies?fields=name,slug'

    jQuery.ajax({
        url: json_url, // the url
        data: '',
        success: function (data, textStatus, request) {
            console.log("data", data)
            //      data_loaded.push(callback);
            return data

                //callback(data) // this is the callback that sends the data to your custom function

        },
        error: function (data, textStatus, request) {
            //console.log(endpoint,data.responseText)
        },

        cache: false
    })

}
http: //omniscience.192.168.1.11.xip.io:8900/wp-admin/%20/omniscience.192.168.1.11.xip.io:8900/wp-json/wp/v2/taxonomies?fields=name,slug&_=1552570314025

function termResponse(text,terms) {
      terms = JSON.parse(terms);
      console.log("term response",terms.length+" match(es) found")
      if (terms.length == 0) {
         jQuery("#found-terms").html('No Matches found for "'+text+'" <a href="#" onclick="addTermForm(\''+text+'\')">Add</a>')
      } else {
          jQuery('#found-terms').html(foundTerms(terms))
      }
}
function addTermForm(text){
    var taxonomies = getTaxonomies('/wp-json/wp/v2/taxonomies?fields=name,slug')

    console.log("taxonomies",taxonomies)
    var term_form = '<select name="term-parent" id="term-parent">'
    term_form += '<option value="">Term Parent</option>';

    term_form += '</select>';
    term_form += '<input name="term-name" id="term-name" value="'+text+'">'
    term_form += '<a href="#" onclick="addTerm()">Add '+text+'</a>'
    jQuery("#term-form").html(term_form)
}
function addTerm(){
    var term_parent = jQuery('#term-parent').val(),
    term_name = jQuery('#term-name').val()
    console.log("add term",term_parent,term_name)
}

function foundTerms(terms){
    var results = '<ul>'
    for(t=0;t<terms.length;t++){
        results += '<li>' + terms[t].name + '</li>'
        console.log(terms[t].name)
    }
    results += '</ul>'
    return results;
}

jQuery(function () { // THIS Triggers an event on selection of text.
    jQuery(document.body).bind('mouseup', function (e) {
        var selection;

        if (window.getSelection) {
            selection = window.getSelection();
        } else if (document.selection) {
            selection = document.selection.createRange();
        }

        selection.toString() !== '' && textSelected(selection.toString());

    });
});
function textSelected(text){ // called when text is highlighted.
    console.log(text+" highlighted")
    $terms = searchTaxonomy(text); //this does the AJAX Search in controller
    
    
}
function getStaticJSON(json_url, callback, dest) {
    // route =  the type 
    // param = url arguments for the REST API
    // callback = dynamic function name 
    // Pass in the name of a function and it will return the data to that function

    // local absolute path to the REST API + routing arguments
   
    //console.log("jsonfile",json_data);
    jQuery.ajax({
        url: json_url, // the url
        data: '',
        success: function (data, textStatus, request) {
            console.log("data", callback)
            //      data_loaded.push(callback);
            return data,

                callback(data, dest) // this is the callback that sends the data to your custom function

        },
        error: function (data, textStatus, request) {
            //console.log(endpoint,data.responseText)
        },

        cache: false
    })
}