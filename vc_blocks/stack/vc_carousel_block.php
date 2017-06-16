<?php 

/**
 * The Shortcode
 */
function ebor_carousel_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'timing' => '7000',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$image = explode(',', $image);
	
	$output = '<div class="'. esc_attr($custom_css_class) .' slider slider--inline-arrows slider--arrows-hover text-center" data-arrows="true" data-timing="'. $timing .'"><ul class="slides">';
	
	foreach ($image as $id){
		$output .= '
			<li class="col-sm-3 col-xs-6">
				'. wp_get_attachment_image($id, 'full', 0, array('class' => 'image--xxs') ) .'
			</li>
		';
	}
	
	$output .= '</ul></div>';
		
	return $output;
}
add_shortcode( 'stack_carousel', 'ebor_carousel_shortcode' );

/**
 * The VC Functions
 */
function ebor_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Image Carousel", 'stackwordpresstheme'),
			"base" => "stack_carousel",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__("Carousel Images", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Carousel Timing (ms)", 'stackwordpresstheme'),
					"param_name" => "timing",
					'value' => '7000',
					"description" => 'Carousel Timing in Milliseconds',
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
add_action( 'vc_before_init', 'ebor_carousel_shortcode_vc' );