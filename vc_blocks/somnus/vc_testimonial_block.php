<?php 

/**
 * The Shortcode
 */
function somnus_testimonial_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="row mb64 mb-xs-24">
		    <div class="col-md-10 col-md-offset-1 text-center">
		        <p class="alt-font mb8">'. $title .'</p>
		        <span class="sub">'. htmlspecialchars_decode($subtitle) .'</span>
		    </div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'somnus_testimonial', 'somnus_testimonial_shortcode' );

/**
 * The VC Functions
 */
function somnus_testimonial_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Testimonial", 'somnus'),
			"base" => "somnus_testimonial",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => esc_html__("Testimonial", 'somnus'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Author", 'somnus'),
					"param_name" => "subtitle",
					'holder' => 'div',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'somnus_testimonial_shortcode_vc' );