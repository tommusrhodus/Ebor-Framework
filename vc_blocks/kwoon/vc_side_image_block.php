<?php 

/**
 * The Shortcode
 */
function ebor_side_image_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'icon' => '',
				'delay' => '0',
				'image' => '',
				'image_retina' => '',
				'alt' => ''
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image_src($image, 'full');
	$image_retina = wp_get_attachment_image_src($image_retina, 'full');
	
	if(!( isset($image[0]) ))
		$image[0] = false;
	
	if(!( isset($image_retina[0]) ))
		$image_retina[0] = false;
		
	$output = '
		<div class="feature flat-icon wow fadeIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
			<div class="icon"> 
				<img 
					src="'. esc_url($image[0]) .'" 
					data-src="'. esc_url($image[0]) .'" 
					data-ret="'. esc_url($image_retina[0]) .'" 
					class="retina" 
					alt="'. esc_attr($alt) .'" 
				/>
			</div>
			'. htmlspecialchars_decode($content) .'
		</div>
	';
	return $output;
}
add_shortcode( 'kwoon_side_image_block', 'ebor_side_image_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_side_image_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Side Image & Text", 'kwoon'),
			"base" => "kwoon_side_image_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'An image icon on left and text on right.',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Title & Description", 'kwoon'),
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
add_action( 'vc_before_init', 'ebor_side_image_block_shortcode_vc' );