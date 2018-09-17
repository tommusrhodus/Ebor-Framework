<?php 

/**
 * The Shortcode
 */
function ebor_quote_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
			), $atts 
		) 
	);
	
	$output = '
		<div class="centered">
			<div class="icon-holder quote"></div>
			<blockquote>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				<p class="small">'. $title .'</p>
			</blockquote>
		</div>
	';
	
	return $output;
}
add_shortcode( 'huntington_quote', 'ebor_quote_shortcode' );

/**
 * The VC Functions
 */
function ebor_quote_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'huntington-vc-block',
			"name" => esc_html__("Fancy Quote", 'huntington'),
			"base" => "huntington_quote",
			"category" => esc_html__('Huntington WP Theme', 'huntington'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'huntington'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Quote Author", 'huntington'),
					"param_name" => "title",
					"value" => ''
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_quote_shortcode_vc' );