<?php 

/**
 * The Shortcode
 */
function ebor_animated_text_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro' => '',
				'text' => '',
				'size' => 'small',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'small' == $size ){
	
		$output = '
			<p class="lead '. $custom_css_class .'">'. $intro .' 
				<span class="typer" id="typer" data-delay="100" data-delim="," data-words="'. $text .'"></span>
				<span class="cursor" data-owner="typer"></span> 
			</p>
		';
	
	} elseif( 'medium' == $size ) {
	
		$output = '
			<p class="lead larger '. $custom_css_class .'">'. $intro .' 
				<span class="typer" id="typer" data-delay="100" data-delim="," data-words="'. $text .'"></span>
				<span class="cursor" data-owner="typer"></span> 
			</p>
		';
	
	} else {
	
		$output = '
			<h2 class="sub-heading '. $custom_css_class .'">'. $intro .' 
				<span class="typer" id="typer" data-delay="100" data-delim="," data-words="'. $text .'"></span>
				<span class="cursor" data-owner="typer"></span> 
			</h2>
		';
	
	}

	return $output;
}
add_shortcode( 'brailie_animated_text', 'ebor_animated_text_shortcode' );

/**
 * The VC Functions
 */
function ebor_animated_text_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Animated Text", 'brailie'),
			"base" => "brailie_animated_text",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'brailie'),
					"param_name" => "size",
					"value" => array(
						'Small' => 'small',
						'Medium' => 'medium',
						'Large' => 'large'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Intro Text", 'brailie'),
					"param_name" => "intro",
					"description" => 'Static text to show before the animated text.',
					'holder' => 'div'
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Text to animate", 'brailie'),
					"param_name" => "text",
					"description" => '1 animation per line, multiple words per line are fine, add a new line for each new animation you wish to create.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_animated_text_shortcode_vc' );