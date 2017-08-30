<?php if (! $this->is_users_rating_disabled() ): ?>
<div class="rwp-users-reviews-wrap">
<?php 
$font_size  = $this->template_field('template_box_font_size', true);
$score_size = intval( $font_size ) - 2; 
//$rate_opt	= $this->review_field('review_user_rating_options', true);
$rate_opt = $this->template_field('template_user_rating_options', true);
$auth 		= $this->preferences_field('preferences_authorization', true);
$color 		= $this->template_field('template_text_color', true );

?>

	<span 
        class="rwp-people-label" 
        style="color: <?php $this->template_field('template_users_reviews_label_color') ?>; 
        	   font-size: <?php $this->template_field('template_users_reviews_label_font_size') ?>px; 
        	   line-height: <?php $this->template_field('template_users_reviews_label_font_size') ?>px;"><?php $this->template_field('template_users_reviews_label') ?>
		
		<i style="background-color: <?php $this->template_field('template_users_reviews_label_color') ?>;
				  font-size: <?php echo $score_size ?>px;
				  border-radius: <?php echo $score_size ?>px;	
				  -webkit-border-radius: <?php echo $score_size ?>px;"><?php echo count($this->ratings) ?></i>

		<em style="color: <?php echo $color ?>; 
	               font-size: <?php echo $font_size ?>px;
	               line-height: <?php echo $font_size ?>px;">
		<?php if ( $this->already_rated() ): ?>
			<?php _e('You already rated', $this->plugin_slug) ?>
		<?php elseif( $auth == 'logged_in' && !is_user_logged_in() ): ?>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php $this->template_field('template_message_to_rate_login') ?></a>
		<?php else: ?>
			<a href="#rwp-ratings-form-<?php echo $this->post_id ?>-<?php $this->review_field('review_id') ?>"><?php $this->template_field('template_message_to_rate') ?></a>
		<?php endif ?>
		</em>
    </span>

	<div class="rwp-users-reviews">

	<?php if (empty( $this->ratings )): ?>
		<p><?php _e( 'Be the first to leave a rating.', $this->plugin_slug) ?></p>
	<?php endif ?>

	<?php 
	usort( $this->ratings, array( 'RWP_Reviewer', 'rating_cmp' ) ); 
	$i 				= $this->ratings_per_page;
	$per_page 		= $this->ratings_per_page;
	$j				= 1;
	$first 			= true;
	$highlighted	= false;
	$count 			= count( $this->ratings );

	foreach ($this->ratings as $rating): 

		if( isset( $_GET['rwpurid'] ) &&  $_GET['rwpurid'] ==  $rating['rating_id'] )
			$highlighted = true;

		if( $i == $per_page ) {
			$hidden = ( !$first && !$highlighted ) ? 'rwp-hidden' : '';
			$first  = false;
			echo '<div class="rwp-users-reviews-page '. $hidden .'">';
		}
		// === START RATING OUTPUT ===

		//RWP_Reviewer::pretty_print($rating);
	?>

		<div class="rwp-user-review <?php if( $highlighted ) echo 'rwp-highlighted'; ?>" id="<?php echo $rating['rating_id']; ?>">
			
			<?php if( in_array( 'rating_option_avatar', $rate_opt ) ): ?>
			<div class="rwp-user-info">
				<?php 
					$avatar = ( $rating['rating_user_id'] == 0 && isset( $rating['rating_user_email'] ) && !empty( $rating['rating_user_email'] ) ) ? $rating['rating_user_email'] : $rating['rating_user_id'];
					echo get_avatar( $avatar, 50 ); 
				?>
				
				<?php if( in_array( 'rating_option_name', $rate_opt ) ): ?>
				<span style="line-height: <?php echo $score_size ?>px; font-size: <?php echo $score_size ?>px;"><?php echo ( $rating['rating_user_id'] > 0 ) ? get_user_by( 'id', $rating['rating_user_id'] )->display_name : $rating['rating_user_name'] ?></span>
				<?php endif; ?>

			</div> <!-- /user-info -->
			<?php endif ?>

			<div class="rwp-ur-content <?php if( !in_array( 'rating_option_avatar', $rate_opt ) ) echo 'rwp-no-avatar'; ?>">
				
				<?php if( in_array( 'rating_option_title', $rate_opt ) ): ?>
				<span class="rwp-ur-title"><?php echo $rating['rating_title'] ?></span>	
				<?php endif ?>
				
				<?php if( in_array( 'rating_option_comment', $rate_opt ) ): ?>
				<div class="rwp-ur-message"><?php echo nl2br( $rating['rating_comment'] ); ?></div>
				<?php endif ?>

				<span class="rwp-ur-date"><?php echo date_i18n( get_option( 'date_format' ) . ', ' . get_option( 'time_format' ), $rating['rating_date'] ); ?></span>
				
				<div class="rwp-ur-ratings-wrap">
				
					<?php if( in_array( 'rating_option_score', $rate_opt ) ) {

						$mode = $this->preferences_field('preferences_rating_mode', true);

						switch ( $mode ) {
							case 'five_stars':

								echo $this->get_stars($rating['rating_score']);
								break;

							case 'full_five_stars':
								$order 		= $this->template_field('template_criteria_order', true);
								$criteria 	= $this->template_field('template_criterias', true);
								$order		= ( $order == null ) ? array_keys( $criteria) : $order;
								
								echo '<div class="rwp-ur-ratings">';
								foreach ($order as $i)  {

									echo '<div class="rwp-criterion">';
										echo '<div class="rwp-criterion-text">';
											echo '<span class="rwp-criterion-label" style="line-height: '. $score_size .'px; font-size: '. $score_size .'px;">'. $criteria[$i] .'</span>';
										echo '</div><!-- /criterion-text -->';

										echo $this->get_stars( $rating['rating_score'][$i] );
									echo '</div><!-- /criterion -->';
									
								}
								echo '</div> <!--/ur-ratings -->';
								break;

							default:

								$order 		= $this->template_field('template_criteria_order', true);
								$criteria 	= $this->template_field('template_criterias', true);
								$order		= ( $order == null ) ? array_keys( $criteria) : $order;
								
								echo '<div class="rwp-ur-ratings">';
								foreach ($order as $i)  {

									echo '<div class="rwp-criterion">';
										echo '<div class="rwp-criterion-text">';
											echo '<span class="rwp-criterion-label" style="line-height: '. $score_size .'px; font-size: '. $score_size .'px;">'. $criteria[$i] .'</span>';
											echo '<span class="rwp-criterion-score" style="line-height: '. $score_size .'px; font-size: '. $score_size .'px;">'.  RWP_Reviewer::format_number(  $rating['rating_score'][$i] ) .'</span>';
										echo '</div><!-- /criterion-text -->';

										echo '<div class="rwp-criterion-bar-base">';
											echo $this->get_score_bar( $rating['rating_score'][$i] );
										echo '</div><!-- /criterion-bar -->';
									echo '</div><!-- /criterion -->';
									
								}
								echo '</div> <!--/ur-ratings -->';
								break;
						}

					} // if rating option ?>


					<?php if( in_array( 'rating_option_like', $rate_opt ) ): ?>
					<div class="rwp-ur-like-wrap <?php echo ($this->enable_like( $rating['rating_id'] )) ? 'rwp-on' : 'rwp-off'; ?>">

						<div class="rwp-dislike">
							<span data-method="dislike" data-rating-id="<?php echo $rating['rating_id'] ?>" data-post-id="<?php echo $this->post_id ?>" data-user-id="<?php echo wp_get_current_user()->ID ?>"></span>
							<em><?php echo (isset( $this->likes[ $rating['rating_id'] ]['no'] )) ? $this->likes[ $rating['rating_id'] ]['no'] : '-'; ?></em>
						</div>

						<div class="rwp-like">
							<em><?php echo (isset( $this->likes[ $rating['rating_id'] ]['yes'] )) ? $this->likes[ $rating['rating_id'] ]['yes'] : '-'; ?></em>
							<span data-method="like"  data-rating-id="<?php echo $rating['rating_id'] ?>" data-post-id="<?php echo $this->post_id ?>" data-user-id="<?php echo wp_get_current_user()->ID ?>"></span>
						</div>
						
						<div class="rwp-loader"></div><!-- /loader-->	
					
					</div>

					<?php endif ?>

					<?php 
					if (in_array( 'rating_option_share', $rate_opt ) ) {
						$networks = $this->preferences_field('preferences_sharing_networks', true);
						if( is_array( $networks ) ) {
							echo '<div class="rwp-ur-sharing">';
							foreach ($networks as $network) {
								self::$network( $this->post_id, $rating['rating_id'] );
							}
							echo '</div>';
						}
					}
					?>
				</div> <!-- /ur-ratings-wrap -->
				
			</div> <!-- /ur-content -->

		</div> <!-- /user-review -->

	<?php 
		// === END OUTPUT ===
		if( $i == 1 || $count == $j  ) {
			echo'</div> <!-- /page -->';
		}

		$i = ($i == 1) ? $per_page : ($i - 1);
		$j++;
		$highlighted = false;
		
		endforeach; 
	?>

	</div> <!-- /users-reviews -->

	<?php if ( count($this->ratings) > $this->ratings_per_page): ?>
	<span class="rwp-show-more" data-per-page="<?php echo $this->ratings_per_page ?>"><?php _e('Show more', $this->plugin_slug) ?></span>
	<?php endif ?>

</div> <!-- /users-reviews-wrap -->

<?php endif ?>
