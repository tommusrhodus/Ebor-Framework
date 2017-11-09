<?php 

/**
 * The Shortcode
 */
function ebor_embed_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="embed-holder">'. wp_oembed_get($title) .'</div>';
	
	return $output;
}
add_shortcode( 'foundry_embed', 'ebor_embed_shortcode' );

/**
 * The VC Functions
 */
function ebor_embed_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Simple oEmbed", 'foundry'),
			"base" => "foundry_embed",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("oEmbed URL", 'foundry'),
					"param_name" => "title",
					'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_embed_shortcode_vc' );