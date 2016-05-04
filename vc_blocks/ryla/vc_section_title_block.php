<?php 

/**
 * The Shortcode
 */
function ebor_section_title_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'layout' => 'small'
			), $atts 
		) 
	);
	
	if( 'small' == $layout ){
	
		$output = '
			<div class="section-title text-center">
				<h2>'. esc_html($title) .'</h2>
				<h3>'. esc_html($subtitle) .'</h3>
			</div>
		';
		
	} else {
	
		$output = '
			<div class="section-title text-center">
				<h3>'. esc_html($title) .'</h3>
				<p class="lead">'. esc_html($subtitle) .'</p>
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'ryla_section_title_block', 'ebor_section_title_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => esc_html__("Section Title", 'ryla'),
			"base" => "ryla_section_title_block",
			"category" => esc_html__('ryla WP Theme', 'ryla'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'ryla'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'ryla'),
					"param_name" => "subtitle"
				),
				array(
					'type' => 'dropdown',
					"heading" => esc_html__("Layout", 'ryla'),
					'param_name' => 'layout',
					'value' => array(
						'Small Title' => 'small',
						'Large Title' => 'large'
					)
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_block_shortcode_vc' );