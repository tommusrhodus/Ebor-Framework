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
				'image' => '',
				'layout' => 'top'
			), $atts 
		) 
	);

	if (!empty($image)) {
		$feature_icon = wp_get_attachment_image($image, 'admin-list-thumb');		
	} else {
		$feature_icon = '<i class="'. $icon .'"></i>';
	}
	 
	
	if( 'left' == $layout ){
		
		$output = '
			<div class="wow fadeIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
				<div class="feature">
					<div class="icon icon-m"> 
						'. $feature_icon .'
					</div>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		';
	
	} elseif( 'right' == $layout ){
		
		$output = '
			<div class="wow fadeIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
				<div class="feature text-right">
					<div class="icon icon-m"> 
						'. $feature_icon .'
					</div>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		';
	
	} else {
	
		$output = '
			<div class="text-center wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
				<div class="icon icon-m bm10"> 
					'. $feature_icon .'
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'ryla_icon_block', 'ebor_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ryla_get_icons') ){
		$icons = array_values(ryla_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => esc_html__("Icon & Text", 'ryla'),
			"base" => "ryla_icon_block",
			"category" => esc_html__('ryla WP Theme', 'ryla'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Icon Image", 'ryla'),					
					"description" => esc_html__("Uploading An Icon Image Will Override The Icon Below (if chosen)", 'morello'),
					"param_name" => "image"
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'morello'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'ryla'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Animation Duration (seconds)(numbers only)", 'ryla'),
					"param_name" => "duration",
					'value' => '1'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Animation Delay (seconds)(numbers only)", 'ryla'),
					"param_name" => "delay",
					'value' => '0.3'
				),
				array(
					'type' => 'dropdown',
					"heading" => esc_html__("Layout", 'ryla'),
					'param_name' => 'layout',
					'value' => array(
						'Top Icon' => 'top',
						'Left Icon' => 'left',
						'Right Icon' => 'right'
					)
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_block_shortcode_vc' );