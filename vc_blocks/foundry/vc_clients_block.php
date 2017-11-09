<?php 

/**
 * The Shortcode
 */
function ebor_clients_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '8',
				'filter' => 'all',
				'layout' => 'carousel'
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
	
	if( 'carousel' == $layout ) :
?>
	
	<div class="logo-carousel">
		<ul class="slides">
			<?php
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();

					get_template_part('loop/content','client-carousel');
					
				endwhile;
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
		</ul>
	</div>
	
<?php else : ?>
	
	<div class="row">
	    <div class="col-sm-12 text-center spread-children-large">
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
			?>
	    </div>
	</div>

<?php
	endif;
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'foundry_clients', 'ebor_clients_shortcode' );

/**
 * The VC Functions
 */
function ebor_clients_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Clients", 'foundry'),
			"base" => "foundry_clients",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'foundry'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Carousel Images' => 'carousel',
						'Static Images (With Tooltip Rollover)' => 'static'
					)
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_clients_shortcode_vc');