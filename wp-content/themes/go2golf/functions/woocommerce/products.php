<?php 

function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
	global $post;
	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

	if ( has_post_thumbnail() ) {
		$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
		return get_the_post_thumbnail( $post->ID, $image_size, array(
			'title'	 => $props['title'],
			'alt'    => $props['alt'],
			'class'  => 'c-course-result-item__image',
		) );
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $image_size );
	}
}

?>