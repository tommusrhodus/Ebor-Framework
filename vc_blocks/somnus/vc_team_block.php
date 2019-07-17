<?php 

/**
 * The Shortcode
 */
function somnus_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
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
	
	if( 'all' !== $filter ){
	
	//Check for WPML
		if( has_filter( 'wpml_object_id' ) ){
		
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
			
			$filterClass    = get_term_by( 'slug', $filter, 'team_category' );
			$ID             = (int) apply_filters( 'wpml_object_id', (int) $filterClass->term_id, 'team_category', true );
			$translatedSlug = get_term_by( 'id', $ID, 'team_category' );
			$filter         = $translatedSlug->slug;
			
			//Adding filter back
			add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
			
		}
			
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field'    => 'slug',
				'terms'    => $filter
			)
		);	
		
	}
	
	global $wp_query;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop', 'team');
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'somnus_team', 'somnus_team_shortcode' );

/**
 * The VC Functions
 */
function somnus_team_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Team Feeds", 'somnus'),
			"base" => "somnus_team",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			'description' => 'Show team posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'somnus'),
					"param_name" => "pppage",
					"value" => '5'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'somnus_team_shortcode_vc');