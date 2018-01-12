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
		woocommerce_breadcrumb(array('delimiter' => '<span class="c-woocommerce-breadcrumb__delimiter">&nbsp;&#47;&nbsp;</span>', 'wrap_before' => '<nav class="c-woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><div class="c-woocommerce-breadcrumb__inner">', 'wrap_after' => '</div></nav>'));
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="o-wrapper t-push-bottom--half">
				<div class="o-grid">
					<div class="o-grid__col o-grid__col--3/4--large">
						<div class="c-course-detail-box">
							<div class="o-grid">
								<div class="o-grid__col o-grid__col--5/12--small">
									<?php wc_get_template_part( 'single-product/product', 'image' ); ?>
								</div><!--/.o-grid__col -->
								<div class="o-grid__col o-grid__col--7/12--small">
									<h1 class="c-course-detail-box__name"><?php the_title(); ?></h1>
									<h3 class="c-course-detail-box__location"><?php echo get_first_product_category_from_id($post->ID); ?></h3>
									<div class="c-course-detail-box__average-review-stars">
										<?php wc_get_template_part( 'single-product/reviews-average', 'stars' ); ?>
										<p class="c-course-detail-box__average-review-stars-text">
											<?php 
											if (get_user_review_count($post->ID) > 0) {
												echo get_user_review_average($post->ID) .' / 10';
											} else {
												echo '0 reviews';
											}
											?>
										</p>
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
									<?php 
									$course_affiliates = get_the_terms($post, 'pa_affiliates' );
									foreach ($course_affiliates as $affiliate):
										if ($affiliate->name == '2fore1'):
											echo '<div class="c-course-detail-box__affiliates">';
											echo '<img src="' . getImagePath(true) . '/affiliates/2fore1-logo.png">';
											echo '</div>';
										endif;
									endforeach;
									?>
									<!--<div class="c-course-detail-box__key-info">
										<p class="c-course-detail-box__key-info-item"><span class="c-course-detail-box__key-info-description">Description</span> <span class="c-course-detail-box__key-info-value">value</span></p>
										<p class="c-course-detail-box__key-info-item"><span class="c-course-detail-box__key-info-description">Description</span> <span class="c-course-detail-box__key-info-value">value</span></p>
									</div>/.c-course-detail-box__key-features -->
								</div><!--/.o-grid__col -->
							</div><!--/.o-grid -->
						</div><!--/.c-course-detail-box -->
					</div><!--/.o-grid__col -->
					<div class="o-grid__col o-grid__col--1/4--large">
						<div data-id="product-cta-sidebar" class="c-course-detail__ctas">
							<?php
							if(get_field('cta_1_text')) {
								echo '<a id="courseDetailCta1" href="' . get_field('cta_1_link') . '" class="o-btn o-btn--full o-btn--large o-btn--primary c-course-detail__cta" target="_blank">' . get_field('cta_1_text'). '</a>';
							} elseif(get_field('course_website')) {
								echo '<a id="courseDetailCta1" href="http://' . get_field('course_website') . '" class="o-btn o-btn--full o-btn--large o-btn--primary c-course-detail__cta" target="_blank">Book a Tee Time</a>';
							}
							?>
							<?php
							if(get_field('cta_2_text')) {
								echo '<a id="courseDetailCta2" href="' . get_field('cta_2_link') . '" class="o-btn o-btn--full o-btn--primary c-course-detail__cta" target="_blank">' . get_field('cta_2_text'). '</a>';
							}
							?>
							<?php
							if(get_field('cta_3_text')) {
								echo '<a id="courseDetailCta3" href="' . get_field('cta_3_link') . '" class="o-btn o-btn--full o-btn--primary c-course-detail__cta" target="_blank">' . get_field('cta_3_text'). '</a>';
							}
							?>
						</div>
					</div><!--/.o-grid__col -->
				</div><!--/.o-grid -->
			</div><!--/.o-wrapper -->

			<div class="o-panel o-panel--flat o-panel--background-color-white">
				<div class="o-wrapper">
					<div class="o-grid">
						<div class="o-grid__col o-grid__col--3/4--large">
							<ul class="c-tabs c-tabs--pull-top c-tabs--background-color-white">
								<li class="c-tabs__tab-label c-tabs__tab-label--has-sibling">
									<a href="#contactInformation">Contact information</a>
								</li>
								<li class="c-tabs__tab-label c-tabs__tab-label--has-sibling">
									<a href="#facilities">Facilities</a>
								</li>
								<li class="c-tabs__tab-label c-tabs__tab-label--has-sibling">
									<a href="#courseInformation">Course overview</a>
								</li>
								<li class="c-tabs__tab-label">
									<a href="#reviews">Reviews <span class="o-notification o-notification--small"><?php echo get_user_review_count($post->ID); ?></span></a>
								</li>
							</ul><!--/.c-tabs -->

							<section id="contactInformation" class="o-panel o-panel--double o-panel--has-divider">
								<div class="o-grid o-grid--vertically-spaced">
									<div class="o-grid__col o-grid__col--1/3--large">
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
									<div class="o-grid__col o-grid__col--2/3--large">
										<img class="c-embedded-map" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php the_field('course_postcode'); ?>&zoom=13&size=600x300&maptype=roadmap&markers=color:%7Clabel:%7C<?php the_field('course_postcode'); ?>&key=AIzaSyBJa2I89DTU1eOfuEj3Iy7fu_4g1rhnIx4">
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
							</section>
							<section id="facilities" class="o-panel o-panel--double o-panel--has-divider">
								<h1 class="o-heading--secondary">Facilities</h1>
								<?php 
									function checkInactiveFacility($facility) {
										if (!$facility == 1) {
											echo ' c-facility-indicator--inactive';
										}
									}
								?>
								<div class="o-grid o-grid--vertically-spaced">
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_trolleys')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/trolley.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Trollies for hire</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_buggies')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/golf-cart.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Buggies for hire</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_clubs')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/golf-bag.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Clubs for hire</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_driving_range')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/putter-and-ball.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Driving Range</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_putting_green')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/golf-field.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Putting Green</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_practice_area')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/tee.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Practice Area</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_changing_room')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/golf-shirt.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Changing Room</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_pro_shop')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/cup.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Pro Shop</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_corporate_facilities')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/corporate-facilities.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Corporate Facilities</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_accommodation')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/accommodation.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Accommodation</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2--small o-grid__col--1/4--large">
										<div class="c-facility-indicator<?php checkInactiveFacility(get_field('course_facility_-_bar_and_food')); ?>">
											<img src="<?php getThemePath(); ?>/_source/images/icons/bar-food.svg" width="80" class="c-facility-indicator__image">
											<p class="c-facility-indicator__name">Bar and Food</p>
										</div><!--/.c-facility-indicator -->
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
							</section>
							<section id="courseInformation" class="o-panel o-panel--double o-panel--has-divider">
								<h1 class="o-heading--secondary">Course overview</h1>
								<div class="o-grid" style="display:none">
									<div class="o-grid__col o-grid__col--1/2">
										<p>We don't have course information data in long text form... Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam maxime ullam cum obcaecati, minus, magnam dolorem aspernatur iste ex eligendi quam illum, tenetur quod illo velit accusamus omnis voluptatibus, dolores.</p>
									</div><!--/.o-grid__col -->
									<div class="o-grid__col o-grid__col--1/2">
										<?php wc_get_template( 'single-product/product-image.php' ); ?>
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
								<div class="o-grid">
									<div class="o-grid__col o-grid__col--1/2" style="display:none;">
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
									<div class="o-grid__col">
										<?php // the_field('course_course_overview'); ?>
										<?php the_excerpt(); ?>
									</div><!--/.o-grid__col -->
								</div><!--/.o-grid -->
							</section>
							<section id="reviews" class="o-panel o-panel--double">
								<div class="c-reviews__header-strip">
									<h1 class="o-heading--secondary">Reviews <span class="o-notification o-notification--small"><?php echo get_user_review_count($post->ID); ?></span></h1>
									<a href="#review-form" class="c-reviews__leave-review-prompt">Leave a review</a>
								</div><!--/.c-reviews__header-strip -->
								<div class="c-reviews__breakdowns">
									<div class="c-reviews__breakdown" itemscope itemtype="http://schema.org/LocalBusiness">
										<span itemprop="name"><?php the_title(); ?></span>
										<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="u-visuallyhidden">
												<meta itemprop="worstRating" content="1"/>
												<span itemprop="ratingValue"><?php echo get_user_review_average($post->ID);?></span> out of 
												<span itemprop="bestRating">10</span> with
												<span itemprop="ratingCount"><?php echo get_user_review_count($post->ID)?></span> ratings
											</div>
										</div>
										<h2 class="c-reviews__breakdown-heading">Average course rating</h2>
										<p class="c-reviews__breakdown-average-rating-text"><?php echo get_user_review_average($post->ID);?><span class="c-reviews__breakdown-average-rating-seperator">/</span>10</p>
										<p class="c-reviews__breakdown-average-rating-count">(<?php echo get_user_review_count($post->ID) . ' review' . (get_user_review_count($post->ID) > 1 ? 's' : ''); ?>)</p>
										<?php wc_get_template_part( 'single-product/reviews-average', 'stars' ); ?>
									</div><!--/.c-reviews__breakdown -->
									<div class="c-reviews__breakdown">
										<h2 class="c-reviews__breakdown-heading">Breakdown averages</h2>
										<?php
											$review_averages = RWP_API::get_reviews_box_users_rating($post->ID, -1, 'rwp_template_5872271b8991c', true);
											foreach ($review_averages['scores'] as $score) {
												echo '<p class="c-reviews__breakdown-of-averages"><span class="c-reviews__breakdown-of-averages-number">'.$score['score'].'</span>'.$score['label'].'</p>';
											}
										?>
									</div><!--/.c-reviews__breakdown -->
									<div class="c-reviews__breakdown">
										<h2 class="c-reviews__breakdown-heading">Reviews breakdown</h2>
										<?php
											$reviews = RWP_API::get_reviews_box_users_reviews($post->ID, -1, 'rwp_template_5872271b8991c');

											$overall_average_ratings = [
												'0.1 - 2' => 0,
												'2.1 - 4' => 0,
												'4.1 - 6' => 0,
												'6.1 - 8' => 0,
												'8.1 - 10' => 0 
											];

											foreach ($reviews['reviews'] as $review) {
												if ($review['rating_overall'] <= 2) {
													$overall_average_ratings['0.1 - 2']++;
												} else if ($review['rating_overall'] >= 2.1 && $review['rating_overall'] <= 4) {
													$overall_average_ratings['2.1 - 4']++;
												} else if ($review['rating_overall'] >= 4.1 && $review['rating_overall'] <= 6) {
													$overall_average_ratings['4.1 - 6']++;
												} else if ($review['rating_overall'] >= 6.1 && $review['rating_overall'] <= 8) {
													$overall_average_ratings['6.1 - 8']++;
												} else if ($review['rating_overall'] >= 8.1 && $review['rating_overall'] <= 10) {
													$overall_average_ratings['8.1 - 10']++;
												}
											}

											$stars_width = 20;
											foreach ($overall_average_ratings as $average_rating_range => $average_rating_range_count) {
												$total_number_of_reviews = $reviews['count'];
												if($total_number_of_reviews > 0) {
													$percentage_rating_for_range = $average_rating_range_count / $total_number_of_reviews * 100;
												} else {
													$percentage_rating_for_range = 0;
												}

												echo '<div class="c-reviews__breakdown-of-ratings-spread-item">';

												$stars_html = '
												<div class="c-reviews-average-stars">
												<div class="c-reviews-average-stars__active-stars" style="width:'.$stars_width.'%;">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-active.png">
													<img src="'.getThemePath(true)	.'/_source/images/mark-as-favorite-star-active.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-active.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-active.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-active.png">
												</div><!--/.c-reviews-average-stars__active-stars -->
												<div class="c-reviews-average-stars__inactive-stars">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-inactive.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-inactive.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-inactive.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-inactive.png">
													<img src="'.getThemePath(true).'/_source/images/mark-as-favorite-star-inactive.png">
												</div><!--/.c-reviews-average-stars__inactive-stars -->
												</div><!--/.c-reviews-average-stars -->
												';

												echo $stars_html;

												echo '<div class="c-reviews__breakdown-of-ratings-spread-bar"><span style="width:'.$percentage_rating_for_range.'%"></span></div>';
												echo '<p class="c-reviews__breakdown-of-ratings-spread-count">'.$average_rating_range_count.'</p>';
												echo '</div>';

												$stars_width = $stars_width + 20;
											}
											
										?>
									</div><!--/.c-reviews__breakdown -->
								</div><!--/.c-reviews__breakdowns -->
								<?php  echo do_shortcode('[rwp_box_reviews id="-1" template="rwp_template_5872271b8991c"]'); ?>
								<div id="review-form">
									<?php echo do_shortcode('[rwp_box_form id="-1" post="'.$post->ID.'" template="rwp_template_5872271b8991c"]'); ?>
								</div><!--/#review-form -->
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
