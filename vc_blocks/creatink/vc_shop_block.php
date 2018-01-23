<?php 

/**
 * The Shortcode
 */
function ebor_product_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '6',
				'filter' => 'all',
				'layout' => 'grid-3'
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
	
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('woocommerce/loop-product', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'creatink_product', 'ebor_product_shortcode' );

/**
 * The VC Functions
 */
function ebor_product_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Product Feeds", 'creatink'),
			"base" => "creatink_product",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Show product posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'creatink'),
					"param_name" => "pppage",
					"value" => '6'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Product Display Type", 'creatink'),
					"param_name" => "layout",
					"value" => ebor_get_shop_layouts()
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_product_shortcode_vc');