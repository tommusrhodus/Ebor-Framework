<?php 

/**
 * The Shortcode
 */
function ebor_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'large',
				'pppage' => '999',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'team',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
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
	
	<div id="team">
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content', 'team');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content', 'none');
				
			endif;
			wp_reset_query();
		?>
	</div>
	<div class="clear"></div>
	
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'huntington_team', 'ebor_team_shortcode' );

/**
 * The VC Functions
 */
function ebor_team_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'huntington-vc-block',
			"name" => esc_html__("Team Feed", 'huntington'),
			"base" => "huntington_team",
			"category" => esc_html__('Huntington WP Theme', 'huntington'),
			'description' => 'Add your team posts to the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'huntington'),
					"param_name" => "pppage",
					"value" => '8'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_team_shortcode_vc');