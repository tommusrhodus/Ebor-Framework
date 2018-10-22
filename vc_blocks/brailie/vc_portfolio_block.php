<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'basic'
			), $atts 
		) 
	);
	
	if( 0 == $pppage || isset($wp_query->doing_portfolio_shortcode) ){
		return false;	
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type'      => 'portfolio',
		'post_status'    => 'publish',
		'posts_per_page' => $pppage
	);
	
	//Hide current post ID from the loop if we're in a singular view
	if( is_single() && isset($post->ID) ){
		$query_args['post__not_in']	= array($post->ID);
	}
	
	if (!( $filter == 'all' )) {
		
		//Check for WPML
		if( has_filter('wpml_object_id') ){
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
			
			$filterClass = get_term_by('slug', $filter, 'portfolio_category');
			$ID = (int) apply_filters('wpml_object_id', (int) $filterClass->term_id, 'portfolio_category', true);
			$translatedSlug = get_term_by('id', $ID, 'portfolio_category');
			$filter = $translatedSlug->slug;
			
			//Adding filter back
			add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
		}
		
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field'    => 'slug',
				'terms'    => $filter
			)
		);
		
	}
	
	$old_query = $wp_query;
	$old_post  = $post;
	$wp_query  = new WP_Query( $query_args );
	
	ob_start();

	get_template_part('loop/loop-portfolio', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post     = $old_post;
	
	return $output;
}
add_shortcode( 'brailie_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'brailie-vc-block',
			"name"        => esc_html__("Portfolio Feeds", 'brailie'),
			"base"        => "brailie_portfolio",
			"category"    => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Show portfolio posts with layout options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Show How Many Posts?", 'brailie'),
					"param_name" => "pppage",
					"value"      => '4'
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("portfolio Display Type", 'brailie'),
					"param_name" => "layout",
					"value"      => brailie_get_portfolio_layouts()
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');