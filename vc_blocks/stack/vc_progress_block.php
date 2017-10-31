<?php 

/**
 * The Shortcode
 */
function ebor_progress_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'full' => '90',
				'label' => 'Progress: 90%',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="progress-horizontal '. $custom_css_class .'">
		    <div class="progress-horizontal__bar" data-value="'. $full .'"></div>
		    <span class="progress-horizontal__label h5">'. $label .'</span>
		</div>
	';
	
	return $output;
}
add_shortcode( 'stack_progress', 'ebor_progress_shortcode' );

/**
 * The VC Functions
 */
function ebor_progress_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Progress Bars", 'stackwordpresstheme'),
			"base" => "stack_progress",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("How 'full' should this progress be?", 'stackwordpresstheme'),
					"param_name" => "full",
					'value' => '90',
					"description" => 'enter 0 to 100 (numeric only) for how full to show this progress.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Label text", 'stackwordpresstheme'),
					"param_name" => "label",
					'value' => '90%',
					"description" => 'Label text to show inside the progress',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_progress_shortcode_vc' );