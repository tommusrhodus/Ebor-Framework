<?php 

/**
 * The Shortcode
 */
function ebor_call_to_action_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'url' => '',
				'button_text' => '',
				'target' => '_blank'
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
		    <div class="col-sm-12 text-center">
		        <h3 class="mb0 inline-block p32 p0-xs">'. $title .'</h3>
		        <a class="btn btn-lg mb0 mt-xs-24" href="'. esc_url($url) .'" target="'. esc_attr($target) .'">'. $button_text.'</a>
		    </div>
		</div>
	';

	return $output;
}
add_shortcode( 'foundry_call_to_action_block', 'ebor_call_to_action_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Call To Action", 'foundry'),
			"base" => "foundry_call_to_action_block",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'Simple text and a button to grab attention',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'foundry'),
					"param_name" => "url"
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'foundry'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Target", 'foundry'),
					"param_name" => "target",
					'value' => '_blank',
					'description' => 'For details, see here: http://www.w3schools.com/tags/att_link_target.asp'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_block_shortcode_vc' );