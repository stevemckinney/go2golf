<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="c-reviews-average-stars">
	<p class="u-visuallyhidden"><?php echo get_user_review_average($post->ID); ?> out of 10</p>
	<div class="c-reviews-average-stars__active-stars" style="width:<?php echo get_user_review_average($post->ID) * 100 / 10; ?>%">
		<span>★</span>
		<span>★</span>
		<span>★</span>
		<span>★</span>
		<span>★</span>
	</div><!--/.c-reviews-average-stars__active-stars -->
	<div class="c-reviews-average-stars__inactive-stars">
		<span>★</span>
		<span>★</span>
		<span>★</span>
		<span>★</span>
		<span>★</span>
	</div><!--/.c-reviews-average-stars__inactive-stars -->
</div><!--/.c-reviews-average-stars -->