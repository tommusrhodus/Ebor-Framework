<?php 

/**
 * The Shortcode
 */
function ebor_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'carousel',
				'pppage' => '5',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'team',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>
	
	<?php if( $type == 'carousel' ) : ?>
	
		<div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
			<div class="carousel carousel-boxed team">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();

						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-team', 'carousel');
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
				?>
			</div>
		</div>
		
	<?php elseif( $type == 'feed' ) : ?>
		
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content-team', 'feed');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
		?>
		
	<?php endif; ?>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'kwoon_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	
	$team_types = array(
		'Team Carousel' => 'carousel',
		'Team Feed' => 'feed'
	);
	
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Team Feeds", 'kwoon'),
			"base" => "kwoon_team",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Show team posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'kwoon'),
					"param_name" => "pppage",
					"value" => '5'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'kwoon'),
					"param_name" => "type",
					"value" => $team_types
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');