<?php 

/**
 * The Shortcode
 */
function ebor_icon_feature_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'layout' => 'large-number',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'large-number' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' text-center feature feature-3 boxed boxed--lg boxed--border">
			    <span class="h1 h1--large">'. $title .'</span>
			    '. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'stack_icon_feature', 'ebor_icon_feature_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_feature_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Icon Feature Blocks", 'stackwordpresstheme'),
			"base" => "stack_icon_feature",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'stackwordpresstheme'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Large Number Title (No Icon)' => 'large-number'
					)
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Card Content", 'stackwordpresstheme'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=DA4NFkag0Kg">Video Tutorial</a></div>',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_feature_shortcode_vc' );