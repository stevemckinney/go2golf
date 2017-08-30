<?php

class RWP_Ratings_Widget extends WP_Widget {

	public $plugin_slug;
	public $widget_fields;
	public $templates;
	public $preferences;
	public $ratings_options;

	private $comment_limit = 100;

	/*  for PRO users! - *
	 * Sets up the widgets name etc
	 */
	public function __construct() 
	{
		// widget actual processes

		$this->plugin_slug 		= 'reviewer';
		$this->templates 		= RWP_Reviewer::get_option('rwp_templates');
		$this->preferences 		= RWP_Reviewer::get_option('rwp_preferences');
		
		$template_fields 		= RWP_Template_Manager_Page::get_template_fields();
		$this->ratings_options 	= $template_fields['template_user_rating_options']['options'];
		unset( $this->ratings_options['rating_option_captcha'], $this->ratings_options['rating_option_email'], $this->ratings_options['rating_option_like'] );
		$this->ratings_options['rating_option_post_title'] = __( 'Post Title', $this->plugin_slug );
		$this->ratings_options['rating_option_link'] = __( 'Show Link', $this->plugin_slug );

		add_action( 'init', array( $this ,'set_widget_fields') );

		$options = array(
			'description'	=> __( 'Reviewer Plugin Widget allows you to display your latest, top score users reviews.', $this->plugin_slug),
			'name'			=> 'Reviewer | Users Reviews'
		);
		
		parent::__construct('rwp-ratings-widget', '', $options);
	}

	/*  for PRO users! - *
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) 
	{
		extract( $instance );

		echo $args['before_widget'];

		if(  isset( $title ) && !empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		// Templates
		if( isset( $template ) && !is_array( $template ) ) {
			$template = ( $template == 'all' ) ? array_keys( $this->templates ) : array( $template );
		} elseif ( !isset( $template ) ) {
			$template = array_keys( $this->templates );
		}

		// Sort 
		$sort = $this->widget_field( $instance, 'to_display', true );
		//Limit 
		$limit = $this->widget_field( $instance, 'to_display_count', true );
		
		// Get Ratings
		$ratings = self::query_ratings( $template, $sort, $limit );

		$options = $this->widget_field( $instance, 'options' ,true);

		echo '<ul class="rwp-widget-ratings">';

		foreach ($ratings as $i => $rating ) {

			//RWP_Reviewer::pretty_print( $rating );

			$rank_num = '';

			if( $sort != 'latest' ) {
				$rank_num = '<span class="rwp-ranking-number">'. ($i + 1) .'</span>';
			}

			$has_rank = ( !empty( $rank_num ) ) ? 'rwp-has-ranking' : '';

			echo '<li class="'. $has_rank .'">';

				echo $rank_num;
				
				echo '<div class="rwp-wdj-content">'; 
					// Post
					if( in_array( 'rating_option_post_title', $options ) ) {
						
						echo '<span class="rwp-w-post-title">' . get_the_title( $rating['rating_post_id']) . '</span>';	

					} // Post
					echo '<div class="rwp-cell">';

					// Avatar
					$has_avatar = '';

					if( in_array( 'rating_option_avatar' , $options ) ) {

						$avatar = ( $rating['rating_user_id'] == 0 && isset( $rating['rating_user_email'] ) && !empty( $rating['rating_user_email'] ) ) ? $rating['rating_user_email'] : $rating['rating_user_id'];
						echo get_avatar( $avatar, 30 );

						$has_avatar = 'rwp-has-avatar';
					} // Avatar

						echo '<div class="rwp-cell-content '. $has_avatar .'">';

						// Username
						if( in_array( 'rating_option_name', $options ) ) {

							$name = ( $rating['rating_user_id'] > 0 ) ? get_user_by( 'id', $rating['rating_user_id'] )->display_name : $rating['rating_user_name'];
							
							echo '<span class="rwp-w-name">'. $name .'</span>';
						
						} // Username

						// Date
						echo '<span class="rwp-w-date"> '. date_i18n( get_option( 'date_format' ) . ', ' . get_option( 'time_format' ), $rating['rating_date'] ) . '</span>';

						// Score
						if( in_array( 'rating_option_score', $options ) ) {
							
							$mode 		= $this->preferences['preferences_rating_mode'];
							$template 	= (isset( $rating['rating_template'] ) ) ? $this->templates[ $rating['rating_template'] ] : array();

							switch ( $mode ) {

								case 'five_stars':
								case 'full_five_stars':

									echo RWP_Reviewer::get_stars( $rating['rating_score'], $template );									
									break;

								default:

									echo '<div class="rwp-criterion">';

										echo '<div class="rwp-criterion-bar-base">';
											echo RWP_Reviewer::get_score_bar( $rating['rating_score'], $template );
										echo '</div><!-- /criterion-bar -->';

										echo '<span class="rwp-criterion-score">'. round( RWP_Reviewer::get_avg(  $rating['rating_score'] ), 1 )  .'</span>';


									echo '</div><!-- /criterion -->';
									break;
							}
			
						} // Score

						echo '</div><!-- /cell-content -->';

					echo '</div><!-- /cell -->';

					// Title
					if( in_array( 'rating_option_title', $options ) && !empty( $rating['rating_title'] ) ) {
						
						echo '<span class="rwp-w-title">' . $rating['rating_title'] . '</span>';	

					} // Title

					// Comment
					if( in_array( 'rating_option_comment', $options ) && !empty( $rating['rating_comment'] ) ) {

						$comment = $rating['rating_comment'];

						if ( strlen( $comment ) >  $this->comment_limit )
  							$comment = substr( $comment, 0, $this->comment_limit ) . '...';
						
						echo '<p class="rwp-w-comment">' . $comment . '</p>';	

					} // Comment

					// Show Link
					if( in_array( 'rating_option_link', $options ) ) {
						$url = add_query_arg( 'rwpurid', $rating['rating_id'], get_permalink( $rating['rating_post_id'] ) );
						echo '<a href="'. esc_url( $url) .'">'. $this->widget_field( $instance, 'show', true ) .'</a>';
					} // link

				echo '</div> <!-- /content -->';

			echo '</li>';		
		}

		echo '</ul>';

		echo $args['after_widget'];
	}

	/*  for PRO users! - *
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) 
	{
		// outputs the options form on admin

		//$this->pretty_print ($instance);
		//$this->pretty_print ($this->templates);
		echo '<div class="rwp-widget-form-wrap">';

		foreach( $this->widget_fields as $field_key => $field ) {
			$value = ( isset( $instance[ $field_key ] ) ) ? $instance[ $field_key ] : '';

			echo '<p>';
			echo '<label for="">'. $field['label'] .':';
			switch ( $field_key) {

				case 'to_display':
					foreach ($field['options'] as $key => $label) {
						$ck = ( $key == $value ) ? 'checked' : '';
						echo '<span class="rwp-block"><input type="radio" id="'. $this->get_field_id( $field_key.$key ) .'" name="'. $this->get_field_name( $field_key ) .'" value="'. $key .'" '. $ck .'/> ' . $label . '</span>';
					}
					break;

				case 'options':

					if( !is_array( $value ) ) {
						$value = array_keys( $this->ratings_options );
					}

					foreach ($this->ratings_options as $key => $t) {
						$ck = ( in_array($key, $value) ) ? 'checked' : '';
						echo '<span class="rwp-block"><input type="checkbox" id="'. $this->get_field_id( $field_key.$key ) .'" name="'. $this->get_field_name( $field_key ) .'[]" value="'. $key .'" '. $ck .'/> ' .$t . '</span>';
					}
					break;

				case 'template':

					if( !is_array( $value )  )
						$value = ( $value == 'all' ) ? array_keys( $this->templates ) : array( $value );
					
					foreach ($this->templates as $key => $t) {
						$ck = ( in_array($key, $value) ) ? 'checked' : '';
						echo '<span class="rwp-block"><input type="checkbox" id="'. $this->get_field_id( $field_key.$key ) .'" name="'. $this->get_field_name( $field_key ) .'[]" value="'. $key .'" '. $ck .'/> ' .$t['template_name'] . '</span>';
					}
					break;

				default:
					echo ( ! empty( $field['description'] ) ) ? '<span class="description">'. $field['description'] .'</span>' : '';
					echo'</label>';
					echo '<input class="widefat" type="text" id="'. $this->get_field_id( $field_key ) .'" name="'. $this->get_field_name( $field_key ) .'" value="'.$value.'" placeholder="'. $field['default'] .'" />';
					break;
			}
			echo '</p>';
		}

		echo '</div><!--/widget-form-wrap-->';
	}

	/*  for PRO users! - *
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) 
	{
		//return array();

		$valid_instance = array();

		//RWP_Reviewer::pretty_print($new_instance); die();

		foreach( $this->widget_fields as $field_key => $field ) {

			if( ! isset( $new_instance[ $field_key ]  ) ) { // Check if field is set
				$valid_instance[ $field_key ] = $field['default'];
				continue;
			}

			$value = ( is_array( $new_instance[ $field_key ] ) ) ? $new_instance[ $field_key ] : trim( $new_instance[ $field_key ] );

			switch ( $field_key) {
				case 'to_display':
				case 'theme':
					$valid_instance[ $field_key ] = ( isset( $field['options'][ $value ] ) ) ? $value : $field['default'];
					break;

				case 'to_display_count':
					$value = intval( $value );
					$valid_instance[ $field_key ] = ( $value > 0 ) ? $value : $field['default'];
					break;

				case 'box_color' :
					$valid_instance[ $field_key ] = ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) ? $value : $field['default'];
					break;

				case 'options':
				case 'template':
					$valid_instance[ $field_key ] = ( ! empty( $value) ) ?  $value : $field['default'];
					break;

				default:
					$valid_instance[ $field_key ] = ( ! empty( $value) ) ? esc_sql( esc_html( $value ) ) : $field['default'];
					break;
			}
		}

		return $valid_instance;
	}

	public function query_ratings( $template, $sort, $limit )
	{
		global $wpdb;
		$result = array();

		$post_meta = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key LIKE 'rwp_rating%';", ARRAY_A );
		
		foreach( $post_meta as $meta ) {

			$rating = unserialize( $meta['meta_value'] );

            if( !isset( $rating['rating_id'] ) )
                continue;

            $rating['rating_meta_id'] = $meta['meta_id'];

            if( isset( $rating['rating_status'] ) && $rating['rating_status'] != 'published')
            	continue;

            $result[ $rating['rating_id'] ] = $rating;
		}

		switch ( $sort ) {
			
			case 'top_score':
				usort( $result, array( 'RWP_Ratings_Widget', 'sort_score' ) );
				break;

			case 'latest':
			default:
				usort( $result, array( 'RWP_Ratings_Widget', 'sort_latest' ) );
				break;
		}

		// Limit
		$rts = array_slice ( $result , 0, $limit );

		return $rts;
	}

	public static function sort_latest( $a, $b )
	{
		if ($a["rating_date"] == $b["rating_date"])
        	return 0;
   
   		return ($a["rating_date"] > $b["rating_date"]) ? -1 : 1;
	}

	public static function sort_score( $a, $b )
	{
		$avg_a = RWP_Reviewer::get_avg( $a['rating_score'] );
		$avg_b = RWP_Reviewer::get_avg( $b['rating_score'] );

		if (  $avg_a ==  $avg_b )
        	return 0;
   
   		return ( $avg_a >  $avg_b ) ? -1 : 1;
	}

	public function widget_field( $instance, $field, $return = false ) {

		$value = isset( $instance[ $field ] ) ? $instance[ $field ] : $this->widget_fields[ $field ]['default'];

		if( $return )
			return $value;

		echo $value;
	}

	public static function template_field( $field, $template, $return = false ) {

		$default_template = RWP_Template_Manager_Page::get_template_fields();

		$value = isset( $template[ $field ] ) ? $template[ $field ] : $default_template[ $field ]['default'];

		if( $return )
			return $value;

		echo $value;
	}

	public function set_widget_fields() 
	{
		$this->widget_fields = array(
			'title' => array(
				'label' 		=> __( 'Title', $this->plugin_slug ),
				'default'		=> '',
				'description' 	=> ''
			),

			'template' => array(
				'label' 		=> __( 'Template', $this->plugin_slug ), 
				'default'		=> array_keys($this->templates),
				'description' 	=> ''
			),

			'options' => array(
				'label' 		=> __( 'Rating Options', $this->plugin_slug ), 
				'default'		=> array_keys($this->ratings_options),
				'description' 	=> ''
			),

			'to_display' => array(
				'label' 		=> __( 'To display', $this->plugin_slug ),
				'options' 		=> array(
					'latest'			=> __( 'Latest Ratings', $this->plugin_slug ),
					'top_score'			=> __( 'Top Score Ratings', $this->plugin_slug ),
				),
				'default'		=> 'latest',
				'description' 	=> ''
			),

			/*  for PRO users! - 'theme' => array(
				'label' 		=> __( 'Theme', $this->plugin_slug ),
				'options' 		=> array(
					'theme-1'			=> __( 'Theme 1 - Big Format', $this->plugin_slug ),
					'theme-2'			=> __( 'Theme 2 - Small Format', $this->plugin_slug ),
				),
				'default'		=> 'theme-1',
				'description' 	=> ''
			),*/

			'show' => array(
				'label' 	=> __( 'Show Link Label', $this->plugin_slug ),
				'default'	=> __( 'Show', $this->plugin_slug ),
			),

			'to_display_count' => array(
				'label' 	=> __( 'Number of ratings to display', $this->plugin_slug ),
				'default'	=> '5' 
			),
		);
		
	}

	// Method that well print data - debug 
	public function pretty_print( $data = array() ) 
	{
		echo "<pre>"; 
		print_r($data); 
		echo "</pre>";
	}
}