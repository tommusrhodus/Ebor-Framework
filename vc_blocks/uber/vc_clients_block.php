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
	
	<div class="row client-logo-row add-top-half"><?php
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post(); 
			global $post;
			$url = get_post_meta( $post->ID, '_ebor_client_url', true );
			?>

				<article class="col-md-3 text-center client-logo no-pad">
					<div class="client-logo-inner">
						<?php 
							if( $url )
								echo '<a href="'. esc_url($url) .'" target="_blank">';
								
								the_post_thumbnail('large'); 
								
								if( $url )
									echo '</a>';
						?>
					</div>
				</article>
				
				<?php
					if( ($block_query->current_post + 1) % 4 == 0 && !( ($block_query->current_post + 1) == $pppage) )
						echo '</div><div class="row client-logo-row">';
				?>
		
		<?php
			endwhile;
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
			wp_reset_query();
		?></div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'uber_clients', 'ebor_clients_shortcode' );

/**
 * The VC Functions
 */
function ebor_clients_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Clients Logos", 'uber'),
			"base" => "uber_clients",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'uber'),
					"param_name" => "pppage",
					"value" => '8'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_clients_shortcode_vc' );