<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php woocommerce_breadcrumb(array('delimiter' => '<span class="c-woocommerce-breadcrumb__delimiter">&nbsp;&#47;&nbsp;</span>', 'wrap_before' => '<nav class="c-woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><div class="c-woocommerce-breadcrumb__inner">', 'wrap_after' => '</div></nav>')); ?>

	<div class="o-wrapper">
		<div class="o-grid">
			<div class="o-grid__col o-grid__col--1/3--x-large">
				<aside class="o-sidebar">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('course-sidebar')) ?>
				</aside>
			</div><!--/.o-grid__col -->
			<div class="o-grid__col o-grid__col--2/3--x-large">
				<h1 class="t-push-bottom--half">Golf courses in <?php woocommerce_page_title(); ?></h1>
			   <?php if ( have_posts() ) : ?>

			   	<?php
			   		/**
			   		 * woocommerce_before_shop_loop hook.
			   		 *
			   		 * @hooked woocommerce_result_count - 20
			   		 * @hooked woocommerce_catalog_ordering - 30
			   		 */
			   		//do_action( 'woocommerce_before_shop_loop' );
			   	?>

			   	<?php woocommerce_product_loop_start(); ?>

			   		<?php woocommerce_product_subcategories(); ?>

			   		<?php while ( have_posts() ) : the_post(); ?>

			   			<?php wc_get_template_part( 'content', 'product' ); ?>

			   		<?php endwhile; // end of the loop. ?>

			   	<?php woocommerce_product_loop_end(); ?>

			   	<?php
			   		/**
			   		 * woocommerce_after_shop_loop hook.
			   		 *
			   		 * @hooked woocommerce_pagination - 10
			   		 */
			   		do_action( 'woocommerce_after_shop_loop' );
			   	?>

			   <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			   	<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			   <?php endif; ?>
			</div><!--/.o-grid__col -->
		</div><!--/.o-grid -->
	</div><!--/.o-wrapper -->

<?php get_footer( 'shop' ); ?>
