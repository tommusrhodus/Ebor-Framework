<?php 

/**
 * The Shortcode
 */
function ebor_client_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'carousel',
				'pppage' => '5',
				'filter' => 'all'
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

	$block_query = new WP_Query( $query_args );

	ob_start();
?>
	
	<?php if( $type == 'carousel' ) : ?>
		
		<div class="carousel-wrapper">
			<div class="carousel clients">
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-client', 'carousel');
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
					wp_reset_postdata();
				?>
			</div>
		</div>
		
	<?php endif; ?>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'hygge_client', 'ebor_client_shortcode' );

/**
 * The VC Functions
 */
function ebor_client_shortcode_vc() {
	
	$client_types = array(
		'Client Carousel' => 'carousel'
	);
	
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Client Feeds", 'hygge'),
			"base" => "hygge_client",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Show client posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'hygge'),
					"param_name" => "pppage",
					"value" => '5'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'hygge'),
					"param_name" => "type",
					"value" => $client_types
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_client_shortcode_vc');