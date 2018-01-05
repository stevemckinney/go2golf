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
			<div class="o-grid__col o-grid__col--5/12--med">
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

			<div class="o-grid__col o-grid__col--7/12--med">
				<div class="c-course-result-item__info-section">

					<?php the_title('<h2 class="c-course-result-item__name">', '</h2>'); ?>
					<h3 class="c-course-result-item__location"><?php echo get_first_product_category_from_id($post->id); ?></h3>
					<div class="c-course-result-item__average-review-stars">
						<?php wc_get_template_part( 'single-product/reviews-average', 'stars' ); ?>
						<p class="c-course-result-item__average-review-stars-text">
							<?php 
							if (get_user_review_count($post->ID) > 0) {
								echo get_user_review_average($post->ID) .' / 10';
							} else {
								echo '0 reviews';
							}
							?>
						</p>
					</div>
					<?php 
					$course_affiliates = get_the_terms($product->ID, 'pa_affiliates' );
					foreach ($course_affiliates as $affiliate):
						if ($affiliate->name == '2fore1'):
							echo '<div class="c-course-result-item__affiliates">';
							echo '<img src="' . getImagePath(true) . '/affiliates/2fore1-logo.png">';
							echo '</div>';
						endif;
					endforeach;
					?>
					<span class="o-btn o-btn--primary c-course-result-item__cta">View course</span>

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
