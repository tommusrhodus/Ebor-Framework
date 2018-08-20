<?php 

/**
 * The Shortcode
 */
function ebor_code_block_shortcode( $atts, $content = null ) {
	$output = '<pre class="prettyprint linenums">'. htmlspecialchars($content) .'</pre>';
	return $output;
}
add_shortcode( 'hygge_code_block', 'ebor_code_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_code_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Highlighted Code", 'hygge'),
			"base" => "hygge_code_block",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Add example code to a page.',
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => __("Code Snippet", 'hygge'),
					"param_name" => "content"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_code_block_shortcode_vc' );