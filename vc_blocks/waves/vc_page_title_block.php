<?php 

/**
 * The Shortcode
 */
function ebor_page_header_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="page-header text-center">
			<h1>'. trim(strip_tags($title)) .'<small>'. trim(strip_tags($subtitle)) .'</small></h1>
		</div>
	';
		
	return $output;
}
add_shortcode( 'waves_page_header', 'ebor_page_header_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_header_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'waves-vc-block',
			"name" => esc_html__("Page Header", 'waves'),
			'description' => esc_html__('Adds a parallax page header to the layout', 'waves'),
			"base" => "waves_page_header",
			"category" => esc_html__('waves - WP Theme', 'waves'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'waves'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'waves'),
					"param_name" => "subtitle",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_page_header_shortcode_vc' );