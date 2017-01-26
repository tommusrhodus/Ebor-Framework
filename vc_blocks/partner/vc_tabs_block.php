<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	$output = '<div class="tabs-container"><ul class="tabs text-center">'. do_shortcode($content) .'</ul></div>';
	return $output;
}
add_shortcode( 'partner_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => 'none'
			), $atts 
		) 
	);
	
	$iconHTML = (!( 'none' == $icon || '' == $icon )) ? '<i class="icon--partner '. esc_attr($icon) .'"></i>' : false;
	$tag = (!( 'none' == $icon || '' == $icon )) ? 'h5' : 'h4';
	
	$output = '
		<li>
			<div class="tab__title">
				'. $iconHTML .'
				<'. $tag .'>'. htmlspecialchars_decode($title) .'</'. $tag .'>
			</div>
			<div class="tab__content">
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'	
			</div>
		</li>
	';

	return $output;
}
add_shortcode( 'partner_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Tabs' , 'partner' ),
		    'base'                    => 'partner_tabs',
		    'description'             => esc_html__( 'Create tabs Content', 'partner' ),
		    'as_parent'               => array('only' => 'partner_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params'          => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'            => esc_html__('Tabs Content', 'partner'),
		    'base'            => 'partner_tabs_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'partner' ),
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'partner_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'partner'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'partner'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "ebor_icons",
	            	"heading" => esc_html__("Click an Icon to choose (Icon tabs only)", 'partner'),
	            	"param_name" => "icon",
	            	"value" => $icons,
	            	'description' => 'Type "none" or leave blank to hide icons.'
	            ),
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_partner_tabs_content extends WPBakeryShortCode {}
}