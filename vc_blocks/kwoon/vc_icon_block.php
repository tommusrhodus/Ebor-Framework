<?php 

/**
 * The Shortcode
 */
function ebor_icon_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'icon' => '',
				'delay' => '0',
				'color' => '#67b7d4'
			), $atts 
		) 
	);
	
	$output = '
		<div class="tm30 wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
			<div class="box-color text-center" style="background-color: '. $color .';">
				<div class="icon-large"> 
					<i class="'. esc_attr($icon) .'"></i> 
				</div>
				'. wpautop(htmlspecialchars_decode($content)) .'
			</div>
		</div>
	';
	return $output;
}
add_shortcode( 'kwoon_icon_block', 'ebor_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Icon Box", 'kwoon'),
			"base" => "kwoon_icon_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Counter elements for icons.',
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Icon", 'lumos'),
					"param_name" => "icon",
					"value" => array_keys(ebor_get_icons()),
					'description' => 'view all icons here: http://ionicons.com'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Title & Description", 'kwoon'),
					"param_name" => "content",
					'holder' => 'div'
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
				array(
					"type" => "colorpicker",
					"heading" => __("Background Colour", 'kwoon'),
					"param_name" => "color",
					'value' => '#67b7d4'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_block_shortcode_vc' );