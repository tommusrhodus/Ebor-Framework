<?php 

/**
 * The Shortcode
 */
function ebor_lightbox_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro' => 'true',
				'image' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$src = wp_get_attachment_image_src( $image, 'full' );
	
	$output = '<a class="'. esc_attr($custom_css_class) .'" href="'. $src[0] .'" data-lightbox="'. $intro .'">'. wp_get_attachment_image( $image, 'large' ) .'</a>';

	return $output;
}
add_shortcode( 'stack_lightbox_image', 'ebor_lightbox_image_shortcode' );

/**
 * The VC Functions
 */
function ebor_lightbox_image_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Lightbox Image", 'stackwordpresstheme'),
			"base" => "stack_lightbox_image",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Gallery Name", 'stackwordpresstheme'),
					"param_name" => "intro",
					"description" => 'Specify a gallery name for this image to belong to (optional)',
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
add_action( 'vc_before_init', 'ebor_lightbox_image_shortcode_vc' );