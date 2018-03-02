<?php 

/**
 * The Shortcode
 */
function ebor_process_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '01.',
				'custom_css_class' => ''
			), $atts 
		) 
	);

	$output = '	
		<div class="process-item animated-from-left '. $custom_css_class .'">
			<span class="process-step">'. $title .'</span>
			'. $content .'
		</div>
	';
	
	return $output;
}
add_shortcode( 'gaze_process_block', 'ebor_process_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_process_block_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Process Block", 'gaze' ),
			"base"        => "gaze_process_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Large numbered process blocks.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Process Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div',
					'value'      => '01.'
				),
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__("Block Content", 'gaze'),
					"param_name" => "content"
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_block_shortcode_vc' );