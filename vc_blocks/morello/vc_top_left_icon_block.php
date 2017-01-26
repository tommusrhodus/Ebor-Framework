<?php 

/**
 * The Shortcode
 */
function ebor_top_left_icon_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'icon' => '',
				'delay' => '0',
				'layout' => 'on-top'
			), $atts 
		) 
	);
	
	if( 'behind' == $layout ){
		
		$output = '
			<div class="process">
				<div class="content wow fadeIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
					<span class="icon">
						<i class="'. esc_attr($icon) .'"></i>
					</span>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		';
	
	} else {
	
		$output = '
			<div class="services">
				<div class="service wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
					<span class="icon icon-s">
						<i class="'. esc_attr($icon) .'"></i>
					</span>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'morello_top_left_icon_block', 'ebor_top_left_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_top_left_icon_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Top Left Icon &amp; Text", 'morello'),
			"base" => "morello_top_left_icon_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'morello'),
					"param_name" => "icon",
					"value" => $icons
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
				),
				array(
					'type' => 'dropdown',
					"heading" => esc_html__("Layout", 'morello'),
					'param_name' => 'layout',
					'value' => array(
						'Icon above title' => 'on-top',
						'Icon behind title' => 'behind'
					)
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_top_left_icon_block_shortcode_vc' );