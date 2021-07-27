<?php
/*
	THIS MODULE FOLDER "PROFILER" CAN BE DROPPED INTO ANY THEME
	Metaboxes are dependent on Meta Box plugin.

*/


require_once "profiler.admin.php";//WP ADMIN functions including metabox declarations
require_once "profiler.model.php";//Gets the data
require_once "profiler.controller.php";//function that transforms the data
require_once "profiler.view.php";//functions that 



use profiler\ProfilerModel;


function Profiler(){ // THIS IS THE CALL BACK from the MetaBox for Research which uses the MVC declared above.
	$field_list = "URL,title,description,keywords,industry,sector,crunchbase,wikipedia,language,logo_url,share_image_url,logo_svgtag,contact_url,blog_url,apply_url,jobs_url,events_url,conference_url,twitter,facebook,linkedin,github,tumblr,google_plus,medium,telegram,slack,skype,instagram,flickr,youtube,vimeo,pinterest,snapchat,foursquare,behance,rss,email,phone,address,address2,city,state,postal_code,country,location_country,location_province,location_city,url_content";
	global $field_list;

	global $post;
	$model = new ProfilerModel();


?>
	<script>
		/* THIS LOADS DATA AS STATIC JSON FROM PHP */
		var postmeta = <?=json_encode(get_post_meta($post->ID))?>;
		console.log("postmeta",postmeta);
		var taxonomies = <?=json_encode(taxes())?>;
		console.log("taxonomies",taxonomies);
		var terms = <?=json_encode(tax_rel())?>;
		console.log(terms);
		var selectTaxonomies = '';
		jQuery(document).ready(function () {
		   
		});
	</script>
	<div id='admin-card'><ul id='link-list'></ul></div>
		<div id="save"></div>
		<div id="keys"></div>
		<div id="terms">
			<div id="saved-terms"></div>
			<div id="found-terms"></div>
			<div id="term-form"></div>
		</div>

		<div id="scrape-wrap">
		<div id="scrape-menu"></div>
		
		<div id="scrape-results"></div>
		</div>

		<div id="data-results">
			<ol id="results-list"></ol>
			<div id="selection"></div>
			
		</div>
<?php
	

	profilerAction(); //in profiler view, loads menu

	if($url = @$_GET['search']){

		$search_url = getSearchURL();

		$search_results = $model->getJSON($search_url); // native json gets decoded and returned as php
		$results = json_decode($search_results);
		
		$search_results = $model->getJSON($search_url."&start=11");
		$results2 = json_decode($search_results);

		$search_results = $model->getJSON($search_url."&start=21");
		$results3 = json_decode($search_results);

		$items = array_merge($results->items,$results2->items,$results3->items);
	



		


			// reencoded as json.
			?>
			<script>
				var search_results = <?=json_encode($items);?>;//declares returned value as javascript variable
				processResults('<?=@$_GET['search']?>',search_results);

			</script>
			<?php
				print "<br><a href=\"#\" onclick=\"setJSON('search_content',search_results);\">Save Search Results</a>";

	} 

	if($url = @$_GET['scrape']){

		$scrape = $model->getHTML($url);
	//	var_dump($scrape);
			if(is_array(@$scrape)){
			
				$scrape_content = json_encode($scrape);
				?>
				<script>
					var scrape_content = <?=$scrape_content;?>;//declares returned value as javascript variable
					processScrape()
					console.log(scrape_content);
				</script>
				<?php
				print "<br><a href=\"#\" onclick=\"setJSON('scraped_content',scrape_content);\">Save Scraped Content</a>";
			}
    }
}
