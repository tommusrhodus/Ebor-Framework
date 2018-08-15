<?php 

/**
 * The Shortcode
 */
function ebor_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'text_white' => 'No',
				'vertical' => 'No',
				'center' => 'Yes'
			), $atts 
		) 
	);
	
	$output = false;
	
	$white_text = ( $text_white == 'Yes' ) ? 'text-white': '';
	$center_text = ( $center == 'Yes' ) ? 'text-center' : ''; 
		
		if( 'Yes' == $vertical )
			$output .= '<div class="ebor-align-vertical no-align-mobile">';
		
			if( $subtitle )
				$output .= '<span class="'. $white_text .' alt-font '. $center_text .' ebor-block">'. wp_specialchars_decode($subtitle, ENT_QUOTES) .'</span>';
			
			if( $title )
				$output .= '<div class="'. $center_text .'"><h1 class="'. $white_text .'">'. wp_specialchars_decode($title, ENT_QUOTES) .'</h1></div>';
	
			if( $content )
				$output .= '<div class="lead '. $center_text .' '. $white_text .'">'. wpautop(do_shortcode(wp_specialchars_decode($content, ENT_QUOTES))) . '</div>';
			
		if( 'Yes' == $vertical )
			$output .= '</div>';
	
	return $output;
}
add_shortcode( 'pivot_section_title', 'ebor_section_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Section Title", 'pivot'),
			"base" => "pivot_section_title",
			"category" => __('Pivot - Text', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'pivot'),
					"param_name" => "title",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'pivot'),
					"param_name" => "subtitle",
					"value" => '',
					"description" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'pivot'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Use White Text?", 'pivot'),
					"param_name" => "text_white",
					"value" => array(
						'No',
						'Yes'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Center All Text?", 'pivot'),
					"param_name" => "center",
					"value" => array(
						'Yes',
						'No'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Vertically Align?", 'pivot'),
					"param_name" => "vertical",
					"value" => array(
						'No',
						'Yes'
					),
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_shortcode_vc' );