<?php 

/**
 * The Shortcode
 */
function ebor_section_title_shortcode( $atts, $content = null ) {
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
				<h3>'. htmlspecialchars_decode($title) .'</h3>
				<p class="lead">'. htmlspecialchars_decode($subtitle) .'</p>
			</div>
		';
		
	} else {
		
		$output = '
			<div class="headline text-center">
				<h2>'. htmlspecialchars_decode($title) .'</h2>
				<p class="lead">'. htmlspecialchars_decode($subtitle) .'</p>
			</div>
			<div class="divide30"></div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'hygge_section_title', 'ebor_section_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Section Title", 'hygge'),
			"base" => "hygge_section_title",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Create an animated heading for the section, uses an animated typing effect.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'hygge'),
					"param_name" => "title",
					'holder' => 'h4'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'hygge'),
					"param_name" => "subtitle",
					'holder' => 'p'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Layout", 'hygge'),
					"param_name" => "layout",
					"value" => array(
						'Small' => 'small',
						'Large' => 'large'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_shortcode_vc' );