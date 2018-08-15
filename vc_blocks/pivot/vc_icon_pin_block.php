<?php 

/**
 * The Shortcode
 */
function ebor_icon_pin_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'sub' => '',
				'small' => '',
				'icon' => '',
				'link' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="text-center milestones"><div class="feature feature-icon-large">';
			
		if( $icon && !( 'none' == $icon ) ){
			if($link){
				$output .= '<a href="'. esc_url($link) .'"><i class="vc-icon '. $icon .'"></i></a><div class="pin-body"></div><div class="pin-head"></div>';
			} else {
				$output .= '<i class="vc-icon '. $icon .'"></i><div class="pin-body"></div><div class="pin-head"></div>';
			}
		}
			
		if( $title )
			$output .= '<h5>'. wp_specialchars_decode($title, ENT_QUOTES) .'</h5>';
			
		if( $sub )
			$output .= '<span>'. wp_specialchars_decode($sub, ENT_QUOTES) .'</span>';
			
		if( $small )
			$output .= '<span class="sub">'. wp_specialchars_decode($small, ENT_QUOTES) .'</span>';
			
	$output .= '</div></div>';
	
	return $output;
}
add_shortcode( 'pivot_icon_pin', 'ebor_icon_pin_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_pin_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Icon Pin", 'pivot'),
			"base" => "pivot_icon_pin",
			"category" => __('Pivot - Text', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'pivot'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'pivot'),
					"param_name" => "sub",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Small Text", 'pivot'),
					"param_name" => "small",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Link icon? Enter Url here. (Optional)", 'pivot'),
					"param_name" => "link",
					"value" => '',
				),
				array(
					"type" => "ebor_icons",
					"heading" => __("Click an Icon to choose", 'pivot'),
					"param_name" => "icon",
					"value" => array_values(ebor_get_icons()),
					'holder' => 'div',
					'description' => 'Type "none" or leave blank to hide icons.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_pin_shortcode_vc' );