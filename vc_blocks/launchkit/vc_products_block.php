<?php 

/**
 * The Shortcode
 */
function ebor_products_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '999',
				'filter' => 'all'
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
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'product',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'product_cat', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}
	
	/**
	 * Finally, here's the query.
	 */
	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>
		
		<div class="woocommerce">
	<?php if ( $block_query->have_posts() ) : ?>

		<?php woocommerce_product_loop_start(); ?>
	
			<?php woocommerce_product_subcategories(); ?>
	
			<?php while ( $block_query->have_posts() ) : $block_query->the_post(); ?>
	
				<?php wc_get_template_part( 'content', 'product' ); ?>
	
			<?php endwhile; // end of the loop. ?>
	
		<?php woocommerce_product_loop_end(); ?>
	
	<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
	
		<?php wc_get_template( 'loop/no-products-found.php' ); ?>
	
	<?php endif; wp_reset_query(); ?>
	
	</div>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_products', 'ebor_products_shortcode' );

/**
 * The VC Functions
 */
function ebor_products_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("WooCommerce Products", 'launchkit'),
			"base" => "launchkit_products",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'launchkit'),
					"param_name" => "pppage",
					"value" => '8'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_products_shortcode_vc');