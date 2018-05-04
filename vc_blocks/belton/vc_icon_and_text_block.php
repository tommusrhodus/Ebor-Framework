<?php 

/**
 * The Shortcode
 */
function ebor_icon_and_text_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'image' => '',
				'color' => ''
			), $atts 
		) 
	);	
	
	$colour_output = ( $color ) ? 'style="color: '. $color .';"' : '';
	
	$output = '
		<div class="extra-padding-right hide-overflow">
			<div class="icons alignleft">';
			if($image) {
				$output .= ''. wp_get_attachment_image($image, 'full') .'';
			} else {
				$output .= '<i class="fa '. esc_attr($icon) .'" '. $colour_output .'></i>';
			}			
			$output .= '
			</div>
			<div class="next-to-icon">
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div>
	';	
	
	return $output;
}
add_shortcode( 'belton_icon_and_text_block', 'ebor_icon_and_text_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_and_text_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'belton-vc-block',
			"name" => esc_html__("Icon and Text", 'belton'),
			"base" => "belton_icon_and_text_block",
			"category" => esc_html__('belton WP Theme', 'belton'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'belton'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image", 'belton'),
					"param_name" => "image"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Icon Colour", 'belton'),
					"param_name" => "color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'belton'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_and_text_block_shortcode_vc' );