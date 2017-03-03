<?php 

/**
 * The Shortcode
 */
function ebor_radial_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'full' => '90',
				'timing' => '1000',
				'colour' => '#4a90e2',
				'size' => '200',
				'width' => '10',
				'label' => '90%',
				'icon' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$label = ( $icon ) ? '<i class="icon--lg '. $icon .' color--primary radial__label"></i>' : '<span class="h3 radial__label">' . $label . '</span>';
	
	$output = '
		<div 
			class="radial '. $custom_css_class .'" 
			data-value="'. $full .'" 
			data-timing="'. $timing .'" 
			data-color="'. $colour .'" 
			data-size="'. $size .'" 
			data-bar-width="'. $width .'"
		>'. $label .'</div>
	';
	
	return $output;
}
add_shortcode( 'stack_radial', 'ebor_radial_shortcode' );

/**
 * The VC Functions
 */
function ebor_radial_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Process Radials", 'stackwordpresstheme'),
			"base" => "stack_radial",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("What color will this radial be?", 'stackwordpresstheme'),
					"param_name" => "colour",
					'value' => '#4a90e2',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("How 'full' should this radial be?", 'stackwordpresstheme'),
					"param_name" => "full",
					'value' => '90',
					"description" => 'enter 0 to 100 (numeric only) for how full to show this radial.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("How long should this take to animate?", 'stackwordpresstheme'),
					"param_name" => "timing",
					'value' => '1000',
					"description" => 'default 1000 (1 second) increase if needed, value in milliseconds (numeric only)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("How large should this be?", 'stackwordpresstheme'),
					"param_name" => "size",
					'value' => '200',
					"description" => 'Size in pixels, 200 default (numeric only)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("How wide should the radial bar be?", 'stackwordpresstheme'),
					"param_name" => "width",
					'value' => '10',
					"description" => 'Size in pixels, 10 default (numeric only)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Label text", 'stackwordpresstheme'),
					"param_name" => "label",
					'value' => '90%',
					"description" => 'Label text to show inside the radial',
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Click an Icon to choose (replaces label)", 'stackwordpresstheme'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
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
add_action( 'vc_before_init', 'ebor_radial_shortcode_vc' );