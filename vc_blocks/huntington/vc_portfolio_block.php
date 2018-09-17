<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'tiles',
				'pppage' => '999',
				'filter' => 'all'
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
	
	/**
	 * Finally, here's the query.
	 */
	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>
	
	<div id="container" class="clearfix">
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content', 'portfolio-' . $type);
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
			wp_reset_query();
		?>
	</div>

<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'huntington_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$layouts = ebor_get_portfolio_layouts();
	
	vc_map( 
		array(
			"icon" => 'huntington-vc-block',
			"name" => esc_html__("Portfolio", 'huntington'),
			"base" => "huntington_portfolio",
			"category" => esc_html__('Huntington WP Theme', 'huntington'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'huntington'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'huntington'),
					"param_name" => "type",
					"value" => $layouts
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');