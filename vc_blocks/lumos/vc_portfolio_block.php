<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'lightbox',
				'pppage' => '999',
				'filter' => 'all',
				'filters' => 'yes',
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
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage,
		'paged' => $paged
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

	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>

	<?php 
		if( 'yes' == $filters && 'all' == $filter ){
			$cats = get_categories('taxonomy=portfolio_category');
			echo ebor_portfolio_filters($cats); 
		} elseif( 'yes' == $filters ) {
			$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
			echo ebor_portfolio_filters($cats); 
		} else {
			echo '<h2 class="section-title">'. wp_kses(get_option('portfolio_title', 'From My Portfolio'), ebor_allowed_tags()) .'</h2>';
		}
	?>
	
	<div id="grid-container" class="cbp-l-grid-masonry">
		<ul class="ebor-load-more">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content-portfolio', $type);
				
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
			
<?php	
	ebor_load_more($block_query->max_num_pages);
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'lumos_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	
	$types = ebor_get_portfolio_layouts();
	
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Portfolio Feeds", 'lumos'),
			"base" => "lumos_portfolio",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'Show portfolio posts in the page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'lumos'),
					"param_name" => "pppage",
					"value" => '999'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'lumos'),
					"param_name" => "type",
					"value" => $types
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'lumos'),
					"param_name" => "filters",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');