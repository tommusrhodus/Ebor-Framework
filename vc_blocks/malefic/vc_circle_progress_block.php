<?php 

/**
 * The Shortcode
 */
function ebor_circle_progress_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'amount' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="circle-progress-wrapper">
			<div class="circle-progress">
				<div class="circle" data-value="'. $amount .'"> <i class="fa '. $icon .'"></i></div>
				<h4 class="upper">'. $title .'</h4>
				'. htmlspecialchars_decode($content) .'
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'malefic_circle_progress', 'ebor_circle_progress_shortcode' );

/**
 * The VC Functions
 */
function ebor_circle_progress_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Progress Circle", 'malefic'),
			"base" => "malefic_circle_progress",
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
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'malefic'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'malefic'),
					"param_name" => "content"
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_circle_progress_shortcode_vc' );