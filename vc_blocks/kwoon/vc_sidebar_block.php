<?php 

/**
 * The Shortcode
 */
function ebor_sidebar_shortcode( $atts, $content = null ) {
	ob_start();
	echo '<aside class="hide-boxes sidebar">';
	dynamic_sidebar('primary');
	echo '</aside>';
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'kwoon_sidebar', 'ebor_sidebar_shortcode' );

/**
 * The VC Functions
 */
function ebor_sidebar_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Sidebar", 'kwoon'),
			"base" => "kwoon_sidebar",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'kwoon'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_sidebar_shortcode_vc' );