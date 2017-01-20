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
