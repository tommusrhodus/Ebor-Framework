<?php 

/**
 * The Shortcode
 */
function ebor_typed_text_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro' => '',
				'outro' => '',
				'text' => '',
				'custom_css_class' => '',
				'size' => 'h4'
			), $atts 
		) 
	);
	
	$output = '
		<div class="typed-headline '. esc_attr($custom_css_class) .'">
			<span class="'. $size .' inline-block">'. $intro .'</span>
			<span class="'. $size .' inline-block typed-text typed-text--cursor color--primary" data-typed-strings="'. $text .'"></span>
			<span class="'. $size .' inline-block">'. $outro .'</span>
		</div>
	';

	return $output;
}
add_shortcode( 'stack_typed_text', 'ebor_typed_text_shortcode' );

/**
 * The VC Functions
 */
function ebor_typed_text_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Typed Text", 'stackwordpresstheme'),
			"base" => "stack_typed_text",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Intro Text", 'stackwordpresstheme'),
					"param_name" => "intro",
					"description" => 'Static text to show before the animated text.',
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Text to animate", 'stackwordpresstheme'),
					"param_name" => "text",
					"description" => '1 animation per line, multiple words per line are fine, add a new line for each new animation you wish to create.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Outro Text", 'stackwordpresstheme'),
					"param_name" => "outro",
					"description" => 'Static text to show after the animated text.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Heading Size", 'stackwordpresstheme'),
					"param_name" => "size",
					"description" => 'Heading size, h1 (biggest) to h6 (smallest) e.g: h2',
					'value' => 'h4'
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
add_action( 'vc_before_init', 'ebor_typed_text_shortcode_vc' );