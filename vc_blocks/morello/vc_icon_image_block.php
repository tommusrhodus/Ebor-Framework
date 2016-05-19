<?php 

/**
 * The Shortcode
 */
function ebor_icon_image_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'icon' => '',
				'delay' => '0',
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="lp30 rp30 text-center wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
			<div class="icon icon-m bm20">
				'. wp_get_attachment_image($image, 'full') .'
			</div>
			'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		</div><!--/column -->
	';
	
	return $output;
	
}
add_shortcode( 'morello_icon_image_block', 'ebor_icon_image_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_image_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Image Icon & Text", 'morello'),
			"base" => "morello_icon_image_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Icon Image", 'morello'),
					"param_name" => "image"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'morello'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Animation Duration (seconds)(numbers only)", 'morello'),
					"param_name" => "duration",
					'value' => '1'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Animation Delay (seconds)(numbers only)", 'morello'),
					"param_name" => "delay",
					'value' => '0.3'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_image_block_shortcode_vc' );