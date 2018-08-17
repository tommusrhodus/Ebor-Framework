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
	
	global $ebor_css_class;
	
	if( $pppage % 3 == 0 ){
		$ebor_css_class = 'col-md-4 col-sm-6';
	} elseif( $pppage == 4 || $pppage == 8 ){
		$ebor_css_class = 'col-md-3 col-sm-6';
	} elseif( $pppage % 2 == 0 ){
		$ebor_css_class = 'col-md-6 col-sm-6';
	} elseif( $pppage == 1 ){
		$ebor_css_class = 'col-md-12 col-sm-12';
	}
?>
	
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			
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
	</div><!--end of row-->

<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'meetup_clients', 'ebor_clients_shortcode' );

/**
 * The VC Functions
 */
function ebor_clients_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Clients", 'meetup'),
			"base" => "meetup_clients",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'meetup'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_clients_shortcode_vc');