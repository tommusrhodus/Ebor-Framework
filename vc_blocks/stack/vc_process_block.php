<?php

/**
 * The Shortcode
 */
function ebor_process_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'vertical',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'vertical' == $type ){
		
		$output = '<div class="'. esc_attr($custom_css_class) .' process-1">'. do_shortcode($content) .'</div>';
			
	} elseif( 'vertical-numbered' == $type ) {
		
		$find = array('<div','div>', 'process__item">');
		$replace = array('<li', 'div></li>', 'process_item"><div class="process__number"><span></span></div><div class="process__body">');
		$content = str_replace($find, $replace, do_shortcode($content));
		$output = '<ol class="process-3 '. esc_attr($custom_css_class) .'">'. $content .'</ol>';
		
	} else {
		
		$find = array('<div','div>');
		$replace = array('<div class="col-sm-3"><div', 'div></div>');
		$content = str_replace($find, $replace, do_shortcode($content));
		$output = '<div class="'. esc_attr($custom_css_class) .' process-2">'. $content .'</div>';
		
	}

	return $output;
}
add_shortcode( 'stack_process', 'ebor_process_shortcode' );

/**
 * The Shortcode
 */
function ebor_process_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'custom_css_class' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="'. esc_attr($custom_css_class) .' process__item">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';

	return $output;
}
add_shortcode( 'stack_process_content', 'ebor_process_content_shortcode' );

// Parent Element
function ebor_process_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Process Timeline' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_process',
		    'description'             => esc_html__( 'Create process Content', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_process_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'stackwordpresstheme'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Vertical Process' => 'vertical',
		    			'Vertical Numbered Process' => 'vertical-numbered',
		    			'Horizontal Process' => 'horizontal',
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=abgDKyUZ-hI">Video Tutorial</a></div>',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_shortcode_vc' );

// Nested Element
function ebor_process_content_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Process Content', 'stackwordpresstheme'),
		    'base'            => 'stack_process_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_process'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'stackwordpresstheme'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
	            	"param_name" => "custom_css_class",
	            	"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_process extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_process_content extends WPBakeryShortCode {}
}