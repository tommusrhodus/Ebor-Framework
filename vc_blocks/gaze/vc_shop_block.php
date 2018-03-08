<?php 

/**
 * The Shortcode
 */
function ebor_shop_shortcode( $atts ) {
	global $wp_query, $post, $paged;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => $pppage,
		'paged'          => $paged
	);
	
	//Hide current post ID from the loop if we're in a singular view
	if( is_single() && isset($post->ID) ){
		$query_args['post__not_in']	= array($post->ID);
	}
	
	$old_query = $wp_query;
	$old_post  = $post;
	$wp_query  = new WP_Query( $query_args );
	$wp_query->{"is_shortcode"} = 'yes';
	
	ob_start();
	
	if ( have_posts() ) {
	
		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked wc_print_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );
	
		woocommerce_product_loop_start();
	
			while ( have_posts() ) {
				the_post();
	
				/**
				 * Hook: woocommerce_shop_loop.
				 *
				 * @hooked WC_Structured_Data::generate_product_data() - 10
				 */
				do_action( 'woocommerce_shop_loop' );
	
				wc_get_template_part( 'content', 'product' );
			}

		woocommerce_product_loop_end();
	
		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'gaze_shop', 'ebor_shop_shortcode' );

/**
 * The VC Functions
 */
function ebor_shop_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Shop Feeds", 'gaze' ),
			"base"        => "gaze_shop",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Show post posts with layout options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Show How Many Posts?", 'gaze' ),
					"param_name" => "pppage",
					"value"      => '4'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_shop_shortcode_vc');