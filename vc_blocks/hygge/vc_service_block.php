<?php 

/**
 * The Shortcode
 */
function ebor_service_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="service text-center">
			<div class="icon"> 
				'. wp_get_attachment_image($image, 'full') .'
			</div>
			'. do_shortcode(htmlspecialchars_decode($content)) .'
		</div>
	';
	
	return $output;
}
add_shortcode( 'hygge_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Service Box", 'hygge'),
			"base" => "hygge_service",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Add a pricing table to the page.',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'hygge'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Service Icon Image", 'hygge'),
					"param_name" => "image"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc' );