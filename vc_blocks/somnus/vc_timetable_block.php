<?php 

/**
 * The Shortcode
 */
function somnus_timetable_shortcode( $atts ) {
	global $wp_query;

	extract( 
		shortcode_atts( 
			array(
				'filter' => 'all'
			), $atts 
		) 
	);	
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'class',
		'posts_per_page' => '-1'
	);

	if( 'all' !== $filter ){
	
	//Check for WPML
		if( has_filter( 'wpml_object_id' ) ){
		
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
			
			$filterClass    = get_term_by( 'slug', $filter, 'class_category' );
			$ID             = (int) apply_filters( 'wpml_object_id', (int) $filterClass->term_id, 'class_category', true );
			$translatedSlug = get_term_by( 'id', $ID, 'class_category' );
			$filter         = $translatedSlug->slug;
			
			//Adding filter back
			add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
			
		}
			
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'class_category',
				'field'    => 'slug',
				'terms'    => $filter
			)
		);	
		
	}

	$wp_query = new WP_Query( $query_args );
	$wp_query->{"filter"} = $filter;
	
	ob_start();
	
	get_template_part('loop/loop', 'class');
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'somnus_timetable', 'somnus_timetable_shortcode' );

/**
 * The VC Functions
 */
function somnus_timetable_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Classes Timetable", 'somnus'),
			"base" => "somnus_timetable",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			'description' => 'Show your classes timetable',
			"params" => array()
		) 
	);
	
}
add_action( 'vc_before_init', 'somnus_timetable_shortcode_vc');