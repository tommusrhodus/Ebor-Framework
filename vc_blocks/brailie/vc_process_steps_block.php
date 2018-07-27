<?php 

/**
 * The Shortcode
 */
function ebor_process_steps_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'number' => '01',
				'align' => 'center',
				'custom_css_class' => ''
			), $atts 
		) 
	);
		
	$output = '
		<div class="text-'. $align .' '. esc_attr( $custom_css_class ) .'">
			<span class="icon icon-bg bg-default mb-20"><span class="number">'. $number .'</span></span>'. do_shortcode( $content ) .'</div>
	';
	
	return $output;
}
add_shortcode( 'brailie_process_steps_block', 'ebor_process_steps_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_process_steps_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Process Steps", 'brailie'),
			"base" => "brailie_process_steps_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Service icon block with selectable layouts',
			"params" => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Alignment", 'brailie'),
					"param_name" => "align",
					"value"      => array(
						'Center' => 'center',
						'Left' => 'left',
						'Right' => 'right'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Process Number", 'stackwordpresstheme'),
					"param_name" => "number",
					'value' => '01'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'brailie'),
					"param_name" => "content",
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
add_action( 'vc_before_init', 'ebor_process_steps_block_shortcode_vc' );