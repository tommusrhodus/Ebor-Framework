<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'large',
				'pppage' => '999',
				'show_filter' => 'No',
				'filter' => 'all',
				'layout' => 'full'
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
	
	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}
	
	ob_start();
	
	if( 'full' == $layout ) : 
?>
	
	<section class="features features-18">
		<?php 
			if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
				/**
				 * Get blog posts by blog layout.
				 */
				get_template_part('loop/content', 'portfolio-full');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
			wp_reset_query();
		?>
	</section>
	
<?php else : ?>
	
	<section class="demos">
		<div class="row">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content-portfolio', 'grid');
				
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
	</section>
	
<?php	
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'launchkit_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Portfolio", 'launchkit'),
			"base" => "launchkit_portfolio",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'launchkit'),
					"param_name" => "pppage",
					"value" => '8'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Layout", 'launchkit'),
					"param_name" => "layout",
					"value" => array_flip(array(
						'full' => 'Full 3 Columns Layout',
						'grid' => 'Grid 2 Columns Layout'
					))
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');