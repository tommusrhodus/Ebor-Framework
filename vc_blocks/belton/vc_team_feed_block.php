<?php 

/**
 * The Shortcode
 */
function ebor_team_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage'       => '6',
				'filter'       => 'all',				
				'layout'        => '3-columns',				
				'show_title' 	=> 'no'
			), $atts 
		) 
	);
	
	/**
	 * Setup team query
	 */
	$query_args = array(
		'post_type'      => 'team',
		'post_status'    => 'publish',
		'posts_per_page' => $pppage
	);
	
	//Hide current team ID from the loop if we're in a singular view
	if( is_single() && isset($team->ID) ){
		$query_args['team__not_in']	= array($team->ID);
	}
	
	if(!( $filter == 'all' )) {
		
		//Check for WPML
		if( has_filter('wpml_object_id') ){
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
			
			$filterClass = get_term_by('slug', $filter, 'team_category');
			$ID = (int) apply_filters('wpml_object_id', (int) $filterClass->term_id, 'team_category', true);
			$translatedSlug = get_term_by('id', $ID, 'team_category');
			$filter = $translatedSlug->slug;
			
			//Adding filter back
			add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
		}
			
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field'    => 'slug',
				'terms'    => $filter
			)
		);	
		
	}
	
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	$wp_query->{"show_title"} = $show_title;
	
	ob_start();

	get_template_part('loop/loop-team', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'belton_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'belton-vc-block',
			"name"        => esc_html__( "Team Feeds", 'belton' ),
			"base"        => "belton_team",
			"category"    => esc_html__( 'belton WP Theme', 'belton' ),
			'description' => 'Show team teams with layout options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Show How Many Posts?", 'belton' ),
					"param_name" => "pppage",
					"value"      => '6'
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Team Display Type", 'belton' ),
					"param_name" => "layout",
					"value"      => ebor_get_team_layouts()
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Show Title (Set in theme options)?", 'belton'),
					"param_name" => "show_title",
					"value"      => array(
						'No'  => 'no',
						'Yes' => 'yes'
					)
				),				
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');