<?php 

/**
 * The Shortcode
 */
function ebor_service_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'background' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$background_image = wp_get_attachment_image_src( $background, 'medium' );
	
	$output = '<article class="agency-service-block">';
	
	$output .= ( $background ) ? '<div class="service-inner-wrap" style="background-image: url('. esc_url($background_image[0]) .');">' : '<div class="service-inner-wrap">';
	
	if( $image )
		$output .= wp_get_attachment_image( $image, 'medium' );
	
	if( $title ) 
		$output .= '<h3 class="black font2">'. htmlspecialchars_decode($title) .'</h3>';
	
	$output .= wpautop(do_shortcode(htmlspecialchars_decode($content)));
	
	$output .= '</div></article>';
	
	return $output;
}
add_shortcode( 'expose_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Service", 'expose'),
			"base" => "expose_service",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'expose'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Service Icon Image", 'expose'),
					"param_name" => "image"
				),
				array(
					"type" => "attach_image",
					"heading" => __("Service Background Image", 'expose'),
					"param_name" => "background"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc' );