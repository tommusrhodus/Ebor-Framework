<?php 

/**
 * The Shortcode
 */
function ebor_client_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '6',
				'filter' => 'all',
				'layout' => 'columns-6'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'client',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'client_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'client_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	global $wp_query, $post;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-client', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'brailie_client', 'ebor_client_shortcode' );

/**
 * The VC Functions
 */
function ebor_client_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Client Feeds", 'brailie'),
			"base" => "brailie_client",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Show client posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'brailie'),
					"param_name" => "pppage",
					"value" => '6'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value" => array(
						'6 Columns'    => 'columns-6',
						'4 Columns'    => 'columns-4',
						'Carousel'     => 'carousel',
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_client_shortcode_vc');