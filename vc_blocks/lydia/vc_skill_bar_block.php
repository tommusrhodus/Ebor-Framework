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
	
	$output = '
		<ul class="progress-list">
			<li>
				<p>'. $title .' <em>'. (int)$amount .'%</em></p>
				<div class="progress plain">
					<div class="bar" data-width="'. (int)esc_attr($amount) .'"></div>
				</div>
			</li>
		</ul>
	';
	
	return $output;
}
add_shortcode( 'lydia_skill_bar_block', 'ebor_skill_bar_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_skill_bar_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Skill Bar", 'lydia'),
			"base" => "lydia_skill_bar_block",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Coloured bars for demonstrating your skills.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Skill Title", 'lydia'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Skill Amount", 'lydia'),
					"param_name" => "amount",
					'description' => 'Use a value between 0 - 100 only.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_skill_bar_block_shortcode_vc' );