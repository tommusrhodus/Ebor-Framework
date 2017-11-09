<?php 

/**
 * The Shortcode
 */
function ebor_menu_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'bg-white'
			), $atts 
		) 
	);
	
	$output = '
		<div class="feature bordered '. esc_attr($layout) .' restaurant-menu">
		    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		</div>
	';

	return $output;
}
add_shortcode( 'foundry_menu', 'ebor_menu_shortcode' );

/**
 * The VC Functions
 */
function ebor_menu_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Restaurant Menu", 'foundry'),
			"base" => "foundry_menu",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Menu Background Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'White' => 'bg-white',
						'Dark' => 'bg-secondary',
						'Highlight Colour' => 'bg-primary'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_menu_shortcode_vc' );