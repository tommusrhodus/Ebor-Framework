<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts, $content = null ) {
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
add_shortcode( 'padre_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'padre-vc-block',
			"name" => esc_html__("Testimonial", 'padre'),
			"base" => "padre_testimonial",
			"category" => esc_html__('padre WP Theme', 'padre'),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => esc_html__("Testimonial", 'padre'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Author", 'padre'),
					"param_name" => "subtitle",
					'holder' => 'div',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc' );