<?php

/*
	Helpers for location functionality.
	Geocoding, API calls, distance finder etc.
 */

	// Function lcp_matchTitle
	// 	Return a number of matched words in the title.
	// 	Uses a blacklist of ignored words.
	if (!function_exists('lcp_matchTitle')) { function lcp_matchTitle($title, $searchQuery) {

		// Each matched word increments the title score multiplier value.
		// i.e. - 3 matched title words will multiply the distance score by 3.
		// The title score is then added to the distance score to get the final score.

		// First, let's get a list of neutral words (ignore them).
		// We need an array. The list is currently a comma separated string.
		$blacklist = get_option('locup_blacklist');
		$blacklist = preg_replace('/\s+/', '', $blacklist);
		$blacklist = explode(',', $blacklist);


		// Also turn title string into an array of words.
		// Turn searchQuery into an array of words.
		$title = explode(' ', $title);
		$searchQuery = explode(' ', $searchQuery);

		// Word matching.
		// All titles are normalised to lower case when cached.
		$matchedCount = 0;
		foreach ($searchQuery as $word) {
			$word = strtolower($word);
			if (in_array($word, $blacklist)) continue;

			if (in_array($word, $title)) $matchedCount++;

		}

		// Done.
		return $matchedCount;

	}}


	// Function lcp_findPlaces
	// 	Gets the searched address lat & long.
	// 	Retrieves the places list from the DB.
	// 	Orders places by distance from the searched address & optional title match.
	if (!function_exists('lcp_findPlaces')) { function lcp_findPlaces($address) {

		if (!is_string($address)) return false;

		// Get lat & long from searched address.
		$latLng = lcp_degToRadians(lcp_getLatLng($address));

		// Get a list of places.
		$places = get_option('locup_places');

		// Sort places by distance from the address.
		$sortedPlaces = [];
		if ($latLng && $places) $sortedPlaces = lcp_findNearby($latLng, $places, $address);

		// Done.
		return $sortedPlaces;

	}}

	// Function lcp_degToRadians
	// 	Convert from lat & long degrees to radians.
	if (!function_exists('lcp_degToRadians')) { function lcp_degToRadians($latLngDeg) {
		return array(
			deg2rad($latLngDeg[0]),
			deg2rad($latLngDeg[1])
		);
	}}


		// 	Function lcp_getLatLng
		// 	 	Figures out lat and long values of an address, uses Google API.
		// 		Returns array [lat, long].
		if (!function_exists('lcp_getLatLng')) { function lcp_getLatLng($query) {

			// Check whether there is a log of this query in the DB.
			$latLng = lcp_checkQuery($query);
			if ($latLng) return $latLng;

			// Turn the address URL friendly.
			$address = str_replace(" ", "+", $query);
			$address .= ',great+britain'; // needs an update if used for other countries.

			// Create the URL.
			$key = get_option('locup_google_key');
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=" . $key;

			// Hit the API.
			// Decode the response.
			$json = file_get_contents($url);
		    $response = json_decode($json);

			// Found address is saved in DB.
			if ($response->status !== "ZERO_RESULTS") {

				global $wpdb;

				// Grab the Lat & Long values from the response. Thanks Google.
				$lat = $response->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
			    $long = $response->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

				// Save in DB for future use.
				lcp_saveResponse($query, $lat, $long);

				// Done.
				return [$lat, $long];
			}
			else return false;

		}}



		// Function lcp_saveResponse
		// 	Saves an address with the corresponding Lat & long values.
		if (!function_exists('lcp_saveResponse')) { function lcp_saveResponse($address, $lat, $lng) {

			global $wpdb;

			// Address into an array.
			$address = strtolower($address);

			// Insert in the table.
			$wpdb->insert(
				$wpdb->prefix . 'locup_history',
				array(
					'query' => $address,
					'latitude' => $lat,
					'longitude' => $lng
				)
			);

		}}


		// Function lcp_checkQuery
		// 	Check weather a searched query has been logged before.
		if (!function_exists('lcp_checkQuery')) { function lcp_checkQuery($query) {

			global $wpdb;

			// Address into an array.
			$query = strtolower($query);

			// Insert in the table.
			$table = $wpdb->prefix . 'locup_history';
			$SQLQuery = "SELECT * FROM $table WHERE query = '$query'";
			$result = $wpdb->get_row($SQLQuery, ARRAY_A);

			if ($result !== null) return array($result['latitude'], $result['longitude']);
			else return false;

		}}


		// Function lcp_findNearby
		// 	Orders a list of places by their distance from a specified address (lat & lng).
		// 	$places - array [[ID, latLngRadians, title, ...], ...];
		// 	Returns array [closestPlaceID => distance, furtherAwayPlaceID => distance, ...].
		if (!function_exists('lcp_findNearby')) { function lcp_findNearby($fromLatLng, &$places, $address, $radius = 0) {

			$matchTitle = get_option('locup_match_title');

			// List of places ordered by distance, including their distance in miles.
			$sortedPlaces = array();

			// Loop through each place and find out its distance from the address.
			foreach ($places as $place) {
				// Get the distance of this place from the address.
				// Skip places outside of the searched radius.
				$distance = lcp_closestDistance($fromLatLng, $place['latLngRadians']);
				// if ($radius !== 0 && $distance > $radius) continue; // Future use. Allow radius filter.

				// ID => distance array.
				$sortedPlaces[$place['ID']] = array(
					'distance' => $distance,
					'matchedWords' => $matchTitle ? lcp_matchTitle($place['title'], $address) : false
				);
			}

			// Sort by distance, Low to high.
			uasort($sortedPlaces, 'lcp_sortScores');

			// Done.
			return $sortedPlaces;

		}}


		// Function lcp_sortScores
		// 	Sorts places by score using distance and title match.
		 if (!function_exists('lcp_sortScores')) { function lcp_sortScores($placeA, $placeB) {
;
			 // Does place A have more matched words?
			 // Is place A closer?
			 // Title match weights more than proximity to address.
			 $scoreA = ($placeA['matchedWords'] !== false && $placeB['matchedWords'] !== false) ?
			 	 ($placeA['matchedWords'] - $placeB['matchedWords']) * 2
				 : 0;
			 $scoreA += ($placeB['distance'] - $placeA['distance']) > 0 ? 1 : -1;

			 return $scoreA < 0;

		}}


		// Function lcp_closestDistance
		// 	Calculates the great-circle (shortest) distance between two points, with
		// 		the Vincenty formula.
		// 	Returns int Distance between points in [miles](same as earthRadius)
		 if (!function_exists('lcp_closestDistance')) { function lcp_closestDistance($latLngA,  $latLngB) {

			// Earth's radius. Use the meausre you'd like to get back.
			// Rarius in miles gives distance in miles. Radius in meters gives distance in metre.
			$earthRadius = 3959; // Miles.

			$lngDelta = $latLngB[1] - $latLngA[1];

			// Great circle distance formula (source of the math - Wikipedia).
			$a = pow(cos($latLngB[0]) * sin($lngDelta), 2) + pow(cos($latLngA[0]) * sin($latLngB[0]) - sin($latLngA[0]) * cos($latLngB[0]) * cos($lngDelta), 2);
			$b = sin($latLngA[0]) * sin($latLngB[0]) + cos($latLngA[0]) * cos($latLngB[0]) * cos($lngDelta);

			// Calculate the arc tangent of the vars $a and $b.
			$angle = atan2(sqrt($a), $b);

			// Done - arc tangent times sphere's radius gives back distance.
			return $angle * $earthRadius;

		}}
