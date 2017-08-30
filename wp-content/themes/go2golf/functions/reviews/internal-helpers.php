<?php

function get_user_reviews($post_id) {

	// Generate a hash for the review ID to match the ID in the database
	$review_id 	= md5('rwp-rwp_template_5872271b8991c-'. 'product' . '-' . $post_id . '--1' );
	
	// Get the associated reviews meta for the review ID / post
	$reviews = get_post_meta( $post_id, 'rwp_rating_' . $review_id, false ); // Get post reviews

	return $reviews;
}

?>