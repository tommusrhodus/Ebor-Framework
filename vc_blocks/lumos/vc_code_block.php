<?php 

/**
 * The Shortcode
 */
function ebor_code_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	$output = false;
	if($title)
		$output .= '<h3 class="section-title">'. htmlspecialchars_decode($title) .'</h3>';
	$output .= '<pre class="prettyprint linenums">'. htmlspecialchars($content) .'</pre>';
	return $output;
}
add_shortcode( 'lumos_code_block', 'ebor_code_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_code_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Highlighted Code", 'lumos'),
			"base" => "lumos_code_block",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'Add example code to a page.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'lumos'),
					"param_name" => "title"
				),
				array(
					"type" => "textarea",
					"heading" => __("Code Snippet", 'lumos'),
					"param_name" => "content"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_code_block_shortcode_vc' );