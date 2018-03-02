<?php 

/**
 * The Shortcode
 */
function ebor_toggle_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="'. $custom_css_class .' toggle">
		
			<div class="acc-panel">
				<a href="#">'. $title .'</a>
			</div>
			
			<div class="panel-content">'. do_shortcode( $content ) .'</div>
		
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_toggle_block', 'ebor_toggle_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_toggle_block_shortcode_vc() {

	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Toggle", 'gaze' ),
			"base"        => "gaze_toggle_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'toggle elements for toggles.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__( "Block Content", 'gaze' ),
					"param_name" => "content",
					'holder'     => 'div'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_toggle_block_shortcode_vc' );