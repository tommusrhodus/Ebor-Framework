<?php 

/**
 * The Shortcode
 */
function ebor_icon_text_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'retina_image' => ''
			), $atts 
		) 
	);
	
	$output = false;
	$image = wp_get_attachment_image_src( $image, 'full' );
	$ret_image = wp_get_attachment_image_src( $retina_image, 'full' );
	
	if($image[0]){
		if(!( $ret_image[0] ))
			$ret_image[0] = false;
			
		$output .= '<div class="icon-holder">
						<img src="'. esc_url($image[0]) .'" data-src="'. esc_url($image[0]) .'" data-ret="'. $ret_image[0] .'"  alt="'. esc_attr(get_the_title()) .'" class="retina" />
					</div>';
	}
		
	$output .= '<div class="next-to-icon">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>';
	
	return $output;
}
add_shortcode( 'huntington_icon_text', 'ebor_icon_text_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_text_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'huntington-vc-block',
			"name" => esc_html__("Text & Icon", 'huntington'),
			"base" => "huntington_icon_text",
			"category" => esc_html__('Huntington WP Theme', 'huntington'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'huntington'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image (48x48px)", 'huntington'),
					"param_name" => "image"
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image Retina (96x96px)", 'huntington'),
					"param_name" => "retina_image"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_text_shortcode_vc' );