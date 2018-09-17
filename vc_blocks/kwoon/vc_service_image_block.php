<?php 

/**
 * The Shortcode
 */
function ebor_service_image_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'image_retina' => '',
				'alt' => '',
				'duration' => '1',
				'delay' => '0',
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image_src($image, 'full');
	$image_retina = wp_get_attachment_image_src($image_retina, 'full');
	
	
	if(!( isset($image[0]) ))
		$image[0] = false;
	
	if(!( isset($image_retina[0]) ))
		$image_retina[0] = false;
	
	$output = '<div class="text-center text-boxes"><div class="wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">';
	
	if(!( false == $image[0] )){
		$output .= '
			<div class="icon bm20"> 
				<img 
					src="'. esc_url($image[0]) .'" 
					data-src="'. esc_url($image[0]) .'" 
					data-ret="'. esc_url($image_retina[0]) .'" 
					class="retina" 
					alt="'. esc_attr($alt) .'" 
				/>
			</div>
		';
	}
				  
	$output .= do_shortcode(htmlspecialchars_decode($content));
	$output .= '</div></div>';
	return $output;
}
add_shortcode( 'kwoon_service_image_block', 'ebor_service_image_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_image_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Image Icon", 'kwoon'),
			"base" => "kwoon_service_image_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Add an icon with explanatory text.',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'kwoon'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "attach_image",
					"heading" => __("Service Icon Image", 'kwoon'),
					"param_name" => "image"
				),
				array(
					"type" => "attach_image",
					"heading" => __("Service Icon Retina Image (Double Size)", 'kwoon'),
					"param_name" => "image_retina"
				),
				array(
					"type" => "textfield",
					"heading" => __("Image Alt Text", 'kwoon'),
					"param_name" => "alt"
				),
				array(
					"type" => "textfield",
					"heading" => __("Animation Duration (seconds)(numbers only)", 'kwoon'),
					"param_name" => "duration",
					'value' => '1'
				),
				array(
					"type" => "textfield",
					"heading" => __("Animation Delay (seconds)(numbers only)", 'kwoon'),
					"param_name" => "delay",
					'value' => '0.3'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_image_block_shortcode_vc' );