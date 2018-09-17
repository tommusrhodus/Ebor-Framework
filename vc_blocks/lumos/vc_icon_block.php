<?php 

/**
 * The Shortcode
 */
function ebor_icon_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'layout' => 'side'
			), $atts 
		) 
	);
	
	$output = false;
	
	if( 'side' == $layout ){
		$output .= '<div class="services-1">
			<div class="icon"> <i class="'. esc_attr($icon) .' icn"></i> </div>
			<div class="text">'.  wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
		</div>';
	} elseif( 'top-large' == $layout ){
		$output .= '<div class="text-center services-3 facts"><div class="col-wrapper"> <i class="'. esc_attr($icon) .'"></i>'.  wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div></div>';
	} else {
		$output .= '<div class="text-center services-2"><i class="'. esc_attr($icon) .'"></i>'.  wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	}
	
	return $output;
}
add_shortcode( 'lumos_icon_block', 'ebor_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
			"name" => __("Icon & Text", 'lumos'),
			"base" => "lumos_icon_block",
			"category" => __('lumos WP Theme', 'lumos'),
			'description' => 'Add an icon with explanatory text.',
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Pricing Table Icon", 'lumos'),
					"param_name" => "icon",
					"value" => array_keys(ebor_get_icons()),
					'description' => 'view all icons here: http://ionicons.com'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'lumos'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Block Layout", 'lumos'),
					"param_name" => "layout",
					"value" => array(
						'Icon on Side' => 'side',
						'Icon on Top' => 'top',
						'Icon on Top (Large)' => 'top-large'
					),
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_block_shortcode_vc' );