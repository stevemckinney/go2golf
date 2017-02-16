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

// Define variables to use on page
$average_course_review = get_user_review_average($post->ID);

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

			<div class="o-wrapper">
				<div class="o-grid">
					<div class="o-grid__col o-grid__col--3/4">
						<div class="c-course-detail-box">
							<div class="o-grid">
								<div class="o-grid__col o-grid__col--5/12">
									<?php wc_get_template( 'single-product/product-image.php' ); ?>
								</div><!--/.o-grid__col -->
								<div class="o-grid__col o-grid__col--7/12">
									<h2 class="c-course-detail-box__name"><?php the_title(); ?></h2>
									<h3 class="c-course-detail-box__location"><?php echo get_first_product_category_from_id(); ?></h3>
									<p class="u-visuallyhidden"><?php echo $average_course_review; ?> out of 10</p>
									<div class="c-course-detail-box__average-review-stars">
										<div class="c-course-detail-box__average-review-active-stars" style="width:<?php echo $average_course_review * 100 / 10; ?>%">
											<span>★</span>
											<span>★</span>
											<span>★</span>
											<span>★</span>
											<span>★</span>
										</div><!--/.c-course-detail-box__average-review-active-stars -->
										<div class="c-course-detail-box__average-review-inactive-stars">
											<span>★</span>
											<span>★</span>
											<span>★</span>
											<span>★</span>
											<span>★</span>
										</div><!--/.c-course-detail-box__average-review-inactive-stars -->
									</div><!--/.c-course-detail-box__average-review-stars -->
									<div class="c-course-detail-box__key-features">
										<p class="c-course-detail-box__key-feature">feature</p>
										<p class="c-course-detail-box__key-feature">feature</p>
										<p class="c-course-detail-box__key-feature">feature</p>
									</div><!--/.c-course-detail-box__key-features -->
									<div class="c-course-detail-box__key-info">
										<p class="c-course-detail-box__key-info-item">info</p>
										<p class="c-course-detail-box__key-info-item">info</p>
									</div><!--/.c-course-detail-box__key-features -->
								</div><!--/.o-grid__col -->
							</div><!--/.o-grid -->
						</div><!--/.c-course-detail-box -->
					</div><!--/.o-grid__col -->
					<div class="o-grid__col o-grid__col--1/4">
						CTA sidebar
					</div><!--/.o-grid__col -->
				</div><!--/.o-grid -->
			</div><!--/.o-wrapper -->

			<div class="o-panel o-panel--background-color-white">
				<div class="o-wrapper">
					<div class="o-grid">
						<div class="o-grid__col o-grid__col--2/3">
							<ul class="c-tabs">
								<li class="c-tabs__tab">
									Contact information
								</li>
								<li class="c-tabs__tab">
									Facilities
								</li>
								<li class="c-tabs__tab">
									Course information
								</li>
								<li class="c-tabs__tab">
									Reviews
								</li>
							</ul><!--/.c-tabs -->

							<section>
								Contact info
							</section>
							<section>
								Facilities
							</section>
							<section>
								Course information
							</section>
							<section>
								Reviews
							</section>
						</div><!--/.o-grid__col -->
					</div><!--/.o-grid -->
				</div><!--/.o-wrapper -->
			</div><!--/.o-panel -->

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
