<?php 

/**
 * The Shortcode
 */
function ebor_clients_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '8',
				'type' => 'grid',
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
	
	if( 'Row' == $type ) :
?>
	
	<div class="clients-2">
		<?php
			$amount = (12 / $pppage);
			
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				echo '<div class="col-md-'. $amount .' col-sm-4">';
				get_template_part('loop/content','client');
				echo '</div>';
				
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

<?php else : ?>
	
	<div class="row client-row">
		<div class="row-wrapper">
			
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					get_template_part('loop/content','client-alt');
					
				if( ($block_query->current_post + 1) % 4 == 0 && !( ($block_query->current_post) + 1 == $pppage ) )
					echo '</div></div><div class="row client-row"><div class="row-wrapper">';
					
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

<?php	
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'pivot_clients', 'ebor_clients_shortcode' );

/**
 * The VC Functions
 */
function ebor_clients_shortcode_vc() {
	
	$args = array(
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'taxonomy'                 => 'client_category'
	); 
		
	$filter_options = get_categories( $args );
	
	$display_types = array(
		'Bordered Grid',
		'Row',
	);
	
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Clients", 'pivot'),
			"base" => "pivot_clients",
			"category" => __('Pivot - Feeds', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'pivot'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'pivot'),
					"param_name" => "type",
					"value" => $display_types,
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_clients_shortcode_vc');