<?php 

/**
 * The Shortcode
 */
function ebor_product_carousel_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '8'
			), $atts 
		)
	);

	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'product',
		'posts_per_page' => $pppage
	);

	global $wp_query;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	get_template_part('loop/loop-product','carousel');
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	
	return $output;
}
add_shortcode( 'ryla_product_carousel', 'ebor_product_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_product_carousel_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => __("WooCommerce product Carousel", 'ryla'),
			"base" => "ryla_product_carousel",
			"category" => __('ryla WP Theme', 'ryla'),
			'description' => 'Show product posts in a carousel.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'ryla'),
					"param_name" => "pppage",
					"value" => '8'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_product_carousel_shortcode_vc');