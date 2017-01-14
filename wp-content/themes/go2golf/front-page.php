<?php get_header(); ?>

	<main role="main">
		<section>

			<h1>HOME!</h1>

			<?php 
			
			$query = new WP_Query(array('post_type'=>'product','posts_per_page'=>'-1'));
			if($query->have_posts()):
				while($query->have_posts()): $query->the_post();
					echo $post->post_title;

					$html = '';

					$html .= '<h1>' . $post->post_title . '</h1>';
					$html .= '<h2>' . the_field('course_address_1', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_address_2', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_city', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_county', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_postcode', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_country', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_latitude', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_longitude', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_telephone', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_fax', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_email', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_website', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_holes', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_yards', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_par', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_standard_scratch_score', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_coruse_record', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_year_founded', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_professional', $post->ID) . '</h2>';
					$html .= '<h2>' . the_field('course_course_designer', $post->ID) . '</h2>';
			
					echo do_shortcode('[rwp-review id="-1" template="rwp_template_5872271b8991c"]');

					$comments = get_comments( $post->ID );
					wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments);

					echo $html;

			// echo '<pre>';
			// print_r($post);
			// echo '</pre>';
			
				endwhile;
			endif;

			?>

		</section>
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
