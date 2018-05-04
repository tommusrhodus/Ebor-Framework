<?php 

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
			), $atts 
		) 
	);
	
	$image = explode(',', $image);
	$rand = wp_rand(0, 10000);
	
	$output = '
		<div class="flexslider slideshow">
			<ul class="slides">
	';
	
	foreach ($image as $id){
		$output .= '
			<li>
				'. wp_get_attachment_image($id, 'full') .'
			</li>
		';
	}	
	
	$output .= '
			</ul>
		</div>
	';
		
	return $output;
}
add_shortcode( 'belton_slider', 'ebor_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'belton-vc-block',
			"name" => esc_html__("Image Slider", 'belton'),
			"base" => "belton_slider",
			"category" => esc_html__('Belton WP Theme', 'belton'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__("slider Images", 'belton'),
					"param_name" => "image"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );