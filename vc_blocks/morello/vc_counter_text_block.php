<?php 

/**
 * The Shortcode
 */
function ebor_counter_text_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'counter' => '01',
				'delay' => '0'
			), $atts 
		) 
	);
	
	$output = '
		<div class="process numbered">
			<div class="content wow fadeIn" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s"> 
				<span class="number" data-content="'. esc_html($counter) .'"></span>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'morello_counter_text_block', 'ebor_counter_text_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_counter_text_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Counter & Text", 'morello'),
			"base" => "morello_counter_text_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Text Behind Title", 'morello'),
					"param_name" => "counter",
					'value' => '01'
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
add_action( 'vc_before_init', 'ebor_counter_text_block_shortcode_vc' );