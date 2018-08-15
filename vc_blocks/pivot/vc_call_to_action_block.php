<?php 

/**
 * The Shortcode
 */
function ebor_call_to_action_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => '',
				'lead' => '',
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="row clearfix">
		<div class="col-sm-6 col-xs-12 pull-left">
			<h3 class="text-white">'.  wp_specialchars_decode($lead, ENT_QUOTES) .'</h3>
		</div>
		
		<div class="col-sm-4 col-xs-12 pull-right text-right">
			<a href="'. esc_url($text) .'" class="btn btn-primary btn-white">'.  wp_specialchars_decode($title, ENT_QUOTES) .'</a>
		</div>
	</div>';
	
	return $output;
}
add_shortcode( 'pivot_call_to_action', 'ebor_call_to_action_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Call To Action", 'pivot'),
			"base" => "pivot_call_to_action",
			"category" => __('Pivot - Misc', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'pivot'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'pivot'),
					"param_name" => "text",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Lead Text", 'pivot'),
					"param_name" => "lead",
					"value" => '',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_shortcode_vc' );