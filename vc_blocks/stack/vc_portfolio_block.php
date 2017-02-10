<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'carousel-1',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
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
				'field' => 'slug',
				'terms' => $filter
			)
		);
	}
	
	global $wp_query, $post;
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	
	ob_start();
	
	echo '<div class="'. $custom_css_class .'">';
	get_template_part('loop/loop-portfolio', $layout);
	echo '</div>';
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'stack_portfolio', 'ebor_portfolio_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Portfolio Feeds", 'stackwordpresstheme'),
			"base" => "stack_portfolio",
			"category" => esc_html__('stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Show portfolio posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'stackwordpresstheme'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Portfolio Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Portfolio Carousel 1' => 'carousel-1',
						'Portfolio Carousel 2' => 'carousel-2',
						'Titles Outside 1 Column' => 'titles-outside-1',
						'Titles Outside 2 Columns' => 'titles-outside-2',
						'Titles Outside 3 Columns' => 'titles-outside-3',
						'Titles Inside 1 Column' => 'titles-inside-1',
						'Titles Inside 2 Columns' => 'titles-inside-2',
						'Titles Inside 3 Columns' => 'titles-inside-3',
						'Titles Inside on Hover 1 Column' => 'titles-hover-1',
						'Titles Inside on Hover 2 Columns' => 'titles-hover-2',
						'Titles Inside on Hover 3 Columns' => 'titles-hover-3',
						'Tiles' => 'tiles',
						'Squares' => 'squares',
						'Fullscreen Slider' => 'fullscreen',
						'Fullwidth (gapless) Titles on Hover 2 Columns' => 'fullwidth-2',
						'Fullwidth (gapless) Titles on Hover 3 Columns' => 'fullwidth-3'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_portfolio_shortcode_vc');
