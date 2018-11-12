<?php 

/**
 * The Shortcode
 */
function ebor_clients_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '8',
				'filter' => 'all'
			), $atts 
		) 
	);
	
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
	
	<div class="cta cta-4 bg-secondary">
		<div class="row">
			<div class="col-sm-12 text-center">
				<?php
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
	
						get_template_part('loop/content','client');
						
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
		</div>
	</div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_clients', 'ebor_clients_shortcode' );

/**
 * The VC Functions
 */
function ebor_clients_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Clients", 'launchkit'),
			"base" => "launchkit_clients",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'launchkit'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_clients_shortcode_vc');