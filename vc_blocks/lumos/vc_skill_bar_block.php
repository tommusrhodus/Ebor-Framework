<?php 

/**
 * The Shortcode
 */
function ebor_skill_bar_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'amount' => ''
			), $atts 
		) 
	);
	
	$output = '<ul class="progress-list">
					<li>
						<p>'. $title .' <em>'. (int)$amount .'%</em></p>
						<div class="progress plain">
							<div class="bar" style="width: '. (int)esc_attr($amount) .'%;"></div>
						</div>
					</li>
				</ul>';
	return $output;
}
add_shortcode( 'lumos_skill_bar_block', 'ebor_skill_bar_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_skill_bar_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Skill Bar", 'lumos'),
			"base" => "lumos_skill_bar_block",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'Coloured bars for demonstrating your skills.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Skill Title", 'lumos'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => __("Skill Amount", 'lumos'),
					"param_name" => "amount",
					'description' => 'Use a value between 0 - 100 only.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_skill_bar_block_shortcode_vc' );