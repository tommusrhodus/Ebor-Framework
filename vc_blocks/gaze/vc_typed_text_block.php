<?php 

/**
 * The Shortcode
 */
function ebor_typed_text_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'description'      => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$lines       = explode( ',', $description );
	$final_lines = '<p>'. implode( '</p><p>', $lines ) . '</p>';
	
	$output = '
		<div class="'. $custom_css_class .' intro style-3 text-center">
			<h1 class="intro-heading">'. $title .'
			
				<span id="typing-text">'. $final_lines .'</span>
				
				<div id="typed"></div>
				
			</h1>
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_typed_text_block', 'ebor_typed_text_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_typed_text_block_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Typed Text", 'gaze' ),
			"base"        => "gaze_typed_text_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'typed_text elements for typed_texts.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Title Text", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"       => "exploded_textarea",
					"heading"    => esc_html__( "Typed Text, One Per Line", 'gaze' ),
					"param_name" => "description"
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
add_action( 'vc_before_init', 'ebor_typed_text_block_shortcode_vc' );