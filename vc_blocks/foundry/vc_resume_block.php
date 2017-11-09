<?php 

/**
 * The Shortcode
 */
function ebor_resume_item_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'date' => '',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div>
		    <span class="pull-right fade-1-4">'. $date .'</span>
		    <h6 class="uppercase mb0">'. $title .'</h6>
		    <span class="fade-half inline-block mb24">'. $subtitle.'</span>
		    <hr class="fade-3-4">
		</div>
	';
	
	return $output;
}
add_shortcode( 'foundry_resume_item', 'ebor_resume_item_shortcode' );

/**
 * The VC Functions
 */
function ebor_resume_item_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Resume Item", 'foundry'),
			"base" => "foundry_resume_item",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'foundry'),
					"param_name" => "subtitle",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => __("Date", 'foundry'),
					"param_name" => "date",
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_resume_item_shortcode_vc' );