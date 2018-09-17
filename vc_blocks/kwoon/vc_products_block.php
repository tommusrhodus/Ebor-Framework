<?php 

/**
 * The Shortcode
 */
function ebor_products_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'carousel',
				'pppage' => '999',
				'filter' => 'all',
				'filters' => 'yes',
				'more' => 'no'
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

	$block_query = new WP_Query( $query_args );

	ob_start();
	
		woocommerce_product_loop_start();
		
		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		
			wc_get_template_part( 'content', 'product' );
			
		endwhile;	
		else : 
			
			/**
			 * Display no posts message if none are found.
			 */
			get_template_part('loop/content','none');
			
		endif;
		
		woocommerce_product_loop_end();
		wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'kwoon_products', 'ebor_products_shortcode' );

/**
 * The VC Functions
 */
function ebor_products_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("WooCommerce Products", 'kwoon'),
			"base" => "kwoon_products",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Show portfolio posts in the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'kwoon'),
					"param_name" => "pppage",
					"value" => '8'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_products_shortcode_vc');