<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<h1>Main details</h1>

			<?php 

				$html = '';

				$html .= '<h2>Address 1 - ' . get_field('course_address_1', $post->ID) . '</h2>';
				$html .= '<h2>Address 2 - ' . get_field('course_address_2', $post->ID) . '</h2>';
				$html .= '<h2>City - ' . get_field('course_city', $post->ID) . '</h2>';
				$html .= '<h2>County - ' . get_field('course_county', $post->ID) . '</h2>';
				$html .= '<h2>Postcode - ' . get_field('course_postcode', $post->ID) . '</h2>';
				$html .= '<h2>Country - ' . get_field('course_country', $post->ID) . '</h2>';
				$html .= '<h2>Latitude - ' . get_field('course_latitude', $post->ID) . '</h2>';
				$html .= '<h2>Longitude - ' . get_field('course_longitude', $post->ID) . '</h2>';
				$html .= '<h2>Telephone - ' . get_field('course_telephone', $post->ID) . '</h2>';
				$html .= '<h2>Fax - ' . get_field('course_fax', $post->ID) . '</h2>';
				$html .= '<h2>Email - ' . get_field('course_email', $post->ID) . '</h2>';
				$html .= '<h2>Website - ' . get_field('course_website', $post->ID) . '</h2>';
				$html .= '<h2>Holes - ' . get_field('course_holes', $post->ID) . '</h2>';
				$html .= '<h2>Yards - ' . get_field('course_yards', $post->ID) . '</h2>';
				$html .= '<h2>Par - ' . get_field('course_par', $post->ID) . '</h2>';
				$html .= '<h2>Scratch score - ' . get_field('course_standard_scratch_score', $post->ID) . '</h2>';
				$html .= '<h2>Record - ' . get_field('course_coruse_record', $post->ID) . '</h2>';
				$html .= '<h2>Founded - ' . get_field('course_year_founded', $post->ID) . '</h2>';
				$html .= '<h2>Course pro - ' . get_field('course_professional', $post->ID) . '</h2>';
				$html .= '<h2>Course designer - ' . get_field('course_course_designer', $post->ID) . '</h2>';

				echo $html;
			?>

			<?php echo do_shortcode('[rwp-review id="-1" template="rwp_template_5872271b8991c"]'); ?>
			<?php //echo do_shortcode('[rwp-review-recap id="-1" template="rwp_template_5872271b8991c"]'); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
