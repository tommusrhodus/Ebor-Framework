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
				'description' => 'Shots Taken',
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="text-center facts">
			<div class="text-center wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
				<div class="icon icon-m bm15"> 
					'. wp_get_attachment_image($image, 'admin-list-thumb') .'
				</div>
				<span class="counter">'. wp_kses_post($counter) .'</span>
				<p>'. wp_kses_post($description) .'</p>
			</div>
		</div>
	';
	return $output;
}
add_shortcode( 'ryla_fact_block', 'ebor_fact_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_fact_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => esc_html__("Fact Counter", 'ryla'),
			"base" => "ryla_fact_block",
			"category" => esc_html__('ryla WP Theme', 'ryla'),
			'description' => 'Counter elements for facts.',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Fact Icon Image", 'ryla'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Counter Text", 'ryla'),
					"param_name" => "counter",
					'value' => '7518'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description Text", 'ryla'),
					"param_name" => "description",
					'value' => 'Shots Taken'
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
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_fact_block_shortcode_vc' );