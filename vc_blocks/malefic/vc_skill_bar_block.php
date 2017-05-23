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
				<p>'. $title .'</p>
				<div class="bar" data-value="'. (int)$amount .'"></div>
			</li>
		</ul>
	';
	
	return $output;
}
add_shortcode( 'malefic_skill_bar_block', 'ebor_skill_bar_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_skill_bar_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Skill Bar", 'malefic'),
			"base" => "malefic_skill_bar_block",
			"category" => esc_html__('malefic WP Theme', 'malefic'),
			'description' => 'Coloured bars for demonstrating your skills.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Skill Title", 'malefic'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Skill Amount", 'malefic'),
					"param_name" => "amount",
					'description' => 'Use a value between 0 - 100 only.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_skill_bar_block_shortcode_vc' );