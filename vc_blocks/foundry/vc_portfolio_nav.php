<?php 

/**
 * The Shortcode
 */
function ebor_portfolio_nav_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'prev_title' => 'Previous Project',
				'next_title' => 'Next Project',
			), $atts 
		) 
	);

	$prev_post = get_adjacent_post(false, '', true);
	$next_post = get_adjacent_post(false, '', false);
	
	if( empty($prev_post) && empty($next_post) ){
		return false;
	}

	$output = '<div class="row"><div class="col-sm-6 text-left">';

	if( !empty( $prev_post ) ) {
		$output .= '			
			<h6 class="uppercase">'. esc_html( $prev_title ) .'</h6>
			<a href="'.  esc_url( get_permalink( $prev_post->ID ) ) .'"><h4>'. esc_html( $prev_post->post_title ) .'</h4></a>			
		';
	}

	$output .= '</div><div class="col-sm-6 text-right">';

	if( !empty( $next_post ) ) {
		$output .= '			
			<h6 class="uppercase">'. esc_html( $next_title ) .'</h6>
			<a href="'.  esc_url( get_permalink( $next_post->ID ) ) .'"><h4>'. esc_html( $next_post->post_title ) .'</h4></a>
		';
	}	

	$output .= '</div></div>';

	return $output;
}
add_shortcode( 'foundry_portfolio_nav_block', 'ebor_portfolio_nav_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_portfolio_nav_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Portfolio Next/Previous Navigation", 'foundry'),
			"base" => "foundry_portfolio_nav_block",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'Used to display next/previous project links.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Prevous Link Title", 'foundry'),
					"param_name" => "prev_title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Next Link Title", 'foundry'),
					"param_name" => "next_title",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_portfolio_nav_block_shortcode_vc' );