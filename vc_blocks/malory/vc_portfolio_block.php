<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'grid',
				'pppage' => '999',
				'filter' => 'all',
				'filters' => 'yes'
			), $atts 
		)
	);
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage
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
	
	global $wp_query, $post;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-portfolio', $type);
	
	$output = ob_get_contents();
	ob_end_clean();

	wp_reset_postdata();
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'malory_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$portfolio_types = ebor_get_portfolio_layouts();

	vc_map( 
		array(
			"icon" => 'malory-vc-block',
			"name" => esc_html__("Portfolio Feeds", 'malory'),
			"base" => "malory_portfolio",
			"category" => esc_html__('malory WP Theme', 'malory'),
			'description' => 'Show portfolio posts in the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'malory'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'malory'),
					"param_name" => "type",
					"value" => $portfolio_types
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show Filters?", 'malory'),
					"param_name" => "filters",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');