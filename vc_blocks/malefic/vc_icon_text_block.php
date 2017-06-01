<?php 

/**
 * The Shortcode
 */
function ebor_icon_and_text_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'amount' => '',
				'icon' => '',
				'layout' => 'background'
			), $atts 
		) 
	);
	
	if( 'background' == $layout ){
		
		$output = '<div class="text-center icon-and-text"><span class="icon icon-bg mb-20"><i class="fa '. $icon .'"></i></span><h4 class="upper">'. $title .'</h4>'. wpautop($content) .'</div>';
		
	} else {
		
		$output = '<div class="text-center icon-and-text"><span class="icon mb-20"><i class="fa '. $icon .'"></i></span><h4 class="upper">'. $title .'</h4>'. wpautop($content) .'</div>';
		
	}
	
	return $output;
}
add_shortcode( 'malefic_icon_and_text', 'ebor_icon_and_text_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_and_text_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'malefic-vc-block',
			"name" => esc_html__("Icon & Text", 'malefic'),
			"base" => "malefic_icon_and_text",
			"category" => esc_html__('malefic WP Theme', 'malefic'),
			'description' => 'Icon above & text below for services etc.',
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => "Display Type",
					'param_name' => 'layout',
					'value' => array(
						'Icon with background circle' => 'background',
						'Icon with no background' => 'plain'
					),
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'malefic'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'malefic'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'malefic'),
					"param_name" => "content"
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_and_text_shortcode_vc' );