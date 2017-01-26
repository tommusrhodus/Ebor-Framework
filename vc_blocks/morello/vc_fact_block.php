<?php 

/**
 * The Shortcode
 */
function ebor_fact_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'icon' => '',
				'delay' => '0',
				'counter' => '7518',
				'description' => 'Shots Taken'
			), $atts 
		) 
	);
	
	$output = '
		<div class="text-center facts">
			<div class="text-center wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
				<div class="icon icon-m bm15"> 
					<i class="'. esc_attr($icon) .'"></i>
				</div>
				<span class="counter">'. wp_kses_post($counter) .'</span>
				<p>'. wp_kses_post($description) .'</p>
			</div>
		</div>
	';
	return $output;
}
add_shortcode( 'morello_fact_block', 'ebor_fact_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_fact_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Fact Counter", 'morello'),
			"base" => "morello_fact_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'morello'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Counter Text", 'morello'),
					"param_name" => "counter",
					'value' => '7518'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description Text", 'morello'),
					"param_name" => "description",
					'value' => 'Shots Taken',
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
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_fact_block_shortcode_vc' );