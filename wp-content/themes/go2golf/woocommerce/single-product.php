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
		woocommerce_breadcrumb(array('delimiter' => '<span class="c-woocommerce-breadcrumb__delimiter">&nbsp;&#47;&nbsp;</span>', 'wrap_before' => '<nav class="c-woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><div class="c-woocommerce-breadcrumb__inner">', 'wrap_after' => '</div></nav>'));
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="o-wrapper t-push-bottom--half">
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
									<div style="display:none" class="c-course-detail-box__average-review-stars">
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
										<div class="c-course-detail-box__key-feature c-course-detail-box__key-feature--holes">
											<span class="c-course-detail-box__key-feature-icon"></span>
											<div class="c-course-detail-box__key-feature-inner">
												<h3 class="c-course-detail-box__key-feature-heading">Holes</h3>
												<p class="c-course-detail-box__key-feature-value"><?php the_field('course_holes', $post->ID); ?></p>
											</div><!--/.c-course-detail-box__key-feature-inner -->
										</div><!--/.c-course-detail-box__key-feature -->
										<div class="c-course-detail-box__key-feature c-course-detail-box__key-feature--par">
											<span class="c-course-detail-box__key-feature-icon"></span>
											<div class="c-course-detail-box__key-feature-inner">
												<h3 class="c-course-detail-box__key-feature-heading">Par</h3>
												<p class="c-course-detail-box__key-feature-value"><?php the_field('course_par', $post->ID); ?></p>
											</div><!--/.c-course-detail-box__key-feature-inner -->
										</div><!--/.c-course-detail-box__key-feature -->
										<div class="c-course-detail-box__key-feature c-course-detail-box__key-feature--length">
											<span class="c-course-detail-box__key-feature-icon"></span>
											<div class="c-course-detail-box__key-feature-inner">
												<h3 class="c-course-detail-box__key-feature-heading">Length</h3>
												<p class="c-course-detail-box__key-feature-value"><?php the_field('course_yards', $post->ID); ?></p>
											</div><!--/.c-course-detail-box__key-feature-inner -->
										</div><!--/.c-course-detail-box__key-feature -->
									</div><!--/.c-course-detail-box__key-features -->
									<div class="c-course-detail-box__key-info">
										<p class="c-course-detail-box__key-info-item"><span class="c-course-detail-box__key-info-description">Description</span> <span class="c-course-detail-box__key-info-value">value</span></p>
										<p class="c-course-detail-box__key-info-item"><span class="c-course-detail-box__key-info-description">Description</span> <span class="c-course-detail-box__key-info-value">value</span></p>
									</div><!--/.c-course-detail-box__key-features -->
								</div><!--/.o-grid__col -->
							</div><!--/.o-grid -->
						</div><!--/.c-course-detail-box -->
					</div><!--/.o-grid__col -->
					<div class="o-grid__col o-grid__col--1/4">
						<div data-id="product-cta-sidebar">
							<a href="#" class="o-btn o-btn--full o-btn--large o-btn--primary c-course-detail__cta">Book a tee time</a>
							<a href="#" class="o-btn o-btn--full o-btn--primary c-course-detail__cta">Book a hotel</a>
							<a href="#" class="o-btn o-btn--full o-btn--primary c-course-detail__cta">Book a hotel and play</a>
						</div>
					</div><!--/.o-grid__col -->
				</div><!--/.o-grid -->
			</div><!--/.o-wrapper -->

			<div class="o-panel o-panel--flat o-panel--background-color-white">
				<div class="o-wrapper">
					<div class="o-grid">
						<div class="o-grid__col o-grid__col--3/4">
							<ul class="c-tabs c-tabs--pull-top c-tabs--background-color-white">
								<li style="text-align:left; border:0" class="c-tabs__tab-label c-tabs__tab-label--has-sibling">
									<a href="#contactInformation">Contact information</a>
								</li>
								<!--<li class="c-tabs__tab-label c-tabs__tab-label--has-sibling">
									<a href="#facilities">Facilities</a>
								</li>
								<li class="c-tabs__tab-label c-tabs__tab-label--has-sibling">
									<a href="#courseInformation">Course information</a>
								</li>
								<li class="c-tabs__tab-label">
									<a href="#reviews">Reviews <span class="o-notification o-notification--small">12</span></a>
								</li>-->
							</ul><!--/.c-tabs -->

							<section id="contactInformation" class="o-panel o-panel--double o-panel--has-divider">
								<div class="o-grid">
									<div class="o-grid__col o-grid__col--1/3">
										<h1 class="o-heading--secondary">Contact information</h1>
										<p><?php the_field('course_telephone', $post->ID); ?></p>
										<p class="t-push-bottom--half"><?php the_field('course_email', $post->ID); ?></p>
										<h2 class="o-heading--tertiary">Address</h2>
										<p>
											<div><?php the_field('course_address_1'); ?></div>
											<div><?php the_field('course_address_2'); ?></div>
											<div><?php the_field('course_city'); ?></div>
											<div><?php the_field('course_county'); ?></div>
											<div><?php the_field('course_country'); ?></div>
											<div><?php the_field('course_postcode'); ?></div>
										</p>
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--2/3">
										<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php the_field('course_postcode'); ?>&zoom=13&size=600x300&maptype=roadmap&markers=color:%7Clabel:%7C<?php the_field('course_postcode'); ?>&key=AIzaSyBJa2I89DTU1eOfuEj3Iy7fu_4g1rhnIx4">
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
							</section>
							<section style="display:none" id="facilities" class="o-panel o-panel--double o-panel--has-divider">
								<h1 class="o-heading--secondary">Facilities</h1>
								<div class="o-grid o-grid--vertically-spaced">
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator c-facility-indicator--inactive">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility INACTIVE</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/4">
										<div class="c-facility-indicator">
											<img src="https://image.flaticon.com/icons/svg/182/182598.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Facility</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
							</section>
							<section style="display:none" id="courseInformation" class="o-panel o-panel--double o-panel--has-divider">
								<h1 class="o-heading--secondary">Course information</h1>
								<div class="o-grid">
									<div class="o-grid__col o-grid__col--1/2">
										<p>We don't have course information data in long text form... Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam maxime ullam cum obcaecati, minus, magnam dolorem aspernatur iste ex eligendi quam illum, tenetur quod illo velit accusamus omnis voluptatibus, dolores.</p>
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2">
										<?php wc_get_template( 'single-product/product-image.php' ); ?>
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
								<h2 class="o-heading--secondary">Overview</h2>
								<div class="o-grid">
									<div class="o-grid__col o-grid__col--1/2">
										<table>
											<tbody>
												<tr>
													<td>Year founded</td>
													<td><?php the_field('course_year_founded', $post->ID); ?></td>
												</tr>
												<tr>
													<td>Designer</td>
													<td><?php the_field('course_course_designer', $post->ID); ?></td>
												</tr>
												<tr>
													<td>Professional</td>
													<td><?php the_field('course_professional', $post->ID); ?></td>
												</tr>
												<tr>
													<td>Record</td>
													<td><?php the_field('course_course_record', $post->ID); ?></td>
												</tr>
											</tbody>
										</table>
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2">
										<p>We don't have course information data in long text form... Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam maxime ullam cum obcaecati, minus, magnam dolorem aspernatur iste ex eligendi quam illum, tenetur quod illo velit accusamus omnis voluptatibus, dolores.</p>
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
							</section>
							<section style="display:none" id="reviews" class="o-panel o-panel--double">
								<h1 class="o-heading--secondary">Reviews</h1>
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
				$html .= '<h2>Record - ' . get_field('course_course_record', $post->ID) . '</h2>';
				$html .= '<h2>Founded - ' . get_field('course_year_founded', $post->ID) . '</h2>';
				$html .= '<h2>Course pro - ' . get_field('course_professional', $post->ID) . '</h2>';
				$html .= '<h2>Course designer - ' . get_field('course_course_designer', $post->ID) . '</h2>';

				//echo $html;
			?>

			<?php //echo do_shortcode('[rwp-review id="-1" template="rwp_template_5872271b8991c"]'); ?>
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
		//do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
