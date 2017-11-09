<?php 

/**
 * The Shortcode
 */
function ebor_skill_bar_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'amount' => '',
				'layout' => 'inside',
				'align' => 'text-center'
			), $atts 
		) 
	);
	
	if( 'inside' == $layout ){
		$output = '
			<div class="progress-bars '. esc_attr($align) .'">
			    <div class="progress progress-1">
			        <div class="progress-bar" data-progress="'. (int) esc_attr($amount) .'">
			            <span class="title">'. $title .'</span>
			        </div>
			    </div>
			</div>
		';
	} else {
		$output = '
			<div class="progress-bars '. esc_attr($align) .'">
			    <div class="progress progress-2">
			        <span class="title">'. $title .'</span>
			        <div class="bar-holder">
			            <div class="progress-bar" data-progress="'. (int) esc_attr($amount) .'"></div>
			        </div>
			    </div>
			</div>
		';
	}

	return $output;
}
add_shortcode( 'foundry_skill_bar_block', 'ebor_skill_bar_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_skill_bar_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Skill Bar", 'foundry'),
			"base" => "foundry_skill_bar_block",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'Coloured bars for demonstrating your skills.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Skill Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Skill Amount", 'foundry'),
					"param_name" => "amount",
					'description' => 'Use a value between 0 - 100 only.'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Skill Bar Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Title Inside Bar' => 'inside',
						'Title Outside Bar' => 'outside'
					)
				),
				array(
					"type" => "dropdown",
					"heading" => __("Text Alignment", 'foundry'),
					"param_name" => "align",
					"value" => array(
						'Center' => 'text-center',
						'Left' => 'text-left'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_skill_bar_block_shortcode_vc' );