<?php 

/**
 * The Shortcode
 */
function ebor_product_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'column-2',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'product_cat', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
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
	
	echo '<div class="'. $custom_css_class .'">';
	get_template_part('loop/loop-product', $layout);
	echo '</div>';
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'stack_product', 'ebor_product_shortcode' );

/**
 * The VC Functions
 */
function ebor_product_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Product Feeds", 'stackwordpresstheme'),
			"base" => "stack_product",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Show product posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'stackwordpresstheme'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Product Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => ebor_get_shop_layouts()
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_product_shortcode_vc');
