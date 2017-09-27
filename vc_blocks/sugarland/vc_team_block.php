<?php 

/**
 * The Shortcode
 */
function ebor_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '5',
				'filter' => 'all',
				'layout' => 'grid'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'team',
		'post_status' => 'publish',
		'posts_per_page' => $pppage
	);
	
	//Hide current post ID from the loop if we're in a singular view
	global $post;
	if( is_single() && isset($post->ID) ){
		$query_args['post__not_in']	= array($post->ID);
	}
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field' => 'slug',
				'terms' => $filter
			)
		);
	}
	
	global $wp_query, $post;
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();

	get_template_part( 'loop/loop', 'team' );
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'sugarland_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'sugarland-vc-block',
			"name" => esc_html__("Team Feeds", 'sugarland'),
			"base" => "sugarland_team",
			"category" => esc_html__('sugarland WP Theme', 'sugarland'),
			'description' => 'Show team posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'sugarland'),
					"param_name" => "pppage",
					"value" => '5'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');
