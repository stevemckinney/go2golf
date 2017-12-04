<?php
/*
Plugin Name: Locup - Search
Description: What's around me? Find places near a searched location, within a radius or by name.
Version:     0.0.1
Plugin URI:
Author:      Jakub Wawszczyk
Author URI:  http://goandgolf.co.uk
Text Domain: locup-search
*/

/*
	Activate & Deactivate setup stuff.
 */

 register_activation_hook( __FILE__, 'locupSetup' );
  if (!function_exists('locupSetup')) { function locupSetup() {

	// Create DB table for cached searches.
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'locup_history';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		query text NOT NULL,
		latitude decimal(9, 6) NOT NULL,
		longitude decimal(9, 6) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}}

 // 	Function lcp_updateCache
 // 	 	Run through all places (posts) and cache their location, title and ID.
 // 	 	Run on installation, auto-runs when posts are inserted & updated.
 register_activation_hook( __FILE__, 'lcp_updateCache' );
 if (!function_exists('lcp_updateCache')) { function lcp_updateCache() {

	set_time_limit(0);

	// @TODO - set the correct post type & map lat & long fields.
 	$postType = 'product';
 	$fieldLat = 'course_latitude';
 	$fieldLng = 'course_longitude';


 	// Ensure custom fields are available.
 	if (!function_exists('get_field')) return false;

 	// Hold a list of all locations (posts) on the format we need.
 	$places = array();

 	// This is very memory intensive, so limit each query to 100 posts.
 	$postsCount = 50;
 	$i = 0;
 	while ($postsCount === 50) {

 		$offset = 50 * $i;

 		// Get all posts with the type $postType.
 		$args = array(
 	    	'post_type'=> $postType,
 	    	'order'    => 'ASC',
 			'posts_per_page' => 50,
 			'offset' => $offset
 	    );

 		// Run query.
 		// Loop through results.
 		$theQuery = new WP_Query( $args );
 		if($theQuery->have_posts() ) : while ( $theQuery->have_posts() ) {
 			$theQuery->the_post();

 			// We need an ID, location and title of the post.
			$postID = get_the_ID();
			$lat = get_field( $fieldLat, $postID );
			$lng = get_field( $fieldLng, $postID );

			// Set data.
 			$postData = array(
 				'ID' => $postID,
 				'latLngRadians' => array(
 					deg2rad( floatval($lat) ),
 					deg2rad( floatval($lng) ),
 				),
 				'title' => strtolower(get_the_title()),
 			);

 			$places[] = $postData;

 		} endif; // end loop.

 		$postsCount = $theQuery->post_count;
 		$i++;
 		wp_cache_flush();
 	}

 	update_option('locup_places', $places); // Used during location search. Must be an array.

 }}


/*
	ADMIN

	Create an admin page.
 */
if (is_admin()) {

	// Admin page functionality.
	require_once(plugin_dir_path( __FILE__ ) . 'functionality/init_admin.php');
	add_action('admin_menu', 'lcp_admin_menu');
	add_action('admin_init', 'locup_init');

	/**
	 * Hook into post saving - we need lat & long values to update.
	 * @param int $post_id The post ID.
	 * @param post $post The post object.
	 * @param bool $update Whether this is an existing post being updated or not.
	 */
	function locup_postSaved($postID, $post, $update) {

		$postType = get_post_type($postID);
		$postStatus = get_post_status($postID);

		// If this isn't a location post type, don't update it.
		// @TODO Post type set here.
		if ( "product" != $postType ) return;

		// All stored places.
		$places = get_option('locup_places');
		if (!$places) $places = array();

		// Loop through all of the places and find the one.
		$placeID = false;
		foreach ($places as $placeKey => $place) { if ($place['ID'] == $postID) $placeID = $placeKey; }


		if ($postStatus == 'trash') unset($places[$placeID]);
		else if ($postStatus == 'publish') {

			// New place.
			$lat = get_field('course_latitude', $postID);
			$lng = get_field('course_longitude', $postID);
			$newPlace = array(
				'ID' => $postID,
				'latLngRadians' => array(
 					deg2rad( floatval($lat) ),
 					deg2rad( floatval($lng) ),
 				),
				'title'  => get_the_title($postID),
			);


			// If this is an update, find the entry in the option and update it.
			// Otherwise, add it to the array and update the option.
			if ($update) {

				if ($placeID !== false) $places[$placeID] = $newPlace;
				else $places[] = $newPlace;
			}
			else $places[] = $newPlace;
		}

		// Update the option field.
		update_option('locup_places', $places);
	}

	// Add action to saved post.
	add_action( 'save_post', 'locup_postSaved', 10, 3 );
}


/*
	CLIENT

	Hook into search functionality.
 */

 function locup_searchChange($query) {

	 if (!$query->is_main_query()) return;

	 // Dependencies.
	 require_once(plugin_dir_path( __FILE__ ) . './functionality/helpers.php');

	 // @TODO Post type set here.
     if (!empty($query->query['s']) && $query->query['post_type'] === 'product') {

		 // Make the searched term usable in places like breadcrumbs.
		 add_action('wp', 'locup_tidy');

		 // Unset search.
		 $searchTerm = $query->query['s'];
		 $query->set('s', '' );
 	   //   unset( $query->query['s'] );

		 // Lookup.
		 $postIds = array_keys(lcp_findPlaces($searchTerm));

		// this is the actual query manipulation.
		$query->set('orderby', 'post__in');
		$query->set('post__in', $postIds);

     }

	 // Done.
     return $query;

 }
 if (!is_admin()) add_action('pre_get_posts', 'locup_searchChange', 1000); // Low priority, WooCom overrides this if its high priority.


 // Make the searched term usable in places like breadcrumbs.
 function locup_tidy() {
	$query = urldecode($_GET['s']);
	set_query_var('s', $query);
 }
