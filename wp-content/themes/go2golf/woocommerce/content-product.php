<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php post_class('o-list--naked__item c-course-result-item'); ?>>
	<a href="<?php the_permalink() ?>">

		<div class="o-grid">
			<div class="o-grid__col o-grid__col--1/3">
			<?php

			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			?>
			</div><!--/.o-grid__col -->

			<div class="o-grid__col o-grid__col--2/3">
				<div class="c-course-result-item__info-section">

					<?php the_title('<h2 class="c-course-result-item__title">', '</h2>'); ?>
					<h3 class="c-course-result-item__category"><?php echo get_first_product_category_from_id(); ?></h3>
					<span class="c-course-result-item__cta">View course</span>

					<?php 

					// Generate a hash for the review ID to match the ID in the database
					$review_id 	= md5('rwp-rwp_template_5872271b8991c-'. 'product' . '-' . $post->ID . '--1' );

					// Get the associated reviews meta for the review ID / post
					$reviews = get_post_meta( $post->ID, 'rwp_rating_' . $review_id, false ); // Get post reviews

					// Init average rating for the course
					$average_course_rating = 0;

					// Init total of the average number of user ratings by criteria
					$total_of_average_user_ratings = 0;

					// For every complete review
					foreach ($reviews as $review_key => $review_set) {

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

					// Get an average rating for course based on the total sum of average user ratings divided by the total number of reviews
					echo round($total_of_average_user_ratings / count($reviews), 1); 

					?>


				</div><!--/.c-course-result-item__info-section -->
			</div><!--/.o-grid__col -->

			<?php

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div><!--/.o-grid -->

	</a>
</li>
