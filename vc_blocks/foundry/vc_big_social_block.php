<?php

/**
 * The Shortcode
 */
function ebor_big_social_shortcode( $atts, $content = null ) {
	$output = '<ul class="list-inline social-list mb24 spread-children-large text-center">'. do_shortcode($content) .'</ul>';
	return $output;
}
add_shortcode( 'foundry_big_social', 'ebor_big_social_shortcode' );

/**
 * The Shortcode
 */
function ebor_big_social_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'url' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li class="fade-on-hover">
			<a href="'. esc_url($url) .'" target="_blank">
				<i class="icon icon-lg '. $icon .'"></i>
			</a>
		</li>
	';

	return $output;
}
add_shortcode( 'foundry_big_social_content', 'ebor_big_social_content_shortcode' );

// Parent Element
function ebor_big_social_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Big Social Icons' , 'foundry' ),
		    'base'                    => 'foundry_big_social',
		    'description'             => __( 'Create Big Social Icon Content', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_big_social_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_big_social_shortcode_vc' );

// Nested Element
function ebor_big_social_content_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Big Social Icons Content', 'foundry'),
		    'base'            => 'foundry_big_social_content',
		    'description'     => __( 'Big Social Icon Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_big_social'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Icon URL", 'foundry'),
		    		"param_name" => "url",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "ebor_icons",
	            	"heading" => __("Click an Icon to choose", 'foundry'),
	            	"param_name" => "icon",
	            	"value" => $icons,
	            	'description' => 'Type "none" or leave blank to hide icons.'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_big_social_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_big_social extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_big_social_content extends WPBakeryShortCode {

    }
}