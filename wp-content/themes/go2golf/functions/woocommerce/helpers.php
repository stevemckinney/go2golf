<?php

function get_first_product_category_from_id($product_id) {
	$product_id = ($product_id) ? $product_id : $post->ID;
	$terms = get_the_terms( $product_id, 'product_cat' );
	return $terms[0]->name;
}

?>