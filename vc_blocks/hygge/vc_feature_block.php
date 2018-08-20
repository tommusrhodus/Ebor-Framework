<?php 

/**
 * The Shortcode
 */
function ebor_icon_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'icon' => '',
				'color' => '#67b7d4',
				'layout' => 'image'
			), $atts 
		) 
	);
	
	if( 'image' == $layout ){
		$output = '
			<div class="feature">
				<div class="icon"> 
					'. wp_get_attachment_image($image, 'full') .'
				</div>
				'. wpautop(htmlspecialchars_decode($content)) .'
			</div>
		';
	} elseif( 'icon' == $layout ) {
		$output = '
			<div class="feature">
				<div class="icon lm10" style="color: '. $color .';"> 
					<i class="'. esc_attr($icon) .'"></i> 
				</div>
				'. wpautop(htmlspecialchars_decode($content)) .'
			</div>
		';
	} else {
		$output = '
			<div class="feature">
				<div class="icon round" style="background-color: '. $color .';"> 
					<i class="'. esc_attr($icon) .'"></i> 
				</div>
				'. wpautop(htmlspecialchars_decode($content)) .'
			</div>
		';
	}

	return $output;
}
add_shortcode( 'hygge_icon_block', 'ebor_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Icon Box", 'hygge'),
			"base" => "hygge_icon_block",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Counter elements for icons.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Icon Image", 'hygge'),
					"param_name" => "image"
				),
				array(
					"type" => "ebor_icons",
					"heading" => __("Icon", 'hygge'),
					"param_name" => "icon",
					"value" => array_keys(ebor_get_icons()),
					'description' => 'view all icons here: http://ionicons.com'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'hygge'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Icon Colour", 'hygge'),
					"param_name" => "color",
					'value' => '#67b7d4'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Layout", 'hygge'),
					"param_name" => "layout",
					"value" => array(
						'Image Icon' => 'image',
						'Standard Icon' => 'icon',
						'Circled Icon' => 'circle'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_block_shortcode_vc' );