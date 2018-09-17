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
				'delay' => '0'
			), $atts 
		) 
	);
	
	$output = '
		<div class="text-center facts">
		
			<div class="icon-large wow zoomIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s"> 
				<i class="'. esc_attr($icon) .'"></i> 
			</div>
			
			'. htmlspecialchars_decode($content) .'
		
		</div>
	';
	return $output;
}
add_shortcode( 'kwoon_fact_block', 'ebor_fact_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_fact_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Fact Counter", 'kwoon'),
			"base" => "kwoon_fact_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'Counter elements for facts.',
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
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_fact_block_shortcode_vc' );