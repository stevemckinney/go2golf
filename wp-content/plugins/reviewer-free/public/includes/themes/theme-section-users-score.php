<?php 
if ( !$this->is_users_rating_disabled() ): 

	$data = RWP_Reviewer::get_users_overall_score( $this->ratings_scores, $this->post_id, $this->review_field('review_id', true) );
	$score = $data['score'];
	$count = $data['count'];
	$theme = $this->template_field('template_theme', true);

	$this->snippets->add('aggregateRating', array());
    $this->snippets->add('aggregateRating.@type', 'AggregateRating');
    $this->snippets->add('aggregateRating.ratingValue', $score);
    $this->snippets->add('aggregateRating.worstRating', $this->template_field('template_minimum_score', true));
    $this->snippets->add('aggregateRating.bestRating', $this->template_field('template_maximum_score', true));
    $this->snippets->add('aggregateRating.ratingCount', $count);
?>

<div 
    class="rwp-users-score <?php if ( $is_UR ) echo 'rwp-ur' ?>" 

    <?php if ( $theme != 'rwp-theme-8' ): ?>
   	style="background: <?php $this->template_field('template_users_score_box_color') ?>; " 
    <?php endif ?>
>

	<?php $bg = ( $theme == 'rwp-theme-8' ) ? 'style="background: '. $this->template_field('template_users_score_box_color', true) .'; "': ''; ?>

		
	<?php $count_label = ( $count == 1 ) ? $this->template_field('template_users_count_label_s', true) : $this->template_field('template_users_count_label_p', true);
	if ( ($has_img || $is_UR) && ( $theme != 'rwp-theme-8' && $theme != 'rwp-theme-4' ) ): ?>
	<span class="rwp-users-score-value" <?php echo $bg; ?> ><?php echo $score ?></span>
    <span class="rwp-users-score-label"><?php $this->template_field('template_users_score_label') ?></span>
    <span class="rwp-users-score-count">(<?php echo $count ?> <?php echo $count_label ?>)</span>
	<?php elseif( $theme == 'rwp-theme-4' || $theme == 'rwp-theme-8' ): ?>
	<span class="rwp-users-score-label"><?php $this->template_field('template_users_score_label') ?></span>
	<span class="rwp-users-score-count">(<?php echo $count ?> <?php echo $count_label ?>)</span>
	<span class="rwp-users-score-value" <?php echo $bg; ?> ><?php echo $score ?></span>
	<?php else: ?>
	<span class="rwp-users-score-label"><?php $this->template_field('template_users_score_label') ?></span>
	<span class="rwp-users-score-value" <?php echo $bg; ?> ><?php echo $score ?></span>
    <span class="rwp-users-score-count">(<?php echo $count ?> <?php echo $count_label ?>)</span>
	<?php endif ?>
 
</div><!--/users-score-->

<?php endif; ?>