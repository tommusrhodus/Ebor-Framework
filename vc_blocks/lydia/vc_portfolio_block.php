<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'mosaic',
				'pppage' => '999',
				'filter' => 'all',
				'filters' => 'yes',
				'more' => 'no'
			), $atts 
		)
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}
	
	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}
	
	global $wp_query;
	$old_query = $wp_query;
	
	$wp_query = new WP_Query( $query_args );
	$wp_query->{"show_filters"} = $filters;
	
	ob_start();
	
	get_template_part('loop/loop-portfolio', $type);

	$output = ob_get_contents();
	ob_end_clean();
	
	$wp_query = $old_query;
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'lydia_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = ebor_get_portfolio_layouts();

	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Portfolio Feeds", 'lydia'),
			"base" => "lydia_portfolio",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Show portfolio posts in the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'lydia'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'lydia'),
					"param_name" => "type",
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show Filters?", 'lydia'),
					"param_name" => "filters",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show load more button? (if enough posts load)", 'lydia'),
					"param_name" => "more",
					"value" => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');