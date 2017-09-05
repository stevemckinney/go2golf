<?php 

require_once('internal-helpers.php');

function get_user_review_count($post_id) {

	if(!$post_id) {
		trigger_error('No post ID supplied to function', E_USER_ERROR);
	}

	$reviews = get_user_reviews($post_id);

	return count($reviews);
}

function get_user_review_average($post_id, $include_difficulty_in_rating = false) {

	if(!$post_id) {
		trigger_error('No post ID supplied to function', E_USER_ERROR);
	}

	// Get the associated reviews meta for the review ID / post
	$reviews = get_user_reviews($post_id); // Get post reviews

	// Init average rating for the course
	$average_course_rating = 0;

	// Init total of the average number of user ratings by criteria
	$total_of_average_user_ratings = 0;

	// Set the index key number for the "difficulty" criterion
	$difficulty_criterion_index_key = 2;

	// For every complete review
	foreach ($reviews as $review_key => $review_set) {

		if (!$include_difficulty_in_rating) {
			unset($review_set['rating_score'][$difficulty_criterion_index_key]);
		}

		$rating_total = 0;
		$average_rating_for_review = 0;

		// Isolate the user criteria ratings array from the review array
		$user_criteria_ratings = $review_set['rating_score'];

		// Count the number of broken down user criteria ratings in the array
		$number_of_user_criteria_ratings = count($user_criteria_ratings);

		// Get the rating total from the user criteria ratings values
		$rating_total = array_sum($user_criteria_ratings);

		// Calculate the average rating for the user review based of the number of criteria ratings divided by the sum of the criteria ratings
		$average_rating_for_review = $rating_total / $number_of_user_criteria_ratings;

		// Store total sum of average user ratings
		$total_of_average_user_ratings += $average_rating_for_review;
	}

	if (count($reviews) <= 0) {
		return 0;
	} else {
		// Get an average rating for course based on the total sum of average user ratings divided by the total number of reviews
		return round($total_of_average_user_ratings / count($reviews), 1); 
	}
}

?>